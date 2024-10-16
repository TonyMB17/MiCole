<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helper\PlatformHelper;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Maatwebsite\Excel\Facades\Excel;
use App\Export\DataExport;

use App\Validation\WaterValidation;

use Illuminate\Support\Facades\DB;

use App\Models\TProvince;
use App\Models\TWater;
use App\Models\TUser;

class WaterController extends Controller
{
	public function actionInsert(Request $request, SessionManager $sessionManager)
	{
		$listMonth=['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'];

		$currentMonth=$listMonth[intval(date('m'))-1];
		$currentWeek=date('W', strtotime(date('Y-m-d')))-date('W', strtotime(date('Y-m-01', strtotime(date('Y-m-d')))))+1;
		$currentDate=date('d-m-Y');

		if($_POST)
		{
			try
			{
				DB::beginTransaction();

				$this->_so->mo->listMessage=(new WaterValidation())->validationInsert($request);

				if($this->_so->mo->existsMessage())
				{
					DB::rollBack();

					return PlatformHelper::redirectError($this->_so->mo->listMessage, 'water/insert');
				}

				$tUser=TUser::with(['tinstitutiontuser.tinstitution.tdistrict.tprovince'])->whereRaw('idUser=?', [$sessionManager->get('idUser')])->first();

				if(count($tUser->tinstitutiontuser)==0)
				{
					return PlatformHelper::redirectError([], 'user/logout');
				}

				$tWater=TWater::whereRaw('year(created_at)=? and idInstitution=? and month=?', [date('Y'), $tUser->tinstitutiontuser[0]->tinstitution->idInstitution, $currentMonth])->first();

				if($tWater==null)
				{
					$tWater=new TWater();

					$tWater->idWater=uniqid();
					$tWater->idUser=$sessionManager->get('idUser');
					$tWater->idInstitution=$tUser->tinstitutiontuser[0]->tinstitution->idInstitution;
					$tWater->month=$currentMonth;
					$tWater->resultW1=-1;
					$tWater->resultW2=-1;
					$tWater->resultW3=-1;
					$tWater->resultW4=-1;
					$tWater->resultW5=-1;
					$tWater->status='Activo';
				}

				switch($currentWeek)
				{
					case 1:
						if($tWater->resultW1!=-1)
						{
							DB::rollBack();

							return PlatformHelper::redirectError(['Ya existe registro para la semana de este mes en el año actual.'], 'water/insert');
						}

						$tWater->resultW1=trim($request->input('txtResult'));

					break;

					case 2:
						if($tWater->resultW2!=-1)
						{
							DB::rollBack();

							return PlatformHelper::redirectError(['Ya existe registro para la semana de este mes en el año actual.'], 'water/insert');
						}

						$tWater->resultW2=trim($request->input('txtResult'));

					break;

					case 3:
						if($tWater->resultW3!=-1)
						{
							DB::rollBack();

							return PlatformHelper::redirectError(['Ya existe registro para la semana de este mes en el año actual.'], 'water/insert');
						}

						$tWater->resultW3=trim($request->input('txtResult'));

					break;

					case 4:
						if($tWater->resultW4!=-1)
						{
							DB::rollBack();

							return PlatformHelper::redirectError(['Ya existe registro para la semana de este mes en el año actual.'], 'water/insert');
						}

						$tWater->resultW4=trim($request->input('txtResult'));

					break;

					case 5:
						if($tWater->resultW5!=-1)
						{
							DB::rollBack();

							return PlatformHelper::redirectError(['Ya existe registro para la semana de este mes en el año actual.'], 'water/insert');
						}

						$tWater->resultW5=trim($request->input('txtResult'));

					break;
				}

				$tWater->save();

				DB::commit();

				return PlatformHelper::redirectCorrect(['Operación ralizada correctamente.'], 'water/insert');
			}
			catch(\Exception $e)
			{
				DB::rollBack();

				return PlatformHelper::catchException(__CLASS__, __FUNCTION__, $e->getMessage(), '/');
			}
		}

		$tUser=TUser::with(['tinstitutiontuser.tinstitution.tdistrict.tprovince'])->whereRaw('idUser=?', [$sessionManager->get('idUser')])->first();

		if(count($tUser->tinstitutiontuser)==0)
		{
			return PlatformHelper::redirectError([], 'user/logout');
		}

		$listTWater=TWater::whereHas('tinstitution', function($sq1) use($tUser)
		{
			$sq1->whereRaw('idInstitution=?', [$tUser->tinstitutiontuser[0]->tinstitution->idInstitution]);
		})->orderByRaw('created_at desc')->take(12)->get();

		foreach($listTWater as $value)
		{
			$sumForAverage=0;
			$divForAverage=0;

			if($value->resultW1!=-1)
			{
				$sumForAverage+=$value->resultW1;
				$divForAverage++;
			}

			if($value->resultW2!=-1)
			{
				$sumForAverage+=$value->resultW2;
				$divForAverage++;
			}

			if($value->resultW3!=-1)
			{
				$sumForAverage+=$value->resultW3;
				$divForAverage++;
			}

			if($value->resultW4!=-1)
			{
				$sumForAverage+=$value->resultW4;
				$divForAverage++;
			}

			if($value->resultW5!=-1)
			{
				$sumForAverage+=$value->resultW5;
				$divForAverage++;
			}

			$value->average=$divForAverage=0 ? 0 : number_format($sumForAverage/$divForAverage, 4, '.');
		}

		$currentNumberMonth=intval(date('m'))-1;
		$listMonthToGraphic=[];

		for($i=11; $i>=0; $i--)
		{
			$listMonthToGraphic[]=$listMonth[$currentNumberMonth>=0 ? $currentNumberMonth : ($currentNumberMonth+12)];

			$currentNumberMonth--;
		}

		$listMonthToGraphic=array_reverse($listMonthToGraphic);

		$listDataToGraphic=[];

		foreach($listMonthToGraphic as $value)
		{
			$tempData=null;

			foreach($listTWater as $item)
			{
				if($value==$item->month)
				{
					$tempData=$item;

					break 1;
				}
			}

			if($tempData!=null)
			{
				$listDataToGraphic[]=$tempData->average;
			}
			else
			{
				$listDataToGraphic[]=0;
			}
		}

		return view('water/insert',
		[
			'tUser' => $tUser,
			'currentMonth' => $currentMonth,
			'currentWeek' => $currentWeek,
			'currentDate' => $currentDate,
			'listMonthToGraphic' => $listMonthToGraphic,
			'listDataToGraphic' => $listDataToGraphic
		]);
	}

