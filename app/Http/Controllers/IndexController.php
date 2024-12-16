<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TVideo;
use App\Models\TContent;
use App\Models\TGallery;
use App\Models\TUser;
use Illuminate\Support\Carbon;
use App\Models\ModalSetting;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
	public function actionIndex()
	{	

		$modal = Cache::remember('active_modal', 60, function () {
			return ModalSetting::where('is_active', true)
				->where('start_date', '<=', now())
				->where('end_date', '>=', now())
				->first();
		});

		// Retorna la vista con los datos del modal
		return view('home.index', compact('modal'));
	}

	public function actionGallery()
	{
		$videos = TVideo::all();
		$images = TGallery::orderBy('id', 'desc')->take(12)->get();

		return view('home/gallery', [
			'videos' => $videos,
			'images' => $images
		]);
	}

	public function actioncontent()
	{
		$contents = TContent::all();
		return view('home/content', ['contents' => $contents]);
	}

	public function actioncontentDetail($id)
	{
		$content = TContent::where('id', $id)->first();
		$video = TVideo::where('id', $id)->first();
		return view('home/content_detail', ['content' => $content, 'video' => $video]);
	}

	public function actionIndexAdmin()
	{
		return view('index/indexadmin');
	}
}
