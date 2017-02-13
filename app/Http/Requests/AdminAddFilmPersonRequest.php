<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminAddFilmPersonRequest extends Request {

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
			'person_name' => 'required',
			'person_sex' => 'required',
			'person_job' => 'required',
			'person_image' => 'required'
		];
	}
	public function messages(){
		return [
			'person_name.required' => 'Chưa nhập nhân vật name',
			'person_sex.required' => 'Chưa nhập giới tính',
			'person_job.required' => 'Chưa nhập nghề nghiệp',
			'person_image.required' => 'Chưa nhập ảnh đại diện'
		];
	}

}
