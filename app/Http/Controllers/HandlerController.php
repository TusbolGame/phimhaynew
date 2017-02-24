<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HandlerController extends Controller {

	//
	//
	public function get403(){
		return view('phimhay.include.403');
	}
	public function get404(){
		return view('phimhay.include.404');
	}
	public function get500(){
		return view('phimhay.include.500');
	}
}
