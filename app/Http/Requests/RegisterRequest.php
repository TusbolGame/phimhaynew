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
			'txtPass' => 'required|min:8|max:30',
			'txtRePass' => 'required|same:txtPass',
			'txtFirstName' => 'required',
			'txtLastName' => 'required',
			'txtEmail' => 'required|email|unique:users,email',
			'txtCaptchaRegister' => 'required',
		];
	}
	public function messages(){
		return [
			'txtUsername.required' => 'Chưa nhập Tên tài khoản',
			'txtUser.unique' => 'Tên tài khoản đã tồn tại',
			'txtPass.required' => 'Chưa nhập Mật khẩu',
			'txtPass.min' => 'Mật khẩu tối thiểu 8 ký tự',
			'txtPass.max' => 'Mật khẩu tối đa 30 ký tự',
			'txtRePass.required' => 'Chưa nhập xác nhận mật khẩu',
			'txtRePass.same' => 'Mật khẩu xác nhận không đúng',
			'txtFirstName.required' => 'Chưa nhập Tên',
			'txtLastName.required' => 'Chưa nhập Họ',
			'txtEmail.required' => 'Chưa nhập Email',
			'txtEmail.email' => 'Đây không phải là Email',
			'txtEmail.unique' => 'Email đã tồn tại',
			'txtCaptchaRegister.required' => 'Chưa nhập Mã bảo vệ',
		];
	}
}
