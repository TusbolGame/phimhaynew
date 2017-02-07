<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RecoverRequest extends Request {

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
			'txtUsername' => 'required',
			'txtEmail' => 'required|email',
			'txtCaptcha' => 'required',
		];
	}
	public function messages(){
		return [
			'txtUsername.required' => 'Chưa nhập Tên tài khoản',
			'txtEmail.required' => 'Chưa nhập Email',
			'txtEmail.email' => 'Đây không phải là Email',
			'txtCaptcha.required' => 'Chưa nhập Mã bảo vệ',
		];
	}

}
