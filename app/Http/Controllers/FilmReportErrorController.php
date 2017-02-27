<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\FilmReportError;
class FilmReportErrorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$film_report_error = FilmReportError::orderBy('id', 'DESC')->with('user')->paginate(15);
		// dump($film_report_error);die();
		$film_report_error->setPath(route('admin.report-error.index'));
		return view('admin.report-error.index', compact('film_report_error'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		$film_report_error = FilmReportError::where('id', $id)->with('filmList')->first();
		return view('admin.report-error.show', compact('film_report_error'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
		$film_report_error = FilmReportError::findOrFail($id);
		$film_report_error->delete();
		return redirect()->route('admin.report-error.index')->with(['flash_message' => 'Thành công| Đã xóa Report Id: '.$id]);
	}

	public function postDeleteArray(Request $request)
	{
		//
		if($request->report_error_id == ''){
			return redirect()->back()->with(['flash_message_error' => 'Lỗi| Không có Report Id để Delete ']);
		}
		$data_id = explode(',', $request->report_error_id);
		$film_report_error = FilmReportError::whereIn('id', $data_id)->delete();
		return redirect()->route('admin.report-error.index')->with(['flash_message' => 'Thành công| Đã xóa Report Id: '.$request->report_error_id]);
	}
	public function postReadArray(Request $request)
	{
		//
		if($request->report_error_id == ''){
			return redirect()->back()->with(['flash_message_error' => 'Lỗi| Không có Report Id để Đánh dấu đã xem ']);
		}
		$data_id = explode(',', $request->report_error_id);
		$film_report_error = FilmReportError::whereIn('id', $data_id)->update(['report_error_status' => 1]);
		return redirect()->route('admin.report-error.index')->with(['flash_message' => 'Thành công| Đã đánh dấu Report Id: '.$request->report_error_id]);
	}
	

}
