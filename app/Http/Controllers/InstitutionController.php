<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helper\PlatformHelper;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;

use DB;

use App\Models\TInstitution;
use App\Models\TInstitutionTUser;
use App\Models\TUser;

class InstitutionController extends Controller
{
	public function actionGetAll(Request $request, $currentPage)
	{
		$searchParameter=$request->has('searchParameter') ? $request->input('searchParameter') : '';

		$paginate=PlatformHelper::preparePaginate(TInstitution::with(['tdistrict.tprovince'])->whereRaw('compareFind(name, ?, 77)=1', [$searchParameter])->orderByRaw('created_at desc'), 7, $currentPage);

		return view('institution/getall',
		[
			'listTInstitution' => $paginate['listRow'],
			'currentPage' => $paginate['currentPage'],
			'quantityPage' => $paginate['quantityPage'],
			'searchParameter' => $searchParameter
		]);
	}

	public function actionUserManagement(Request $request, SessionManager $sessionManager)
	{
		if($request->has('hdIdInstitution'))
		{
			try
			{
				DB::beginTransaction();

				$tInstitution=TInstitution::find($request->input('hdIdInstitution'));

				TInstitutionTUser::whereRaw('idInstitution=?', [$tInstitution->idInstitution])->delete();

				if($request->input('selectIdUser')!=null && count($request->input('selectIdUser'))>0)
				{
					foreach($request->input('selectIdUser') as $value)
					{
						TInstitutionTUser::whereRaw('idUser=?', [$value])->delete();

						$tInstitutionTUser=new TInstitutionTUser();

						$tInstitutionTUser->idInstitutionTUser=uniqid();
						$tInstitutionTUser->idUser=$value;
						$tInstitutionTUser->idInstitution=$tInstitution->idInstitution;

						$tInstitutionTUser->save();
					}
				}

				DB::commit();

				return PlatformHelper::redirectCorrect('Operación realizada correctamente.', 'institution/getall/1');
			}
			catch(\Exception $e)
			{
				DB::rollback();

				return PlatformHelper::catchException(__CLASS__, __FUNCTION__, $e->getMessage(), '/');
			}
		}

		$tInstitution=TInstitution::with(['tinstitutiontuser'])->whereRaw('idInstitution=?', [$request->input('idInstitution')])->first();

		$listTUser=TUser::whereRaw('role!=? and role!=?', ['Súper usuario', 'Administrador'])->orderBy('email', 'asc')->get();

		return view('institution/usermanagement', ['tInstitution' => $tInstitution, 'listTUser' => $listTUser]);
	}

	public function actionChgToInsertWater(Request $request)
	{
		$listTInstitution=TInstitution::whereHas('tdistrict', function($sq1) use($request)
		{
			$sq1->whereRaw('idDistrict=?', [$request->input('idDistrict')]);
		})->get();

		$this->_so->dto->listTInstitution=$listTInstitution;

		$this->_so->mo->success();

		return response()->json($this->_so);
	}
}
?>