<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//
use App\Lib\SessionTimeouts\SessionActiveUser;
use Session;
use App\Lib\RandomGenerates\RandomGenerate;
class TestController extends Controller {

	//
	public function getTest(){
		//var_dump(Session::all());
		//var_dump(time());
		// $ran = new RandomGenerate();
		// echo $ran->getGeneratePassword();
		// var_dump($ran->getGenerateString());
		//$active_timeout = new SessionActiveUser();
		//$active_timeout->createSessionUses(36, '140177bdab051564342aeb57028f2cc4__3b7ad9e43b88d20a9e4548818fa3eb13');
		//$active_timeout->forgetSessionUses();
		// if ($active_timeout->checkSessionUses()) {
		// 	echo 'true';
		// }
		// echo 'ko';
		//return view('phimhay.home');
		//set POST variables
		$data = [ 
			'Category' => 42,
			'PageSize' => 30,
			'PageIndex' => 2
		];
		$val = http_build_query($data);
		$ch =  curl_init('');
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $val);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		var_dump($result);
		curl_close($ch);
	}
}
