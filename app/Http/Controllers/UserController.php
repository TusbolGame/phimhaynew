<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeInfoUserRequest;
use App\Http\Requests\AdminAddUserRequest;
use App\User;
use App\FilmUserTick;
use App\FilmUserWatch;
use App\SocialAccount;
use App\Role;
use Hash;
use Auth;
use Validator;
use Input;
use File;
use Intervention\Image\Facades\Image;
use Cache;

class UserController extends Controller {

	protected $user_permission;

	public function __construct(){
		$this->user_permission = Cache::get('user_permission_'.Auth::user()->id);
	}
	//
	//add
	public function getAdd(){
		//check permission
		if(!isset($this->user_permission['createUser'])){
			return response()->view('phimhay.include.403', [], 403);
		}
		$role = Role::where('role_name', '!=', 'Superadmin')->get();
		return view('admin.user.add', compact('role'));
	}
	public function postAdd(AdminAddUserRequest $request){
		//check permission
		if(!isset($this->user_permission['createUser'])){
			return response()->view('phimhay.include.403', [], 403);
		}
		//check role
		$check = Role::find($request->role_id);
		if(count($check) == 0 && $check->role_name != 'Superadmin'){
			return redirect()->back()->withErrors('Role chọn không tồn tại');
		}
		if($check->role_name == 'Superadmin'){
			return redirect()->back()->withInput()->withErrors('Lỗi! Không được phép chọn Superadmin');
		}
		$user = new User();
		$user->username = $request->txtUsername;
		$user->password = Hash::make($request->txtPass);
		$user->first_name = $request->txtFirstName;
		$user->Last_name = $request->txtLastName;
		$user->email = $request->txtEmail;
		$user->actived = $request->rdoActived;
		$user->blocked = $request->rdoBlocked;
		//remember
		$user->remember_token = $request->_token;
		$user->save();
		//add role
		\App\UserRole::insert(['user_id' => $user->id, 'role_id' => $request->role_id]);
		//
		return redirect()->route('admin.user.getList')->with(['flash_message'=>'Thành công ! Thêm thành viên mới: '.$request->txtUsername]);
	}
	//list
	public function getList(){
		//check permission
		if(!isset($this->user_permission['showUser'])){
			return response()->view('phimhay.include.403', [], 403);
		}
		$users = User::select('id', 'username', 'first_name', 'last_name', 'email', 'level', 'actived', 'blocked', 'created_at', 'updated_at')->orderBy('id', 'DESC')->with('socialAccount', 'userRole.role')->paginate(10);
		// dump($users);die();
		$users->setPath(route('admin.user.getList'));
		return view('admin.user.list', compact('users'));
	}
	//edit
	public function getEdit($id){
		//check permission
		if(!isset($this->user_permission['editUser'])){
			return response()->view('phimhay.include.403', [], 403);
		}
		$user = User::findOrFail($id);
		$role = Role::where('role_name', '!=', 'Superadmin')->get();
		return view('admin.user.edit', compact('user', 'id', 'role'));
	}
	//fix lại
	public function postEdit($id, Request $request){
		//check permission
		if(!isset($this->user_permission['editUser'])){
			return response()->view('phimhay.include.403', [], 403);
		}
		$user = User::findOrFail($id);
		$v = null;
		//only admin can edit me
		if(Auth::user()->id == $id){
			if(Input::has('chkEditPassword')){
				//have edit pass
				$v = Validator::make($request->all(), [
					'txtFirstName' => 'required',
					'txtLastName' => 'required',
					'txtEmail' => 'required|email',
					'txtPassOld' => 'required',
				 	'txtPass' => 'required|min:8|max:30',
				 	'txtRePass' => 'required|same:txtPass'
				], 
				[
					'txtPassOld.required' => 'Chưa nhập Mật khẩu cũ',
					'txtPass.required' => 'Chưa nhập Mật khẩu',
					'txtPass.min' => 'Mật khẩu tối thiểu 8 ký tự',
					'txtPass.max' => 'Mật khẩu tối đa 30 ký tự',
					'txtRePass.required' => 'Chưa nhập xác nhận mật khẩu',
					'txtRePass.same' => 'Mật khẩu xác nhận không đúng',
					'txtFirstName.required' => 'Chưa nhập Tên',
					'txtLastName.required' => 'Chưa nhập Họ',
					'txtEmail.required' => 'Chưa nhập Email',
					'txtEmail.email' => 'Đây không phải là Email'
				]);
			}else{
				$v = Validator::make($request->all(), [
					'txtFirstName' => 'required',
					'txtLastName' => 'required',
					'txtEmail' => 'required|email',
				], [
						'txtFirstName.required' => 'Chưa nhập Tên',
						'txtLastName.required' => 'Chưa nhập Họ',
						'txtEmail.required' => 'Chưa nhập Email',
						'txtEmail.email' => 'Đây không phải là Email'
				]);
			}
			//check email		
			if($request->txtEmail != '' && $request->txtEmail != Auth::user()->email){
				//
				$tt = User::where('id', '!=', Auth::user()->id)->where('email', $request->txtEmail)->get();
				if(count($tt) >= 1){
					return redirect()->back()->withInput()->withErrors('Email đã tồn tại');
				}
				unset($tt);
				$user->email = $request->txtEmail;
			}
		}
		//hiển thị thông báo lỗi
		if ($v != null && $v->fails()) {
			return redirect()->back()->withInput()->withErrors($v->errors());
		}
		
		if(Input::has('chkEditPassword')){
			if(!Hash::check($request->txtPassOld, $user->password)){
				return redirect()->back()->withErrors('Mật khẩu nhập không đúng');
			}
			$user->password = Hash::make($request->txtPass);
		}
		$user->first_name = $request->txtFirstName;
		$user->Last_name = $request->txtLastName;
		$user->email = $request->txtEmail;
		//is user -> not edit role, block, active of chinh minh
		if(Auth::user()->id != $id){
			//check role
			$role = Role::findOrFail($request->role_id);
			//is role
			//check not superadmin
			if($role->role_name == 'Superadmin'){
				return redirect()->back()->withInput()->withErrors('Lỗi! Không được phép chọn Superadmin');
			}
			$user_role = \App\UserRole::where('user_id', $id)->first();
			$user_role->role_id = $role->id;
			$user_role->save();

			$user->actived = $request->rdoActived;
			$user->blocked = $request->rdoBlocked;
		}
		//remember
		$user->remember_token = $request->_token;
		$user->save();
		if(Cache::has('user_permission_'.$id)){
			//update time cache, if change role id -> delete cache user update
			Cache::forget('user_permission_'.$id);
		}
		//
		return redirect()->route('admin.user.getList')->with(['flash_message'=>'Thành công ! Cập nhật User '.$id]);
	}
	//delete
	public function getDelete($id){
		//check permission
		if(!isset($this->user_permission['deleteUser'])){
			return response()->view('phimhay.include.403', [], 403);
		}
		$user = User::find($id);
		//if supperadmin, id == 1 --> xoa admin +member
		//admin --> xoa member
		// neu la admin ma ko phai la supperadmin va ko dc xoa supperadmin, admin khac
		if(Auth::user()->id == $id){
			return redirect()->route('admin.user.getList')->with(['flash_message_error'=>'Fail! Không thể delete chính mình']);
		}
		//xoa
		$user->delete($id);
		//delete cache
		if(Cache::has('user_permission_'.$id)){
			//update time cache, if change role id -> delete cache user update
			Cache::forget('user_permission_'.$id);
		}
		return redirect()->route('admin.user.getList')->with(['flash_message'=>'Success ! Complete Deleted User ID '.$id.'!']);
	}
	//search
	public function getSearch(){
		//check permission
		if(!isset($this->user_permission['showUser'])){
			return response()->view('phimhay.include.403', [], 403);
		}
		return view('admin.user.search');
	}


