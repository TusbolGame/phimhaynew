<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//
use App\Lib\SessionTimeouts\SessionActiveUser;
use Session;
use App\Lib\RandomGenerates\RandomGenerate;
use Illuminate\Http\Response;


class TestController extends Controller {

	//
	public function getTest(){
		
		
		// $user_encrypt = new UserEncrypt();
		// //create active_hash
		// $active_hash = $user_encrypt->getActivedHash(1, 'admin');
		// //connect db, save active_hash
		// $user = \App\User::find(1);
		// $user->active_hash = $active_hash;
		// $user->save();
		//redirect
		//return redirect()->route('auth.getActived', $active_hash);
		// $file_headers = @get_headers('https://r6---sn-a5mlrn76.c.docs.google.com/videoplayback?requiressl=yes&id=a1f82da9e8bedfbb&itag=22&source=webdrive&ttl=transient&app=texmex&ip=118.69.189.130&ipbits=8&expire=1468313947&sparams=expire,id,ip,ipbits,itag,mm,mn,ms,mv,nh,pl,requiressl,source,ttl&signature=764F967CA234BB42668637EA90A3D7DB4AC8F210.1FD6D08A489F840C013F199B308AB960130243BE&key=cms1&pl=21&redirect_counter=1&req_id=a40714e97662a3ee&cms_redirect=yes&mm=34&mn=sn-a5mlrn76&ms=ltu&mt=1468298343&mv=u&nh=IgpwcjAzLmhrZzAxKgkxMjcuMC4wLjE');
		$file_headers = @get_headers('http://stackoverflow.com/questions/442416/mysql-gui-tool-for-developing-commercial-application/442424#442424');
		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
		    //$exists = false;
		    echo 'not found';
		}
		else if(strpos($file_headers[0],'200')===false){
		    //$exists = true;
		    echo 'not ok';
		}

	}
}
