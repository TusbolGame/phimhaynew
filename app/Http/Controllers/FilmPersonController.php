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
use File;
use Cache;
use Auth;

class FilmPersonController extends Controller {

	public function getProfile($dir_name, $id){
		$person = FilmPerson::find($id);
		// var_dump($dir_name);die();
		if(count($person) == 1 && $person->person_dir_name == $dir_name){
			//update viewed
			$person->person_viewed = $person->person_viewed + 1;
			$person->save();
			$film_actor = FilmActor::where('actor_id', $id)->orderByRaw('RAND()')->take(10)->with('filmList')->get();
			$film_director = FilmDirector::where('director_id', $id)->orderByRaw('RAND()')->take(10)->with('filmList')->get();
			$total_director = FilmDirector::where('director_id', $id)->count();
			$total_actor = FilmActor::where('actor_id', $id)->count();
			// var_dump($film_actor);
			//get job
			$film_person_job = FilmPersonJob::where('film_person_id', $id)->with('filmJob')->get();
			// var_dump($film_person_job->filmJob);
			// die();
			return view('phimhay.person.profile', compact('person', 'film_actor', 'film_director', 'film_person_job', 'total_director', 'total_actor'));
		}
		//not found
		// return redirect()->route('404');
		return redirect()->view('phimhay.include.404');
	}
	public function getPersonDirector($id){
		$person = FilmPerson::find($id);
		if(count($person) == 1){
			$film_director = FilmDirector::where('director_id', $id)->with('filmList')->paginate(20);
			$film_director->setPath(route('person.getPersonDirector', $id));
			return view('phimhay.person.person-director', compact('person', 'film_director'));
		}
		//not found
		// return redirect()->route('404');
		return redirect()->view('phimhay.include.404');
	}
	public function getPersonActor($id){
		$person = FilmPerson::find($id);
		if(count($person) == 1){
			$film_actor = FilmActor::where('actor_id', $id)->with('filmList')->paginate(20);
			$film_actor->setPath(route('person.getPersonActor', $id));
			return view('phimhay.person.person-actor', compact('person', 'film_actor'));
		}
		//not found
		// return redirect()->route('404');
		return redirect()->view('phimhay.include.404');	
	}
	//search person
	public function getPersonList(Request $request){
		//job
		// $film_job = FilmJob::orderBy('job_name', 'ASC')->get();
		$film_job = Cache::get('film_job');

		$person_name = $request->person_name;
		$person_job = (int)$request->person_job;
		//null
		if($request->person_name == ''){
			if(empty($person_job)){
				$film_person = FilmPerson::orderBy('person_name', 'ASC')->paginate(18);
			}else{
				//is job
				$film_person = FilmPerson::whereHas('filmPersonJob', function($query) use($person_job){
					$query->where('film_job_id', $person_job);
				})
				->orderBy('person_name', 'ASC')->paginate(18);
			}
			
		}else{
			//ko null
			//no job
			if(empty($person_job)){
				$film_person = FilmPerson::where('person_name', 'LIKE', '%'.$person_name.'%')->orderBy('person_name', 'ASC')->paginate(18);
			}else{
				//is job
				$film_person = FilmPerson::where('person_name', 'LIKE', '%'.$person_name.'%')
				->whereHas('filmPersonJob', function($query) use($person_job){
					$query->where('film_job_id', $person_job);
				})
				->orderBy('person_name', 'ASC')->paginate(18);
			}
		}
		
		$film_person->setPath(route('person.getList'));
		return view('phimhay.person.search', compact('film_person', 'film_job'))->with(['person_name' => $person_name, 'person_job' => $person_job]);
	}
	public function getAdd(){
		if(!Auth::user()->hasPermission('createPerson')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Create Person');
		}
		$film_job = FilmJob::orderBy('job_name', 'ASC')->get();
		return view('admin.person.add', compact('film_job'));
	}
	public function postAdd(AdminAddFilmPersonRequest $request){
		if(!Auth::user()->hasPermission('createPerson')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Create Person');
		}
		//check exist name
		$check = FilmPerson::where('person_name', $request->person_name)->select('id')->get();
		if(count($check) >= 1){
			//
			return redirect()->back()->withErrors('Không thành công ! Tên nhân vật đã tồn tại')->withInput();
		}
		//
		$film_process = new FilmProcess();
		$dir_name = $film_process->getFilmPersonDirName($request->person_name);
		$person = new FilmPerson();
		$person->person_name = $request->person_name;
		$person->person_full_name = $request->person_full_name;
		$person->person_birth_name = $request->person_birth_name;
		$person->person_nick_name = $request->person_nick_name;
		$person->person_birth_date = $request->person_birth_date;
		$person->person_height = $request->person_height;
		$person->person_info = $request->person_info;
		$person->person_image = $request->person_image_url;
		$person->person_dir_name = $dir_name;
		$person->save();
		//image
		$file = $request->file('person_image_file');
		if($file && $file->isValid()){
			//
			$image_name = $dir_name.'-'.$person->id.'-'.$file->getClientOriginalExtension();
			$file->move('resources/phim/people/', $image_name);
			$person->person_image = $image_name;
			$person->save();
		}
		//job
		if(count($request->person_job) > 0){
			$job_arr = [];
			foreach ($request->person_job as $key => $val) {
				$job_arr[$key] = ['film_person_id' => $person->id, 'film_job_id' => (int)$val];
			}
			FilmPersonJob::insert($job_arr);
		}
		return redirect()->route('admin.person.getList')->with(['flash_message'=>'Thành công ! Hoàn thành thêm mới một Person: '.$person->person_name]);
	}
	public function getEdit($id){
		if(!Auth::user()->hasPermission('editPerson')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Edit Person');
		}
		$person = FilmPerson::find($id);
		// var_dump($person);die();
		if(count($person) == 0){
			//
			return redirect()->route('admin.person.getList')->withErrors('Không thành công ! Không tồn tại Person để cập nhật');
		}
		$film_job = FilmJob::orderBy('job_name', 'ASC')->get();
		$film_person_job = FilmPersonJob::where('film_person_id', $id)->with('filmJob')->get();
		return view('admin.person.edit', compact('person', 'film_job', 'film_person_job'));
	}
	public function postEdit($id, AdminAddFilmPersonRequest $request){
		if(!Auth::user()->hasPermission('editPerson')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Edit Person');
		}
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
		$person->person_birth_date = $request->person_birth_date;
		$person->person_height = $request->person_height;
		$person->person_info = $request->person_info;
		$person->person_dir_name = $dir_name;
		//image
		$file = $request->file('person_image_file');
		if($file && $file->isValid()){
			//check and remove file image old
			if(substr($person->person_image, 0, 4) != 'http') {
				if(File::exists('resources/phim/people/'.$person->person_image)){
					//remove
					File::delete('resources/phim/people/'.$person->person_image);
				}
			}
			$image_name = $dir_name.'-'.$person->id.'-'.$file->getClientOriginalExtension();
			$file->move('resources/phim/people/', $image_name);
			$person->person_image = $image_name;
		}else{
			$person->person_image = $request->person_image_url;
		}		
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
		if(!Auth::user()->hasPermission('showPerson')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Show Person');
		}
		$film_person = FilmPerson::orderBy('id', 'DESC')->with('filmPersonJob.filmJob')->paginate(10);
		// dump($film_person);die();
		$film_person->setPath(route('admin.person.getList'));
		return view('admin.person.list', compact('film_person'));
	}
	public function getDelete($id){
		if(!Auth::user()->hasPermission('deletePerson')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Delete Person');
		}
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
