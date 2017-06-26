<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FilmJob;
use Illuminate\Http\Request;
use Auth;
use Cache;

class FilmJobController extends Controller {

	//
	public function getAdd(){
		if(!Auth::user()->hasPermission('createJob')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Create Job');
		}
		return view('admin.job.add');
	}
	public function postAdd(Request $request){
		if(!Auth::user()->hasPermission('createJob')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Create Job');
		}
		//check null
		$job_name = $request->job_name;
		if($job_name == ''){
			return redirect()->back()->withErrors('Chưa nhập Tên nghề nghiệp');
		}
		//check exist job
		$check = FilmJob::where('job_name', $job_name)->select('id')->get();
		if(count($check) >= 1){
			//
			return redirect()->back()->withErrors('Tên nghề nghiệp đã tồn tại')->withInput();
		}
		$job = new FilmJob();
		$job->job_name = $job_name;
		$job->save();
		//forget cache job
		Cache::forget('film_job');
		return redirect()->route('admin.job.getList')->with(['flash_message'=>'Thành công! Thêm một Job mới']);
	}
	public function getEdit($id){
		if(!Auth::user()->hasPermission('editJob')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Edit Job');
		}
		$film_job = FilmJob::find($id);
		if(count($film_job) == 0){
			return redirect()->back()->with(['flash_message_error' => 'Thất bại ! Không tồn tại Job id là '.$id]);
		}
		return view('admin.job.edit', compact('film_job'));
	}
	public function postEdit($id, Request $request){
		if(!Auth::user()->hasPermission('editJob')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Edit Job');
		}
		$job_name = $request->job_name;
		if($job_name == ''){
			return redirect()->back()->withErrors('Vui lòng điền tên nghề nghiệp');
		}
		$film_job = FilmJob::find($id);
		if(count($film_job) == 0){
			return redirect()->back()->with(['flash_message_error' => 'Thất bại ! Không tồn tại Job id là '.$id]);
		}
		$film_job->job_name = $job_name;
		$film_job->save();
		//forget cache job
		Cache::forget('film_job');
		return redirect()->route('admin.job.getList')->with(['flash_message'=>'Thành công! Cập nhật Job Name thành '.$job_name]);
	}
	public function getList(){
		if(!Auth::user()->hasPermission('showJob')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Show Job');
		}
		$film_jobs = FilmJob::all();
		return view('admin.job.list', compact('film_jobs'));
	}
	public function getDelete($id){
		if(!Auth::user()->hasPermission('deleteJob')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Delete Job');
		}
		$film_job = FilmJob::find($id);
		if(count($film_job) == 0){
			return redirect()->route('admin.job.getList')->with(['flash_message_error' => 'Thất bại ! Không tồn tại Job id là '.$id]);
		}
		$film_job->delete();
		//forget cache job
		Cache::forget('film_job');
		return redirect()->route('admin.job.getList')->with(['flash_message'=>'Thành công ! Xóa Jod name là '.$film_job->job_name]);
	}
}
