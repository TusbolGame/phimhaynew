<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangePasswordRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'password' => 'required',
			'password_new' => 'required',
			'repassword_new' => 'required|same:password_new'
		];
	}
	public function messages(){
		return [
			'password.required' => 'Chưa nhập mật khẩu',
			'password_new.required' => 'Chưa nhập mật khẩu mới',
			'repassword_new.required' => 'Chưa nhập nhập lại mật khẩu mới',
			'repassword_new.same' => 'Mật khẩu mới nhập lại không đúng'
		];
	}

}
