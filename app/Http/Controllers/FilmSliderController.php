<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//
//
use App\FilmSlider;
use Cache;
use Auth;
use App\FilmList;

class FilmSliderController extends Controller {

	public function getAdd(){
		if(!Auth::user()->hasPermission('createSlider')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể thêm Slider');
		}
		$film_list = FilmList::orderBy('id', 'DESC')->select('id', 'film_name_en', 'film_name_vn', 'film_years')->paginate(10);
		$film_list->setPath(route('admin.slider.getAdd'));
		return view('admin.slider.add', compact('film_list'));
	}
	public function postAdd(Request $request){
		if(!Auth::user()->hasPermission('createSlider')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể thêm Slider');
		}
		//check exist dir?
		$check = FilmList::findOrFail($request->film_id);
		$slider = new FilmSlider();
		$slider->film_id = $request->film_id;
		$slider->save();
		//forget cache
		if(Cache::has('film_slider')){
			Cache::forget('film_slider');
		}
		//
		return redirect()->route('admin.slider.getList')->with(['flash_message'=>'Success ! Complete Add Slider new']);
	}
	public function getEdit($id){
		if(!Auth::user()->hasPermission('editSlider')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Update Slider');
		}
		$slider = FilmSlider::find($id);
		$film_list = FilmList::where('id', '!=', $slider->film_id)->orderBy('id', 'DESC')->select('id', 'film_name_en', 'film_name_vn', 'film_years')->paginate(10);
		$film_list->setPath(route('admin.slider.getEdit', $id));
		return view('admin.slider.edit', compact('slider', 'film_list'));
	}
	public function postEdit($id, Request $request){
		if(!Auth::user()->hasPermission('editSlider')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Update Slider');
		}
		$check = FilmList::findOrFail($request->film_id);
		$slider = FilmSlider::find($id);
		$slider->film_id = $request->film_id;
		$slider->save();
		//forget cache
		if(Cache::has('film_slider')){
			Cache::forget('film_slider');
		}
		//
		return redirect()->route('admin.slider.getList')->with(['flash_message'=>'Success ! Complete Edit Slider '.$id]);
	}
	public function getList(){
		if(!Auth::user()->hasPermission('showSlider')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Hiển thị Slider');
		}
		$film_sliders = FilmSlider::where('id', '>=', 1)->with('filmList')->get();
		return view('admin.slider.list', compact('film_sliders'));
	}
	public function getDelete($id){
		if(!Auth::user()->hasPermission('deleteSlider')){
			return redirect()->route('admin.getHome')->with('flash_message_error', '403! Không thể Delete Slider');
		}
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
