<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangeInfoUserRequest extends Request {

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
			'txtFirstName' => 'required',
			'txtLastName' => 'required',
			'txtEmail' => 'required|email',
			'fileImageUser' => 'image|max:1024'
		];
	}
	public function messages(){
		return [
			'txtFirstName.required' => 'Chưa nhập Tên',
			'txtLastName.required' => 'Chưa nhập Họ',
			'txtEmail.required' => 'Chưa nhập Email',
			'txtEmail.email' => 'Đây không phải Email',
			'fileImageUser.image' => 'Không phải là hình ảnh',
			'fileImageUser.max' => 'Hình ảnh quá lớn > 1MB'
			];
	}

}
