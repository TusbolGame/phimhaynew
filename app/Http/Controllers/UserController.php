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
use Hash;
use Auth;
use Validator;
use Input;
use File;
use Intervention\Image\Facades\Image;

class UserController extends Controller {

	//
	//add
	public function getAdd(){
		return view('admin.user.add');
	}
	public function postAdd(AdminAddUserRequest $request){
		$user = new User();
		$user->username = $request->txtUsername;
		$user->password = Hash::make($request->txtPass);
		$user->first_name = $request->txtFirstName;
		$user->Last_name = $request->txtLastName;
		$user->email = $request->txtEmail;
		$user->level = $request->rdoLevel;
		$user->actived = $request->rdoActived;
		$user->blocked = $request->rdoBlocked;
		//remember
		$user->remember_token = $request->_token;
		$user->save();
		return redirect()->route('admin.user.getList')->with(['flash_message'=>'Thành công ! Thêm thành viên mới: '.$request->txtUsername]);
	}
	//list
	public function getList(){
		$users = User::select('id', 'username', 'first_name', 'last_name', 'email', 'level', 'actived', 'blocked', 'created_at', 'updated_at')->orderBy('id', 'DESC')->with('socialAccount')->paginate(10);
		// dump($users);die();
		$users->setPath(route('admin.user.getList'));
		return view('admin.user.list', compact('users'));
	}
	//edit
	public function getEdit($id){
		$user = User::findOrFail($id)->toArray();
		//admin bt, ko edit dc diff admin, supperadmin
		if(Auth::user()->id != 1 && ($id == 1 || ($user['level'] == 1) && Auth::user()->id != $id)){
			return redirect()->route('admin.user.getList')->with(['flash_message'=>'Lỗi ! Không thể cập nhật user '.$id.'! Bởi vì Admin không thể cập nhật Supperadmin hoặc không thể cập nhật Admin khác']);
		}
		return view('admin.user.edit', compact('user', 'id'));
	}
	//fix lại
	public function postEdit($id, Request $request){
		$user = User::findOrFail($id);
		if(Auth::user()->id != 1 && ($id == 1 || ($user->level == 1) && Auth::user()->id != $id)){
			return redirect()->route('admin.user.getList')->with(['flash_message'=>'Lỗi ! Không thể cập nhật user '.$id.'! Bởi vì Admin không thể cập nhật Supperadmin hoặc không thể cập nhật Admin khác']);
		}
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
					return redirect()->back()->withErrors('Email đã tồn tại');
				}
				unset($tt);
				$user->email = $request->txtEmail;
			}
		}
		//hiển thị thông báo lỗi
		if ($v != null && $v->fails()) {
			return redirect()->back()->withErrors($v->errors());
		}
		
		if(Auth::user()->id == $id){
			if(Input::has('chkEditPassword')){
				if(!Hash::check($request->txtPassOld, $user->password)){
					return redirect()->back()->withErrors('Mật khẩu nhập không đúng');
				}
				$user->password = Hash::make($request->txtPass);
			}
			$user->first_name = $request->txtFirstName;
			$user->Last_name = $request->txtLastName;
			$user->email = $request->txtEmail;
		}
		//is admin -> not edit level of chinh minh
		if(Auth::user()->id != $id && $id != 1){
			$user->level = $request->rdoLevel;	
			$user->actived = $request->rdoActived;
			$user->blocked = $request->rdoBlocked;
		}
		//remember
		$user->remember_token = $request->_token;
		$user->save();
		return redirect()->route('admin.user.getList')->with(['flash_message'=>'Thành công ! Cập nhật User '.$id]);
	}
	//delete
	public function getDelete($id){
		$user = User::find($id);
		//if supperadmin, id == 1 --> xoa admin +member
		//admin --> xoa member
		// neu la admin ma ko phai la supperadmin va ko dc xoa supperadmin, admin khac
		if(Auth::user()->id != 1 && ($id == 1 || $user->level == 1)){
			return redirect()->route('admin.user.getList')->with(['flash_message'=>'Fail ! Can\'t delete this user! Because Amin do not delete Supperadmin or do not delete diff Admin']);
		}
		//supperadmin, admin, ko dc xoa chinh no
		else if(Auth::user()->id == $id){
			return redirect()->route('admin.user.getList')->with(['flash_message'=>'Fail ! Can\'t delete this user! Because User do not delete this user']);
		}else{
			//xoa
			$user->delete($id);
			return redirect()->route('admin.user.getList')->with(['flash_message'=>'Success ! Complete Deleted User ID '.$id.'!']);
		}
	}
	//search
	public function getSearch(){
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
