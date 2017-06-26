<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\FilmType;
use App\Lib\FilmProcess\FilmProcess;
use Cache;
use Auth;

class FilmTypeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Auth::user()->hasPermission('showType')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Show Type');
		}
		//
		// $film_type = FilmType::all();
		return view('admin.type.list');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!Auth::user()->hasPermission('createType')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Create Type');
		}
		//
		return view('admin.type.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(!Auth::user()->hasPermission('createType')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Create Type');
		}
		//
		//check null
		if($request->type_name == ''){
			return redirect()->back()->withErrors('Chưa nhập tên thể loại')->withInput();
		}
		//check existss
		$check = FilmType::where('type_name', $request->type_name)->get();
		if(count($check) > 0){
			return redirect()->back()->withErrors('Thất bại! Tên thể loại đã tồn tại')->withInput();
		}
		//
		$film_process = new FilmProcess();
		$film_type = new FilmType();
		$film_type->type_name = $request->type_name;
		$film_type->type_alias = $film_process->getNameAlias($request->type_name);
		$film_type->save();
		//forget cache
		if(Cache::has('film_type')){
			Cache::forget('film_type');
		}
		return redirect()->route('admin.type.index')->with(['flash_message' => 'Thành công! Thêm mới Type name '.$request->type_name]);
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
		if(!Auth::user()->hasPermission('editType')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Edit Type');
		}
		//
		$film_type = FilmType::findOrFail($id);
		return view('admin.type.edit', compact('film_type'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		if(!Auth::user()->hasPermission('editType')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Edit Type');
		}
		//
		$film_process = new FilmProcess();
		$film_type = FilmType::findOrFail($id);
		$film_type->type_name = $request->type_name;
		$film_type->type_alias = $film_process->getNameAlias($request->type_name);
		$film_type->save();
		//forget cache
		if(Cache::has('film_type')){
			Cache::forget('film_type');
		}
		return redirect()->route('admin.type.index')->with(['flash_message' => 'Thành công! Cập nhật Type: '.$request->type_name]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!Auth::user()->hasPermission('deleteType')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Delete Type');
		}
		//
		$film_type = FilmType::findOrFail($id);
		$film_type->delete();
		//forget cache
		if(Cache::has('film_type')){
			Cache::forget('film_type');
		}
		return redirect()->route('admin.type.index')->with(['flash_message' => 'Thành công! Xóa Type id: '.$id]);
	}

}
