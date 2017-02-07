<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request {

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
			'txtUsername' => 'required|unique:users,username',
			'txtPass' => 'required',
			'txtRePass' => 'required|same:txtPass',
			'txtFirstName' => 'required',
			'txtLastName' => 'required',
			'txtEmail' => 'required|email|unique:users,email',
			'txtCaptchaRegister' => 'required',
		];
	}
	public function messages(){
		return [
			'txtUsername.required' => 'Chưa nhập Tài khoản',
			'txtUser.unique' => 'Tên Tài khoản đã tồn tại',
			'txtPass.required' => 'Chưa nhập Mật khẩu',
			'txtRePass.required' => 'Chưa nhập nhập lại mật khẩu',
			'txtRePass.same' => 'Mật khẩu nhập lại không đúng',
			'txtFirstName.required' => 'Chưa nhập Tên',
			'txtLastName.required' => 'Chưa nhập Họ',
			'txtEmail.required' => 'Chưa nhập Email',
			'txtEmail.email' => 'Đây không phải là Email',
			'txtEmail.unique' => 'Email đã tồn tại',
			'txtCaptchaRegister.required' => 'Chưa nhập Mã bảo vệ',
		];
	}
}
