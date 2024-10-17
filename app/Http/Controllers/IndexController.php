<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TPersonal;
use App\Models\TUser;
use Illuminate\Support\Carbon;

class IndexController extends Controller
{
	public function actionIndex()
	{
		return view('home/index');
	}

	public function actionIndexAdmin()
	{
		return view('index/indexadmin');
	}
}
?>