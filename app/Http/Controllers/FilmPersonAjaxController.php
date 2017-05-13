<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
// use Illuminate\Http\Request;
use App\FilmPerson;
use App\FilmPersonJob;
use App\Lib\FilmProcess\FilmProcess;
use Auth;
use Illuminate\Http\Response;

class FilmPersonAjaxController extends Controller {

	//
	public function postAdd(){
		$result = array('status' => 0, 'content' => '', 'login' => 1, 'timeout' => 1);
		//check login
		if(!Auth::check()){
			$result['content'] = 'Chưa đăng nhập';
			$result['login'] = 0;
			//die(json_encode($result));
			return response()->json($result);
		}
		if (Request::ajax())
		{
			//check require person name
			if(Request::get('person_name') == ''){
				$result['content'] = 'Chưa nhập tên';
				return response()->json($result);
			}
			//check 
			$check = FilmPerson::where('person_name', Request::get('person_name'))->select('id')->get();
			if(count($check) == 0){
				//check job
				if(count(Request::get('person_job')) == 0){
					$result['content'] = 'Chưa nhập nghề nghiệp';
					return response()->json($result);
				}
				//dir
				$film_process = new FilmProcess();
				$dir_name = $film_process->getFilmPersonDirName(Request::get('person_name'));
				$person = new FilmPerson();
				$person->person_name = Request::get('person_name');
				$person->person_full_name = Request::get('person_full_name');
				$person->person_birth_name = Request::get('person_birth_name');
				$person->person_nick_name = Request::get('person_nick_name');
				$person->person_birth_date = Request::get('person_birth_date');
				$person->person_height = Request::get('person_height');
				$person->person_info = Request::get('person_info');
				$person->person_image = Request::get('person_image');
				$person->person_dir_name = $dir_name;
				$person->save();
				//job
				if(count(Request::get('person_job'))){
					$job_arr = [];
					foreach (Request::get('person_job') as $key => $val) {
						$job_arr[$key] = ['film_person_id' => $person->id, 'film_job_id' => (int)$val];
					}
					FilmPersonJob::insert($job_arr);
				}
				$result['content'] = $person;
				$result['status'] = 1;
				return response()->json($result);
			}
			$result['content'] = 'Person đã tồn tại';
			return response()->json($result);
		}
		$result['content'] = 'Không thêm đc person';
		return response()->json($result);
	}
	//search ajax person
	public function postSearch(){
		$result = array('status' => 0, 'content' => '', 'login' => 1, 'timeout' => 1);
		//check login
		if(!Auth::check()){
			$result['content'] = 'Chưa đăng nhập';
			$result['login'] = 0;
			//die(json_encode($result));
			return response()->json($result);
		}
		if (Request::ajax())
		{
			//get 10 row 
			$person = FilmPerson::where('person_name', 'LIKE', '%'.Request::get('person_name').'%')->select('id', 'person_name', 'person_image')->take(5)->get();
			if(count($person) >= 1){
				$result['content'] = $person;
				$result['status'] = 1;
				return response()->json($result);
			}
		}
		$result['content'] = 'Lỗi ajax';
		return response()->json($result);
	}
	
}
