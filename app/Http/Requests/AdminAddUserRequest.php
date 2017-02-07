<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminAddUserRequest extends Request {

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
			'txtEmail' => 'required|email',
			'rdoLevel' => 'required',
			'rdoActived' => 'required',
			'rdoBlocked' => 'required',
		];
	}
	public function messages(){
		return [
			'txtUsername.required' => 'Please enter the Username',
			'txtUser.unique' => 'The Username has already been taken',
			'txtPass.required' => 'Please enter the Password',
			'txtRePass.required' => 'Please enter the Re Password',
			'txtRePass.same' => 'The RePassword not same Password',
			'txtFirstName.required' => 'Please enter the First Name',
			'txtLastName.required' => 'Please enter the Last Name',
			'txtEmail.required' => 'Please enter the Email',
			'txtEmail.email' => 'This the Email is not email',
			'rdoLevel.required' => 'Please enter the User Level',
			'rdoActived.required' => 'Please enter the Actived',
			'rdoBlocked.required' => 'Please enter the Blocked',
		];
	}
}
