<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TDistrict;

class DistrictController extends Controller
{
	public function actionChgToInsertWater(Request $request)
	{
		$listTDistrict=TDistrict::whereHas('tprovince', function($sq1) use($request)
		{
			$sq1->whereRaw('idProvince=?', [$request->input('idProvince')]);
		})->get();

		$this->_so->dto->listTDistrict=$listTDistrict;

		$this->_so->mo->success();

		return response()->json($this->_so);
	}
}
?>