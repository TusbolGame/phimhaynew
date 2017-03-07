<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// use Request;
use Response;
use Input;
use File;

class FilmEpisodeAjaxController extends Controller {

	//
	public function postUpload(Request $request){
		$result = ['status' => 0, 'content' => ''];
		if($request->ajax()){
			//file
			// $file_save = Input::file('file');
			$file_save = $request->file('file');
			// var_dump($file_save);

			// die();
			$path = base_path('resources/phim/movies').'/';
			$name = $file_save->getClientOriginalName();
			//check exit
			if(File::exists($path.$name)){
				$result['content'] = 'File đã tồn tại';
				return response()->json($result);
			}
			//upload
			$file_save->move($path, $name);
			$result['status'] = 1;
			return response()->json($result);
		}
		//
		$result['content'] = 'Lỗi';
		return response()->json($result);
	}
	public function postDelete(Request $request){
		$result = ['status' => 0, 'content' => ''];
		if($request->ajax()){
			//file
			$path = base_path('resources/phim/movies').'/';
			//check exit
			if(!File::exists($path.$request->file_name)){
				$result['content'] = 'File không tồn tại';
				return response()->json($result);
			}
			//delete
			File::delete($path.$request->file_name);
			$result['status'] = 1;
			return response()->json($result);
		}
		//
		$result['content'] = 'Lỗi';
		return response()->json($result);
	}
	public function postCheckExists(Request $request){
		$result = ['status' => 0, 'content' => ''];
		if($request->ajax()){
			//file
			$path = base_path('resources/phim/movies').'/';
			//check exit
			if(!File::exists($path.$request->file_name)){
				$result['content'] = 'File không tồn tại';
				return response()->json($result);
			}
			$result['status'] = 1;
			return response()->json($result);
		}
		//
		$result['content'] = 'Lỗi';
		return response()->json($result);
	}
	public function getCheckExists(){
		
			$path = base_path('resources/phim/movies').'/';
			//check exit
			if(!File::exists($path.'anacondas2.mp4')){
				echo 'not found';
			}
			echo 'found';

	}

}
