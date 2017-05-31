<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\VideoPlayback;

class VideoPlaybackController extends Controller {

	public function getRedirect($id)
	{
		//
		$videoplayback = VideoPlayback::find($id);
		if(count($videoplayback) == 0){
			return response(404);
		}
		return redirect($videoplayback->redirect);
	}

}