	//
	public function getProfile($id){
		if($id != Auth::user()->id){
			//403, permission
			return redirect()->route('403');
		}
		//hash email
		$email = null;
		if (!empty(Auth::user()->email)) {
			$data = explode('@', Auth::user()->email);
			if(count($data) == 2){
				$name_hash_star = str_repeat('*', strlen($data[0])-2);
				$email = substr($data[0], 0, 2).$name_hash_star.'@'.$data[1];
			}
		}
		$film_user_tick = FilmUserTick::where('user_id', Auth::user()->id)->orderByRaw('RAND()')->take(10)->with('filmList')->get();
		$total_user_tick = FilmUserTick::where('user_id', Auth::user()->id)->count();
		$film_user_watch = FilmUserWatch::where('user_id', Auth::user()->id)->orderByRaw('RAND()')->take(10)->with('filmList')->get();
		$total_user_watch = FilmUserWatch::where('user_id', Auth::user()->id)->count();
		return view('phimhay.user.profile', compact('email', 'film_user_tick', 'total_user_tick', 'film_user_watch', 'total_user_watch'));
	}
	public function postChangePassword(ChangePasswordRequest $request){
		//check pass
		if(!Hash::check($request->password, Auth::user()->password)){
			return redirect()->back()->withErrors('Mật khẩu không đúng');
		}
		//chage pass
		$user = User::find(Auth::user()->id);
		$user->password = Hash::make($request->password_new);
		$user->save();
		return redirect()->back()->with(['success' => 'Thay đổi mật khẩu thành công']);
	}
	public function postChangeInfo(ChangeInfoUserRequest $request){
		$user = User::find(Auth::user()->id);
		//check email		
		if($request->txtEmail != '' && $request->txtEmail != Auth::user()->email){
			//
			$tt = User::where('id', '!=', Auth::user()->id)->where('email', $request->txtEmail)->get();
			if(count($tt) >= 1){
				return redirect()->back()->withErrors('Email đã tồn tại');
			}
			unset($tt);
			$user->email = $request->txtEmail;
		}
		$user->first_name = (Auth::user()->first_name != $request->txtFirstName) ? $request->txtFirstName : Auth::user()->first_name; 
		$user->last_name = (Auth::user()->last_name != $request->txtLastName) ? $request->txtLastName : Auth::user()->last_name;
		//file
		$image = $request->file('fileImageUser');
		if (!empty($image)) {
            $extension  = $image->getClientOriginalName();
            $file_name = 'icon-user-'.Auth::user()->id.'.'.$extension;
            $path = public_path('../resources/photos/'.$file_name);
            //check if la icon-user-default.jpg thi not delete
            if($user->image != 'icon-user-default.jpg'){
            	//delete
            	if(File::exists('resources/photos/'.$file_name)){
            		File::delete('resources/photos/'.$file_name);
            	}
            }
			Image::make($image->getRealPath())->resize(140, 140)->save($path);			
            $user->image = $file_name;
		}
		$user->save();
		return redirect()->back()->with(['success' => 'Thay đổi thông tin thành công']);
	}
	public function postDelete(Request $request){		
		//check 
		if($request->password == ''){
			return redirect()->back()->withErrors('Chưa nhập mật khẩu');
		}
		//
		if(!Hash::check($request->password, Auth::user()->password)){
			return redirect()->back()->withErrors('Mật khẩu không đúng');
		}
		$user = User::find(Auth::user()->id);
		//logout
		Auth::logout();
		//delete
		$user->delete();
		return redirect()->route('home');
	}
	public function getFilmUserTick($id){
		if($id != Auth::user()->id){
			//403, permission
			return redirect()->route('403');
		}
		//
		$film_user_tick = FilmUserTick::where('user_id', $id)->with('filmList')->paginate(20);
		$film_user_tick->setPath(route('user.getFilmUserTick', $id));
		return view('phimhay.user.film-user-tick', compact('film_user_tick'));
	}
	public function getFilmUserWatch($id){
		if($id != Auth::user()->id){
			//403, permission
			return redirect()->route('403');
		}
		//
		$film_user_watch = FilmUserWatch::where('user_id', $id)->with('filmList')->paginate(20);
		$film_user_watch->setPath(route('user.getFilmUserWatch', $id));
		return view('phimhay.user.film-user-watch', compact('film_user_watch'));
	}
}
