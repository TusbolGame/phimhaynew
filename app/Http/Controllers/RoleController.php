<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\PermissionRole;
use Auth;
use Cache;

class RoleController extends Controller {
	protected $role_important;

	public function __construct(){
		$this->role_important = ['Superadmin', 'Admin', 'Member'];
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//check permission
		if(!Auth::user()->hasPermission('showRole')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Show Role');
		}
		//
		$role = Role::where('id', '>=', 1)->with('permissionRole.permission')->get();
		// dump($role);
		return view('admin.role.index', compact('role'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//check permission
		if(!Auth::user()->hasPermission('createRole')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Create Role');
		}
		//
		$permission = Permission::all();
		return view('admin.role.create', compact('permission'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(!Auth::user()->hasPermission('createRole')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Create Role');
		}
		//
		if($request->role_name == ''){
			return redirect()->back()->withInput()->withErrors('Tên Role chưa được nhập');
		}
		$check = Role::where('role_name', $request->role_name)->count();
		if($check == 1){
			return redirect()->back()->withInput()->withErrors('Tên Role đã tồn tại');
		}
		$role = new Role();
		$role->role_name = $request->role_name;
		$role->role_description = $request->role_description;
		$role->save();
		//save permission
		if(count($request->permission_id) > 0){
			$permission_id = [];
			foreach ($request->permission_id as $key) {
				array_push($permission_id, ['permission_id' => $key, 'role_id' => $role->id]);
			}
			if(count($permission_id) >= 1){
				PermissionRole::insert($permission_id);
			}
		}
		//create cache role update
		Cache::forever('role_updated_at_'.$role->id, time());
		//
		return redirect()->route('admin.role.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//check permission
		if(!Auth::user()->hasPermission('editRole')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Edit Role');
		}
		
		//
		$role = Role::findOrFail($id);
		//check role important
		if(in_array($role->role_name, $this->role_important)){
			return redirect()->route('admin.role.index')->with(['flash_message_error' => 'Error! Role '.$role->role_name.' không được chỉnh sửa']);
		}
		$permission = Permission::all();
		//get permission of role
		$temp = Permission::whereHas('permissionRole', function($query) use($id){
			$query->where('role_id', $id);
		})->select('id')->get();
		$check_permission = [];
		foreach ($temp as $key) {
			$check_permission[$key->id] = true;
		}
		return view('admin.role.edit', compact('role', 'permission', 'check_permission'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//check permission
		if(!Auth::user()->hasPermission('editRole')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Edit Role');
		}
		$role = Role::find($id);
		if(count($role) == 0){
			return redirect()->back()->withInput()->withErrors('Role không tồn tại');
		}
		//
		if(in_array($role->role_name, $this->role_important)){
			return redirect()->route('admin.role.index')->with(['flash_message_error' => 'Error! Role '.$role->role_name.' không thể Update']);
		}
		//
		$role->role_name = $request->role_name;
		$role->role_description = $request->role_description;
		$role->save();
		//save permission
		//remove all permission
		PermissionRole::where('role_id', $role->id)->delete();
		if(count($request->permission_id) > 0){
			//create
			$permission_id = [];
			foreach ($request->permission_id as $key) {
				array_push($permission_id, ['permission_id' => $key, 'role_id' => $role->id]);
			}
			if(count($permission_id) >= 1){
				PermissionRole::insert($permission_id);
			}
		}
		//
		//update cache role update
		Cache::forever('role_updated_at_'.$role->id, time());
		//
		return redirect()->route('admin.role.index')->with(['flash_message' => 'Role '.$role->role_name.' đã được Update']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//check permission
		if(!Auth::user()->hasPermission('deleteRole')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Delete Role');
		}
		$role = Role::findOrFail($id);
		//check role important
		if(in_array($role->role_name, $this->role_important)){
			return redirect()->route('admin.role.index')->with(['flash_message_error' => 'Error! Role '.$role->role_name.' không thể Xóa']);
		}
		//change all users of role to default -> memeber ~ id 3
		\App\UserRole::where('role_id', $role->id)->update(['role_id' => 3]);
		//forget cache role updated
		Cache::forget('role_updated_at_'.$id);
		//
		$role->delete();
		return redirect()->route('admin.role.index')->with(['flash_message' => 'Đã xóa role '.$role->role_name]);
		//
	}

}
