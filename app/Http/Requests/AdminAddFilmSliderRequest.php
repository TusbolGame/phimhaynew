<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminAddFilmSliderRequest extends Request {

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
			'slider_name' => 'required',
			'slider_dir' => 'required',
			'slider_image' => 'required'
		];
	}
	public function messages(){
		return [
			'slider_name.required' => 'Chưa nhập Slider name',
			'slider_dir.required' => 'Chưa nhập Slider dir',
			'slider_image.required' => 'Chưa nhập Slider image'
		];
	}

}
