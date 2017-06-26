<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\FilmCountry;
use App\Lib\FilmProcess\FilmProcess;
use Cache;
use Auth;

class FilmCountryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Auth::user()->hasPermission('showCountry')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Show Country');
		}
		//
		$film_country = FilmCountry::all();
		return view('admin.country.list', compact('film_country'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!Auth::user()->hasPermission('createCountry')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Create Country');
		}
		//
		return view('admin.country.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(!Auth::user()->hasPermission('createCountry')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Create Country');
		}
		//check null
		if($request->country_name == ''){
			return redirect()->back()->withErrors('Chưa nhập tên quốc gia')->withInput();
		}
		//check existss
		$check = FilmCountry::where('country_name', $request->country_name)->get();
		if(count($check) > 0){
			return redirect()->back()->withErrors('Thất bại! Tên quốc gia đã tồn tại')->withInput();
		}
		//
		$film_process = new FilmProcess();
		$film_country = new FilmCountry();
		$film_country->country_name = $request->country_name;
		$film_country->country_alias = $film_process->getNameAlias($request->country_name);
		$film_country->save();
		//forget cache
		if(Cache::has('film_country')){
			Cache::forget('film_country');
		}
		return redirect()->route('admin.country.index')->with(['flash_message' => 'Thành công! Thêm mới Country name '.$request->country_name]);
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
		if(!Auth::user()->hasPermission('editCountry')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Edit Country');
		}
		//
		$film_country = FilmCountry::findOrFail($id);
		return view('admin.country.edit', compact('film_country'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		if(!Auth::user()->hasPermission('editCountry')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Edit Country');
		}
		//
		$film_process = new FilmProcess();
		$film_country = FilmCountry::findOrFail($id);
		$film_country->country_name = $request->country_name;
		$film_country->country_alias = $film_process->getNameAlias($request->country_name);
		$film_country->save();
		//forget cache
		if(Cache::has('film_country')){
			Cache::forget('film_country');
		}
		return redirect()->route('admin.country.index')->with(['flash_message' => 'Thành công! Cập nhật Country name: '.$request->country_name]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		if(!Auth::user()->hasPermission('deleteCountry')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Delete Country');
		}
		//check existss
		$film_country = FilmCountry::findOrFail($id);
		$film_country->delete();
		//forget cache
		if(Cache::has('film_country')){
			Cache::forget('film_country');
		}
		return redirect()->route('admin.country.index')->with(['flash_message' => 'Thành công! Xóa Country id: '.$id]);
	}

}
