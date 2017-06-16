<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//
use App\Http\Requests\AdminAddFilmSliderRequest;
//
use App\FilmSlider;
use Cache;
class FilmSliderController extends Controller {

	public function getAdd(){
		return view('admin.slider.add');
	}
	public function postAdd(AdminAddFilmSliderRequest $request){
		//check exist dir?
		$check = FilmSlider::where('slider_name', $request->slider_name)->select('id')->get();
		if(count($check) >= 1){
			//
			return redirect()->back()->withErrors('Tên Slider đã tồn tại')->withInput();
		}
		$slider = new FilmSlider();
		$slider->slider_name = $request->slider_name;
		$slider->slider_dir = $request->slider_dir;
		$slider->slider_image = $request->slider_image;
		$slider->save();
		//forget cache
		if(Cache::has('film_slider')){
			Cache::forget('film_slider');
		}
		//
		return redirect()->route('admin.slider.getList')->with(['flash_message'=>'Success ! Complete Add Slider new']);
	}
	public function getEdit($id){
		$slider = FilmSlider::find($id);
		return view('admin.slider.edit', compact('slider'));
	}
	public function postEdit($id, AdminAddFilmSliderRequest $request){
		$slider = FilmSlider::find($id);
		$slider->slider_name = $request->slider_name;
		$slider->slider_dir = $request->slider_dir;
		$slider->slider_image = $request->slider_image;
		$slider->save();
		//forget cache
		if(Cache::has('film_slider')){
			Cache::forget('film_slider');
		}
		//
		return redirect()->route('admin.slider.getList')->with(['flash_message'=>'Success ! Complete Edit Slider '.$id]);
	}
	public function getList(){
		$film_sliders = FilmSlider::all();
		return view('admin.slider.list', compact('film_sliders'));
	}
	public function getDelete($id){
		$slider = FilmSlider::find($id);
		$slider->delete();
		//forget cache
		if(Cache::has('film_slider')){
			Cache::forget('film_slider');
		}
		//
		return redirect()->route('admin.slider.getList')->with(['flash_message'=>'Success ! Complete Delete Slider']);
	}
}
