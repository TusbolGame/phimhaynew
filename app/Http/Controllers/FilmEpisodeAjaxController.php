<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
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
			if(!$file_save->isValid()){
				$result['content'] = 'khong thanh cong';
				return response()->json($result);
			}
			//check extension type video
			$check = ['mp4', 'mkv', 'flv', 'avi'];
			if(!in_array($file_save->getClientOriginalExtension(), $check)){
				//is video
				// $result['content'] = $file_save->getClientOriginalExtension();
				$result['content'] = 'Video ko dc support';
				return response()->json($result);
			}
			//check size
			if(!empty($file_svae->getClientSize()) && $file_svae->getClientSize() > 1000000){
				//is video
				// $result['content'] = $file_save->getClientOriginalExtension();
				$result['content'] = 'Size Video too big';
				return response()->json($result);
			}
			
			// var_dump($file_save);

			exit;
			$path = base_path('resources/phim/movies').'/';
			$name = $file_save->getClientOriginalName();
			//check exit file
			if(File::exists($path.$name)){
				$result['content'] = 'File đã tồn tại';
				return response()->json($result);
			}
			//upload
			$file_save->move($path, $name);
			//converter file to mp4, if differen

			//generate resolution -> using ffmpeg

			//or generate file hls m3u8, if using hls
			//save file name and return result
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
