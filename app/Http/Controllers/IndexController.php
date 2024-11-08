<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TVideo;
use App\Models\TContent;
use App\Models\TGallery;
use App\Models\TUser;
use Illuminate\Support\Carbon;

class IndexController extends Controller
{
	public function actionIndex()
	{
		return view('home/index');
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
