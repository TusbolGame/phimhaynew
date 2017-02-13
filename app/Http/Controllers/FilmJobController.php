<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FilmJob;
use Illuminate\Http\Request;

class FilmJobController extends Controller {

	//
	public function getAdd(){
		return view('admin.job.add');
	}
	public function postAdd(Request $request){
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
		return redirect()->route('admin.job.getList')->with(['flash_message'=>'Thành công! Thêm một Job mới']);
	}
	public function getEdit($id){
		$film_job = FilmJob::find($id);
		if(count($film_job) == 0){
			return redirect()->back()->with(['flash_message_error' => 'Thất bại ! Không tồn tại Job id là '.$id]);
		}
		return view('admin.job.edit', compact('film_job'));
	}
	public function postEdit($id, Request $request){
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
		return redirect()->route('admin.job.getList')->with(['flash_message'=>'Thành công! Cập nhật Job Name thành '.$job_name]);
	}
	public function getList(){
		$film_jobs = FilmJob::all();
		return view('admin.job.list', compact('film_jobs'));
	}
	public function getDelete($id){
		$film_job = FilmJob::find($id);
		if(count($film_job) == 0){
			return redirect()->route('admin.job.getList')->with(['flash_message_error' => 'Thất bại ! Không tồn tại Job id là '.$id]);
		}
		$film_job->delete();
		return redirect()->route('admin.job.getList')->with(['flash_message'=>'Thành công ! Xóa Jod name là '.$film_job->job_name]);
	}
}
