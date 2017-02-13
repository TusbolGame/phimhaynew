<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FilmPerson;
use App\FilmActor;
use App\FilmDirector;
use App\FilmPersonJob;
use App\FilmJob;
use App\Lib\FilmProcess\FilmProcess;
use App\Http\Requests\AdminAddFilmPersonRequest;
use Illuminate\Http\Request;

class FilmPersonController extends Controller {

	public function getProfile($dir_name, $id){
		$person = FilmPerson::find($id);
		if(count($person) == 1 && $person->person_dir_name == $dir_name){
			//update viewed
			$person->person_viewed = $person->person_viewed + 1;
			$person->save();
			$film_actor = FilmActor::where('actor_id', $id)->with('filmList')->with(['filmDetail' => function($query){
				$query->select('film_category');
			}])->get();
			$film_director = FilmDirector::where('director_id', $id)->with('filmList')->with(['filmDetail' => function($query){
				$query->select('film_category');
			}])->get();
			// var_dump($film_actor);
			$film_person_job = FilmPersonJob::where('film_person_id', $id)->with('filmJob')->get();
			// var_dump($film_person_job->filmJob);
			// die();
			return view('phimhay.person.profile', compact('person', 'film_actor', 'film_director', 'film_person_job'));
		}
		//not found
		return redirect()->route('404');
	}
	public function getPersonList(){

	}
	public function getAdd(){
		$film_job = FilmJob::all();
		return view('admin.person.add', compact('film_job'));
	}
	public function postAdd(AdminAddFilmPersonRequest $request){
		//check exist name
		$check = FilmPerson::where('person_name', $request->person_name)->select('id')->get();
		if(count($check) >= 1){
			//
			return redirect()->back()->withErrors('Không thành công ! Tên nhân vật đã tồn tại');
		}
		//
		$film_process = new FilmProcess();
		$dir_name = $film_process->getFilmPersonDirName($request->person_name);
		$person = new FilmPerson();
		$person->person_name = $request->person_name;
		$person->person_full_name = $request->person_full_name;
		$person->person_birth_name = $request->person_birth_name;
		$person->person_nick_name = $request->person_nick_name;
		$person->person_sex = $request->person_sex;
		$person->person_birth_date = $request->person_birth_date;
		$person->person_height = $request->person_height;
		$person->person_info = $request->person_info;
		$person->person_image = $request->person_image;
		$person->person_dir_name = $dir_name;
		$person->save();
		//job
		$job_arr = [];
		foreach ($request->person_job as $key => $val) {
			$job_arr[$key] = ['film_person_id' => $person->id, 'film_job_id' => (int)$val];
		}
		FilmPersonJob::insert($job_arr);
		return redirect()->route('admin.person.getList')->with(['flash_message'=>'Thành công ! Hoàn thành thêm mới một Person']);
	}
	public function getEdit($id){
		$person = FilmPerson::find($id);
		// var_dump($person);die();
		if(count($person) == 0){
			//
			return redirect()->route('admin.person.getList')->withErrors('Không thành công ! Không tồn tại Person để cập nhật');
		}
		$film_job = FilmJob::all();
		$film_person_job = FilmPersonJob::where('film_person_id', $id)->with('filmJob')->get();
		return view('admin.person.edit', compact('person', 'film_job', 'film_person_job'));
	}
	public function postEdit($id, AdminAddFilmPersonRequest $request){
		//check exist name
		$person = FilmPerson::find($id);
		if(count($person) == 0){
			//
			return redirect()->back()->withErrors('Không thành công ! Person không tồn tại');
		}
		//
		$film_process = new FilmProcess();
		$dir_name = $film_process->getFilmPersonDirName($request->person_name);
		$person->person_name = $request->person_name;
		$person->person_full_name = $request->person_full_name;
		$person->person_birth_name = $request->person_birth_name;
		$person->person_nick_name = $request->person_nick_name;
		$person->person_sex = $request->person_sex;
		$person->person_birth_date = $request->person_birth_date;
		$person->person_height = $request->person_height;
		$person->person_info = $request->person_info;
		$person->person_image = $request->person_image;
		$person->person_dir_name = $dir_name;
		$person->save();
		//job
		//person
		//xoa all film person job --> add lai
		//delete all person from film person job
		FilmPersonJob::where('film_person_id', $id)->delete();
		if(count($request->person_job) > 0){
			//add
			$job_arr = [];
			foreach ($request->person_job as $key => $val) {
				$job_arr[$key] = ['film_person_id' => $person->id, 'film_job_id' => (int)$val];
			}
		}
		FilmPersonJob::insert($job_arr);
		return redirect()->route('admin.person.getList')->with(['flash_message'=>'Thành công ! Hoàn thành Cập nhật một Person']);
	}
	public function getList(){
		$film_person = FilmPerson::orderBy('id', 'DESC')->with('filmPersonJob.filmJob')->paginate(10);
		// dump($film_person);die();
		$film_person->setPath(route('admin.person.getList'));
		return view('admin.person.list', compact('film_person'));
	}
	public function getDelete($id){
		$film_person = FilmPerson::find($id);
		$message_info = 'Xóa thất bại! Không tồn tại person với id là '.$id;
		if(count($film_person) == 1){
			$film_person->delete();
			$message_info = 'Success ! Complete Delete Person';
		}
		
		return redirect()->route('admin.person.getList')->with(['flash_message'=> $message_info]);
	}
	public function getSearch(){
		return view('admin.person.search');
	}

}
