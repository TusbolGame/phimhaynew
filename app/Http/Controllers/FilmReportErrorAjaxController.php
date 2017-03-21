<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
use Request;
use App\Lib\CaptchaImages\CaptchaSessionReportErrorAdd;
use App\FilmReportError;
use App\FilmList;
use Auth;

class FilmReportErrorAjaxController extends Controller {

	public function postAdd(){
		$result = array('status' => 0, 'content' => '', 'login' => 1);
		//check login
		if(!Auth::check()){
			$result['content'] = 'Chưa đăng nhập';
			$result['login'] = 0;
			//die(json_encode($result));
			return response()->json($result);
		}
		if(Request::ajax()){
			$captcha_report_error = new CaptchaSessionReportErrorAdd();
			$captcha_report_error->createCheckCaptchaSessionUses(Request::get('captcha'));
			//check captcha
			if($captcha_report_error->checkCaptchaSessionUses()){
				//forget session
				$captcha_report_error->forgetCaptchaSessionUses();
				//check exist content
				$data = '';
				if(Request::get('report_error_content_2') == ''){
					if(empty(Request::get('report_error_content_1'))){
						$result['content'] = 'Lỗi! Nội dung báo lỗi trống!';
						return response()->json($result);
					}
					//content_1 is array-->check
					if(count(Request::get('report_error_content_1')) == 1){
						$data = Request::get('report_error_content_1')[0];
					}else if(count(Request::get('report_error_content_1')) > 1){
						$data = implode(',', Request::get('report_error_content_1'));
					}
				}else{
					$data = Request::get('report_error_content_2');
				}
				//
				$film_id = (int)Request::get('film_id');
				$film_list = FilmList::find($film_id);
				if(count($film_list) == 0){
					$result['content'] = 'Lỗi! Phim không tồn tại!';
					return response()->json($result);
				}
				//exists film
				//add
				$film_report_error = new FilmReportError();
				$film_report_error->report_error_name = $data;
				$film_report_error->report_error_status = 0; //chua xem
				$film_report_error->film_id = $film_id;
				$film_report_error->user_id = Auth::user()->id;
				$film_report_error->save();
				$result['content'] = 'Cảm ơn bạn đã báo lỗi!';
				$result['status'] = 1;
				return response()->json($result);
			}else{
				//forget session
				$captcha_report_error->forgetCaptchaSessionUses();
				$result['content'] = 'Sai mã bảo vệ, hoặc mã bảo vệ hết hạn';
				return response()->json($result);
			}
		}
		$result['content'] = 'Đã xảy ra lỗi, vui lòng quay lại sau!';
		return response()->json($result);
	}
}
