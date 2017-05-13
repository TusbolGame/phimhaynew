<?php namespace App\Lib\GetLinkVideo;
/**
* 
*/
class GetLinkVideo
{
	protected $src_2160 = '2160';
	protected $src_1080 = '1080p';
	protected $src_720 = '720p';
	protected $src_480 = '480p';
	protected $src_360 = '360p';
	protected $src_video_json = null;
	protected $vidcode = [
	 	//2D Non-DASH
        '18'	=> '360p',
        '59'	=> '480p',
        '22'	=> '720p',
        '37'	=> '1080p',
        //3D Non-DASH
        '82'	=> '360p',
        '83'	=> '240p',
        '84'	=> '720p',
        '85'	=> '1080p'
    ];
    protected $itag = [
		37,
		22,
		59,
		18
	];
	protected $cookie = ['data' => null, 'expires' => 'Session', 'domain' => '.drive.google.com'];
	//
	public function getCookie(){
		return $this->cookie;
	}
	protected function curl($url) {
	    $ch = @curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    $head[] = "Connection: keep-alive";
	    $head[] = "Keep-Alive: 300";
	    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	    $head[] = "Accept-Language: en-us,en;q=0.5";
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
	    $page = curl_exec($ch);
	    curl_close($ch);
	    return $page;
	}
	protected function curlGetCookie($url) {
	    $ch = @curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    $head[] = "Connection: keep-alive";
	    $head[] = "Keep-Alive: 300";
	    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	    $head[] = "Accept-Language: en-us,en;q=0.5";
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
	    curl_setopt($ch, CURLOPT_HEADER, 1); //set get cookie
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
	    $page = curl_exec($ch);
	    curl_close($ch);
	    //
	    // var_dump($page);
	    // $c = explode('Set-Cookie: ', $page);
	    // unset($c[0]);
	    // if(isset($c[2])){
	    // 	$c1 = explode('HttpOnly', $c[2]);
	    // 	$c[2] = $c1[0];
	    // }
	    
	    // var_dump($c);
	    //
	    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $page, $matches);// get cookie
		$cookies = array();
		// var_dump($matches);exit;
		foreach($matches[1] as $item) {
		    parse_str($item, $cookie);
		    $cookies = array_merge($cookies, $cookie);
		}
		//save cookie
		foreach ($cookies as $key => $value) {
			$this->cookie['data'][$key] = $value;
		}
		// var_dump($this->cookie);exit;
	    return $page;
	}
	/* get video youtube */
	//
	protected function getIdYoutube($link){
	    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $id);
	    if(!empty($id)) {
	        return $id = $id[0];
	    }
	    return $link;
	}
	//get link mp4 youtube, error
	protected function getLinkVideoYoutube($link) {
	    $id = getIdYoutube($link);
	    $getlink = "https://www.youtube.com/watch?v=".$id;
	    if ($get = $this->curl($getlink )) {
	        $return = array();
	        if (preg_match('/;ytplayer\.config\s*=\s*({.*?});/', $get, $data)) {
	            $jsonData  = json_decode($data[1], true);
	            $streamMap = $jsonData['args']['url_encoded_fmt_stream_map'];
	            foreach (explode(',', $streamMap) as $url)
	            {
	                $url = str_replace('\u0026', '&', $url);
	                $url = urldecode($url);
	                parse_str($url, $data);
	                $dataURL = $data['url'];
	                unset($data['url']);
	                $return[$data['quality']."-".$data['itag']] = $dataURL.'&'.urldecode(http_build_query($data));
	            }
	        }
	        return $return;
	    }else{
	        return 0;
	    }
	}
	/*
	print_r cái $data[1] ra là thấy đó:
	$title = $jsonData[‘args’][‘title’];
	$thumbnail = $jsonData[‘args’][‘thumbnail_url’];
	*/
	function getLinkVideoGooglePhotos($link){
	    $get = $this->curl($link);
	    $data = explode('url\u003d', $get);
	    $url = explode('%3Dm', $data[1]);
	    $decode = urldecode($url[0]);
	    $count = count($data);
	    $this->src_video_json = array();
		if($count > 4) {
	        $v1080p = $decode.'=m37';
	        $v720p = $decode.'=m22';
	        $v360p = $decode.'=m18';
	        $this->src_video_json[$this->src_1080] = $v1080p;
	        $this->src_video_json[$this->src_720] = $v720p;
	        $this->src_video_json[$this->src_360] = $v360p;
	    }
	    if($count > 3) {
	        $v720p = $decode.'=m22';
	        $v360p = $decode.'=m18';
	        $this->src_video_json[$this->src_720] = $v720p;
	        $this->src_video_json[$this->src_360] = $v360p;
	    }
	    if($count > 2) {
	        $v360p = $decode.'=m18';
	        $this->src_video_json[$this->src_360] = $v360p;
	    }
	    // var_dump($this->src_video_json);
	    //return $this->src_video_json;
	    // save data var json
	    //return $this->src_video_json;
	}
	/* link dang link chia sẻ file video
	https://drive.google.com/file/d/0B1xQLLJtrzJoaUYtcDlWMmlyNjQ/view
	và hàm này sẽ trả về 
	https://googledrive.com/host/0B1xQLLJtrzJoaUYtcDlWMmlyNjQ
	Dùng hàm nó sẽ chuyển: https://drive.google.com/file/d/ID/view thì nó sẽ trả về https://googledrive.com/host/ID
	//link nay se bi ngung suport den het ngay 31-8-2016
	*/
	//ko dung dc
	protected function getLinkVideoGoogleDriveReturnLinkVideo($link)
	{
	    if(preg_match('/.*drive.google.com\/.*\/(.*?)\/.*/is', $link, $id)){
	        return 'https://googledrive.com/host/'.$id[1];
	    }else{
	        return false;
	    }
	    
	}
	public function getDriveIdFromUrlDrive($url){
		$path = parse_url($url);
		$path_data = explode('/', $path['path']);
		// var_dump(count($path_data));
		if(count($path_data) == 5){
			//id la 3
			return $path_data[3];
		}
		return false;
	}
	public function getLinkDriveUseProxy($url){
		$id = $this->getDriveIdFromUrlDrive($url);
		if(!$id){
			die('Sai id');
			exit;
		}
		$data = $this->curlGetCookie('https://drive.google.com/e/get_video_info?docid='.$id);
		// var_dump($data);
		$content = explode('status=ok', $data);
		if(count($content) == 2){
			//
			parse_str($content[1], $tag);
			// var_dump($tag);
			// $source_video = null;
			if(isset($tag['fmt_stream_map'])){
				$data_source = explode(',', $tag['fmt_stream_map']);
				foreach ($data_source as $url) {
					list($itag,$link) = explode('|', $url);
					if(in_array($itag, $this->itag)){
						// $source_video[$this->vidcode[$itag]] = $link;
						// $source_video[$this->vidcode[$itag]] = $link;
						$this->src_video_json[$this->vidcode[$itag]] = $link;
					}
				}
			}
			// var_dump($source_video);
		}
	}
	function getLinkDriveEmbedYoutube($url){
		//https://drive.google.com/file/d/0B5vaC4qOISLQSTk1ZjNnOUJJVVE/view
		$path = parse_url($url);
		$path_data = explode('/', $path['path']);
		// var_dump(count($path_data));
		if(count($path_data) == 5){
			//id la 3
			$drive_id = $path_data[3];
			return 'https://youtube.googleapis.com/embed/?status=ok&hl=en&allow_embed=0&ps=docs&partnerid=30&autoplay=0&docid='.$drive_id.'&abd=0&public=false&el=leaf&title=Video.mp4';
		}
		return null;

	}
	//error
	function getLinkVideoGoogleDrive($curl){ 
	    $get = file_get_contents($curl); 
	    $cat = explode(',["fmt_stream_map","', $get); 
	    $cat = explode('"]', $cat[1]); 
	    $cat = explode(',', $cat[0]);
	    $f360p = null;
	    $f480p = null;
	    $f720p = null;
	    $f1080p = null;
	    $f2160p = null;
	    foreach($cat as $link){ 
	        $cat = explode('|', $link); 
	        $links = str_replace(array('\u003d', '\u0026'), array('=', '&'), $cat[1]); 
	        if($cat[0] == 37) {$f1080p = $links;} 
	        if($cat[0] == 22) {$f720p = $links;} 
	        if($cat[0] == 35) {$f480p = $links;} 
	        if($cat[0] == 43) {$f360p = $links;} 
	    }
	   	$this->src_video_json = array();
	    if(isset($f1080p)){ 
	    	$this->src_video_json[$this->src_360] = $f360p;
	    	$this->src_video_json[$this->src_480] = $f480p;
	    	$this->src_video_json[$this->src_720] = $f720p;
	    	$this->src_video_json[$this->src_1080] = $f1080p;
	        //$AnimeVN = "<source src=\"".$f1080p."\" type=\"video/mp4\" data-res=\"1080\" />\n<source src=\"".$f720p."\" type=\"video/mp4\" data-res=\"720\" />\n<source src=\"".$f480p."\" type=\"video/mp4\" data-res=\"480\" />\n<source src=\"".$f360p."\" type=\"video/mp4\" data-res=\"360\" />"; 
	    } elseif(isset($f720p)){
	    	$this->src_video_json[$this->src_360] = $f360p;
	    	$this->src_video_json[$this->src_480] = $f480p;
	    	$this->src_video_json[$this->src_720] = $f720p;
	    } elseif(isset($f480p)){
	     	$this->src_video_json[$this->src_360] = $f360p;
	    	$this->src_video_json[$this->src_480] = $f480p;
	    } elseif(isset($f360p)){ 
	    	$this->src_video_json[$this->src_360] = $f360p;
	    } 
	}
	//http://blog-hxplugin.rhcloud.com/huong-dan-viet-code-get-link-google-picasaweb
	function getLinkVideoGooglePicasa($link) {
	    $url = urldecode($link);
	    if (stristr($url, '#')) list($url, $id) = explode('#', $url); //Nếu link albums nhiều video thì sẽ lấy ID video để tìm.
	    $data = file_get_contents($url); //Get html của link
	    if($id) $source = explode($id, $data);// Tìm đoạn chứa link của video theo ID
	    if($source[7] != ''){
	        $source = explode('{"url":"', ($id)?$source[7]:$data);
	    }else{
	        $source = explode('{"url":"', ($id)?$source[6]:$data);
	    }
	    // Phân link ra thôi
	    $v360p = urldecode(reset(explode('"', $source[2])));
	    $v720p = urldecode(reset(explode('"', $source[3])));
	    $v1080p = urldecode(reset(explode('"', $source[4])));
	    if(strpos($v1080p, 'redirector') || strpos($v1080p, '=m32') || strpos($v1080p, '=m37') || strpos($v1080p, 'googlevideo.com')){
	        $data = '1080p: '.$v1080p.'<br>720p: '.$v720p.'<br>360p: '.$v360p;
	    } elseif(strpos($v720p, 'redirector') || strpos($v720p, '=m22')  || strpos($v720p, 'googlevideo.com')){
	        $data = '720p: '.$v720p.'<br>360p: '.$v360p;
	    } else {
	        $data = '360p: '.$v360p;
	    }
	    return $data;
	    /*

	    playlist: [{
	        sources: [{
	            file: "//mySite.com/myFile360.mp4", lable: "360p", type: "mp4"
	        },{
	            file: "//mySite.com/myFile720.mp4", lable: "720p", type: "mp4"
	        }]
	}],
	*/
	}
	//get remote server blogit, 
	//https://api.blogit.vn/getlink.php?lin
	//https://videoapi.io/api/get/?link=
	//error chua fix-->difference response return, ko co status...
	public function getLinkVideoByBlogIt($link_api, $link){
    	$this->setSrcVideoJsonNull();
    	//
    	$api = $link_api.$link;
		$curl = $this->curl($api);
		$data = json_decode($curl);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		if($data->status == 1){
			//get link thanh cong
			$src = $data->result->data->link;
			// var_dump($src);
			foreach ($src as $src_item) {
				
				$this->src_video_json[$src_item->label.'p'] = $src_item->file;
			}
			return true;
		}
		return false;
		// Lúc trả về kết quả cần chú ý
		// status:
		// 1: get link thành công
		// 0: get link lỗi
		// result:
		// server: tên server
		// data: dữ liệu
		// time_request: thời gian gửi lên api
		// link: link gốc gửi lên api
		// error(nếu có): Thông báo lỗi nếu có
    }
    public function getLinkVideoIo($link){
    	$this->setSrcVideoJsonNull();
    	//
    	$api_video_io = env('GET_LINK_REMOTE_API').$link;
		$curl = @file_get_contents($api_video_io);
		$data = json_decode($curl);
		// var_dump($data);die();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		if(count($data) >= 1){
			//get link thanh cong
			foreach ($data as $src_item) {
				
				$this->src_video_json[$src_item->label.'p'] = $src_item->file;
			}
			// var_dump($this->src_video_json);die();
			return true;
		}
		return false;
    }
    protected function setSrcVideoJsonNull(){
    	$this->src_video_json = null;
    }
    public function getSrc2160()
    {
    	if(isset($this->src_video_json[$this->src_2160])){
    		return $this->src_video_json[$this->src_2160];
    	}else{
    		return false; // ko có j xảy ra
    	}
    }
    // trả về src nếu tồn tại, else return false
    public function getSrc1080()
    {
    	if(isset($this->src_video_json[$this->src_1080])){
    		return $this->src_video_json[$this->src_1080];
    	}else{
    		return false; // ko có j xảy ra
    	}
    }
    // trả về src nếu tồn tại, else return false
    public function getSrc720()
    {
    	if(isset($this->src_video_json[$this->src_720])){
    		return $this->src_video_json[$this->src_720];
    	}else{
    		return false;
    	}
    }
    public function getSrc480()
    {
    	if(isset($this->src_video_json[$this->src_480])){
    		return $this->src_video_json[$this->src_480];
    	}else{
    		return false;
    	}
    }
    public function getSrc360()
    {
    	if(isset($this->src_video_json[$this->src_360])){
    		return $this->src_video_json[$this->src_360];
    	}else{
    		return false; // ko có j xảy ra
    	}
    }
    public function getSrcVideoJson()
    {
    	if(!empty($this->src_video_json)){
    		return $this->src_video_json;
    	}else{
    		return false; // ko có j xảy ra
    	}
    }
}

 ?>