	public function actionGetAll(Request $request, $currentPage)
	{
		$searchParameter=$request->has('searchParameter') ? $request->input('searchParameter') : '';

		$paginate=PlatformHelper::preparePaginate(TWater::with(['tinstitution.tdistrict.tprovince'])->whereHas('tinstitution', function($sq1) use($searchParameter)
		{
			$sq1->whereRaw('compareFind(name, ?, 77)=1', [$searchParameter]);
		})->orWhereRaw('compareFind(month, ?, 77)=1', [$searchParameter])->orderByRaw('created_at desc'), 7, $currentPage);

		foreach($paginate['listRow'] as $value)
		{
			$sumForAverage=0;
			$divForAverage=0;

			if($value->resultW1!=-1)
			{
				$sumForAverage+=$value->resultW1;
				$divForAverage++;
			}

			if($value->resultW2!=-1)
			{
				$sumForAverage+=$value->resultW2;
				$divForAverage++;
			}

			if($value->resultW3!=-1)
			{
				$sumForAverage+=$value->resultW3;
				$divForAverage++;
			}

			if($value->resultW4!=-1)
			{
				$sumForAverage+=$value->resultW4;
				$divForAverage++;
			}

			if($value->resultW5!=-1)
			{
				$sumForAverage+=$value->resultW5;
				$divForAverage++;
			}

			$value->average=$divForAverage=0 ? 0 : number_format($sumForAverage/$divForAverage, 4, '.');
		}

		return view('water/getall',
		[
			'listTWater' => $paginate['listRow'],
			'currentPage' => $paginate['currentPage'],
			'quantityPage' => $paginate['quantityPage'],
			'searchParameter' => $searchParameter
		]);
	}

	public function actionExport(Request $request)
	{
		$searchParameter=$request->has('searchParameter') ? $request->input('searchParameter') : '';

		$listTWater=TWater::with(['tinstitution.tdistrict.tprovince'])->whereHas('tinstitution', function($sq1) use($searchParameter)
		{
			$sq1->whereRaw('compareFind(name, ?, 77)=1', [$searchParameter]);
		})->orWhereRaw('compareFind(month, ?, 77)=1', [$searchParameter])->orderByRaw('created_at desc')->get();

		foreach($listTWater as $value)
		{
			$sumForAverage=0;
			$divForAverage=0;

			if($value->resultW1!=-1)
			{
				$sumForAverage+=$value->resultW1;
				$divForAverage++;
			}

			if($value->resultW2!=-1)
			{
				$sumForAverage+=$value->resultW2;
				$divForAverage++;
			}

			if($value->resultW3!=-1)
			{
				$sumForAverage+=$value->resultW3;
				$divForAverage++;
			}

			if($value->resultW4!=-1)
			{
				$sumForAverage+=$value->resultW4;
				$divForAverage++;
			}

			if($value->resultW5!=-1)
			{
				$sumForAverage+=$value->resultW5;
				$divForAverage++;
			}

			$value->average=$divForAverage=0 ? 0 : number_format($sumForAverage/$divForAverage, 4, '.');
		}

		$data=[];

		$data[]=
		[
			'Institución',
			'Prestador',
			'Provincia',
			'Distrito',
			'Periodo año',
			'Periodo mes',
			'MCR S. 1',
			'MCR S. 2',
			'MCR S. 3',
			'MCR S. 4',
			'MCR S. 5',
			'Promedio',
			'Estado'
		];

		foreach($listTWater as $value)
		{
			$data[]=
			[
				$value->tinstitution->name,
				$value->tinstitution->lender,
				$value->tinstitution->tdistrict->tprovince->name,
				$value->tinstitution->tdistrict->name,
				substr($value->created_at, 0, 4),
				$value->month,
				($value->resultW1!=-1 ? number_format($value->resultW1, 1, '.') : '-'),
				($value->resultW2!=-1 ? number_format($value->resultW2, 1, '.') : '-'),
				($value->resultW3!=-1 ? number_format($value->resultW3, 1, '.') : '-'),
				($value->resultW4!=-1 ? number_format($value->resultW4, 1, '.') : '-'),
				($value->resultW5!=-1 ? number_format($value->resultW5, 1, '.') : '-'),
				$value->average,
				($value->average<0.5 || $value->average>1) ? 'Inadecuado' : 'Bueno'
			];
		}

		return Excel::download(new DataExport($data), 'waterExport.xlsx');
	}
}
?>