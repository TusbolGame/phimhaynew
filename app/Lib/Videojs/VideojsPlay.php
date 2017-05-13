<?php namespace App\Lib\Videojs;
/**
* Class video js
* Chú ý, phải đưa các file video-js.css và file videojs-resolution-switcher.css
	vào <head> trước khi sử dụng
*/
class VideojsPlay
{
	protected $id_video = 'my_video'; // default
	protected $src144 = ''; // phone
	protected $src360 = ''; // 
	protected $src480 = '';
	protected $src720 = ''; //
	protected $src1080 = '';
	protected $src2160 = '';
	protected $src_youtube = '';
	protected $src_track_vtt = ''; // file .vtt
	protected $track_vtt_language = 'vi'; //default vi
	protected $src_track_ass = ''; // file .ass .ssa
	protected $support_not = '<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that
				<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>';
    protected $qc_src = '';
    protected $qc_link_chuyen = '';
    protected $src_poster = '';
    //dir_index
    protected $dir_index = ''; //bình thường require ở index

	public function setDirIndex($dir = ''){
		$this->dir_index = $dir;
		?>
		<!-- style videojs -->
		<link rel="stylesheet" type="text/css" href="<?php echo $this->dir_index; ?>videojs/video-js.css">
		<!-- style resolution switcher -->
		<link rel="stylesheet" type="text/css" href="<?php echo $this->dir_index; ?>videojs/videojs-resolution-switcher.css">
		<!-- videojs js -->
		<script src="<?php echo $this->dir_index; ?>videojs/video.js"></script>
		<!-- videojs flash -->
		<script>
		    videojs.options.flash.swf = "<?php echo $this->dir_index; ?>videojs/video-js.swf";
		</script>
		<!-- videojs resolution switcher js -->
		<script src="<?php echo $this->dir_index; ?>videojs/videojs-resolution-switcher.js"></script>
		<?php
	}
	public function getDirIndex(){
		return $this->dir_index;
	}
	/* ads video error, track ok*/
	public function videoFlash(){
		$this->addLibTrackAss();
		?>
		<video id="<?php echo $this->getIdVideo(); ?>" class="video-js vjs-default-skin vjs-big-play-centered"
			<?php 
			//set poster
			$this->getPosterVideo();
			 ?>
		>
			<?php 
			// add not support
	    	echo $this->support_not;
			 ?>
		</video>
		<script>
			videojs('<?php echo $this->getIdVideo(); ?>', {
				controls: true,
				preload: 'auto', // bắt buộc khi dùng flash
				width: 640,
				height: 264,
				"fluid": true,
				techOrder: ['flash'],
				plugins: {
					videoJsResolutionSwitcher: {
						default: 'low',
						dynamicLabel: true
					}
					// track ass
			        <?php 
			        	$this->addTrackASS();
			        ?>
				}
				}, function(){
					var player = this;
					window.player = player;
					player.updateSrc([
					<?php 
						$this->addAllSrcScript();
					?>
					]);		
			});
		  </script>
		<?php
		// add quang cao, but có lỗi về ko chạy time video
		//$this->addQuangCaoVideo();
		// disable event click mouse right
		$this->setEventClickDisableMouseRightVideo();
	}
	//
	public function videoYoutubeScript()
	{
		//
		$this->addLibTrackAss();		
		?>
		<script src="<?php echo $this->dir_index; ?>videojs/youtube.js"></script>
		<video id="<?php echo $this->getIdVideo(); ?>" class="video-js vjs-default-skin vjs-big-play-centered"
			<?php 
			//set poster
			$this->getPosterVideo();
			 ?>
		>
		<?php 
		// add not support
	    echo $this->support_not;
		// add track, neu co, neu ko thi bo qua
		$this->addTrackVTT();
		 ?>
		</video>
		<script> // error script
		    videojs('<?php echo $this->getIdVideo(); ?>', {
		        controls: true,
		        width: 640,
		        height: 264,
		        "fluid": true,
		        techOrder:  ["youtube"],
		        sources: [{ "type": "video/youtube", "src": "<?php echo $this->getSrcYoutube(); ?>"}],
				plugins: {
					videoJsResolutionSwitcher: {
						default: 'low',
						dynamicLabel: true
					}
					// track ass
			        <?php 
			        	$this->addTrackASS();
			        ?>
				}
				}, function(){
					var player = this;
					player.on('resolutionchange', function(){
					console.info('Source changed');
					});
				});
		</script>	
		<?php
		// disable event click mouse right
		$this->setEventClickDisableMouseRightVideo();
	}
	//error ads video, tag video not support ass
	public function videoYoutubeTagVideo()
	{
		?>
		<script src="<?php echo $this->dir_index; ?>videojs/youtube.js"></script>
		<video
		    id="<?php echo $this->getIdVideo(); ?>"
		    class="video-js vjs-default-skin"
		    controls
		    width="640" height="264"
		    <?php 
			//set poster
			$this->getPosterVideo();
			 ?>
		    data-setup='{"fluid": true, "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "<?php echo $this->getSrcYoutube(); ?>"}] }'
		  >
		 <?php 
		// add not support
	    echo $this->support_not;
		// add track, neu co, neu ko thi bo qua
		$this->addTrackVTT();
		 ?>
		</video>
		<script>
    		videojs('<?php echo $this->getIdVideo(); ?>').videoJsResolutionSwitcher();
		</script>
		<?php
		// disable event click mouse right
		$this->setEventClickDisableMouseRightVideo();
	}
	//tag video is not support track ass
	public function videoHtml5TagVideo()
	{
		// $this->addLibTrackAss();
		//add lib, if exist --> add, else no
		$this->addStyleQuangCaoVideo();
		//
		?>
		<video id="<?php echo $this->getIdVideo(); ?>" class="video-js vjs-default-skin vjs-big-play-centered" width="640" height="264" controls
		<?php 
			//set poster
			$this->getPosterVideo();
		?>
		data-setup='{"fluid": true}'>
		<?php 
			// hiển thị source
			$this->addAllSrcTagVideo(); 
    		// add not support
    		echo $this->support_not;
			// add track, neu co, neu ko thi bo qua
			$this->addTrackVTT();
		?>
		</video>
		<script>//add lib ass
	    	videojs('<?php echo $this->getIdVideo(); ?>').videoJsResolutionSwitcher();
	    	// videojs('<?php echo $this->getIdVideo(); ?>', {
	    	// 	plugins : {
	    	// 		ass: {
	    	// 			src:{"https://sunnyli.github.io/videojs-ass/subs/OuterScienceSubs.ass"}, 
	    	// 			delay: -0.1
	    	// 		}
	    	// 	}
	    	// });
		</script>
		<?php
		// add quang cao
		$this->addQuangCaoVideo();
		// disable event click mouse right
		$this->setEventClickDisableMouseRightVideo();
	}
	//good -> all
	public function videoHtml5Script()
	{
		//add lib, if exist --> add, else no
		$this->addStyleQuangCaoVideo();
		//
		$this->addLibTrackAss();
		?>
		<video id="<?php echo $this->getIdVideo(); ?>" class="video-js vjs-default-skin vjs-big-play-centered"
			<?php 
			//set poster
			$this->getPosterVideo();
			?>
		>
    		<?php 
    		// add not support
    		echo $this->support_not;
			// add track, neu co, neu ko thi bo qua
			$this->addTrackVTT();
		 	?>
		</video>
		<script>
		    		videojs('<?php echo $this->getIdVideo(); ?>', {
					controls: true,
					preload: 'auto',
					width: 640,
					height: 264,
					"fluid": true,
					plugins: {
						videoJsResolutionSwitcher: {
				        	default: 'low',
				        	dynamicLabel: true
			        	}
			        	// track ass
			        	<?php 
			        		$this->addTrackASS();
			        	 ?>
		      		}
			    }, function(){
			      	var player = this;
			      	window.player = player;
			      	player.updateSrc([
				        <?php 
				        // source
				        $this->addAllSrcScript();
				        ?>
			      	]);
			    });
		  </script>
		<?php
		//add quang cao
		$this->addQuangCaoVideo();
		// disable event click mouse right
		$this->setEventClickDisableMouseRightVideo();
	} // end function videoScriptStart
	public function videoIframe(){
		?>
		<iframe src="<?php echo $this->src_youtube; ?>" width="100%" height="315px" frameborder="0" allowfullscreen></iframe>
		<?php
	}
	protected function addAllSrcScript(){
		$this->setSrcScript($this->getSrc144(), 'video/mp4', '144', 144);
		$this->setSrcScript($this->getSrc360(), 'video/mp4', '360', 360);
		$this->setSrcScript($this->getSrc480(), 'video/mp4', '480', 480);
		$this->setSrcScript($this->getsrc720(), 'video/mp4', '720', 720);
		$this->setSrcScript($this->getSrc1080(), 'video/mp4', '1080', 1080);
		$this->setSrcScript($this->getSrc2160(), 'video/mp4', '2160', 2160);
	}
	protected function setSrcScript($src, $type, $label, $res)
	{
		if($src != ''){
			?>
			{
				src: '<?php echo $src; ?>',
				type: '<?php echo $type; ?>',
				label: '<?php echo $label; ?>',
				res: <?php echo $res; ?>
        	},
			<?php
		}
	} // end function setSrcScript
	protected function addAllSrcTagVideo()
	{
		$this->setSrcTagVideo($this->getSrc144(), 'video/mp4', '144', 144);
		$this->setSrcTagVideo($this->getSrc360(), 'video/mp4', '360', 360);
		$this->setSrcTagVideo($this->getSrc480(), 'video/mp4', '480', 480);
		$this->setSrcTagVideo($this->getsrc720(), 'video/mp4', '720', 720);
		$this->setSrcTagVideo($this->getSrc1080(), 'video/mp4', '1080', 1080);
		$this->setSrcTagVideo($this->getSrc2160(), 'video/mp4', '2160', 2160);
	}
	protected function setSrcTagVideo($src, $type, $label, $res)
	{
		if($src != ''){
			?>
			<source src="<?php echo $src; ?>" type='<?php echo $type; ?>' label='<?php echo $label; ?>' res='<?php echo $res; ?>' />
			<?php
		}// end if
	}
	// mặc định src là vi
	public function setSrcTrackVTT($src_track_vtt, $lang = 'vi')
	{
		$this->src_track_vtt = $src_track_vtt;
		$this->track_vtt_language = $lang;
	}
	protected function addTrackVTT()
	{
		if(!empty($this->getSrcTrackVTT())){
		?>
			<track kind="captions" src="<?php echo $this->getSrcTrackVTT(); ?>" 
			<?php if($this->getTrackVTTLanguage() == 'en'){ ?>
					srclang="en" label="English" 
					<?php } // end if($this->getTrackVTTLanguage() == 'en')
					else{ // nguoc lai la vietnamese, default
						?>
						srclang="vi" label="Vietnamese"
						<?php
					}
					 ?>
			default>
		<?php
		} // end if($this->getSrcTrackVTT()!='')
	}
	protected function getSrcTrackVTT(){
		return $this->src_track_vtt;
	}
	protected function getTrackVTTLanguage()
	{
		return $this->track_vtt_language;
	}
	public function setSrcTrackASS($src_track_ass)
	{
		$this->src_track_ass = $src_track_ass;
	}
	protected function getSrcTrackASS(){
		return $this->src_track_ass;
	}
	protected function addLibTrackAss(){
		if($this->getSrcTrackASS() != ''){
			?>
			<link rel="stylesheet" type="text/css" href="<?php echo $this->getDirIndex(); ?>libjass/libjass.css">
			<link rel="stylesheet" type="text/css" href="<?php echo $this->getDirIndex(); ?>videojs-ass-master/src/videojs.ass.css">
			<script src="<?php echo $this->getDirIndex(); ?>libjass/libjass.js"></script>
			<script src="<?php echo $this->getDirIndex(); ?>videojs-ass-master/src/videojs.ass.js"></script>
			<?php
		}
	}
	protected function addTrackASS()
	{
		if(!empty($this->getSrcTrackASS())){
			//neu ton tai --> add
			?>
			,ass: {
            	'src': ["<?php echo $this->getSrcTrackASS(); ?>"],
            	'delay': -0.1,
          	}
			<?php
		}
	}
	protected function setEventClickDisableMouseRightVideo()
	{
		?>
		<script>
		var myVideo = document.getElementById("<?php echo $this->getIdVideo(); ?>");
	    if (myVideo.addEventListener) {
	        myVideo.addEventListener('contextmenu', function(e) {
	            e.preventDefault();
	        }, false);
	    } else {
	        myVideo.attachEvent('oncontextmenu', function() {
	            window.event.returnValue = false;
	        });
	    }
	    </script>
	    <?php
	}
	public function setPosterVideo($srcposter)
	{
		$this->src_poster = 'poster="'.$srcposter.'"';
	}
	protected function getPosterVideo()
	{
		echo $this->src_poster;
	}
	public function setQuangCaoVideo($src, $link_chuyen)
	{
		$this->qc_src = $src;
		$this->qc_link_chuyen = $link_chuyen;
	}
	protected function addStyleQuangCaoVideo()
	{
		if($this->qc_src != ''){
			?>
			<link rel="stylesheet" type="text/css" href="<?php echo $this->getDirIndex(); ?>videojs/videojs.ads.css">
			<link rel="stylesheet" type="text/css" href="<?php echo $this->getDirIndex(); ?>videojs/videojs-preroll.css">
			<?php
		}
	}
	protected function addQuangCaoVideo()
	{
		//neu ton tai add qc
		if($this->qc_src != ''){
			?>
			<!-- lib quang cao -->
			<script src="<?php echo $this->dir_index; ?>videojs/videojs.ads.js"></script>
			<script src="<?php echo $this->dir_index; ?>videojs/videojs-preroll.js"></script>

		    <script>
		    	videojs('<?php echo $this->getIdVideo(); ?>').preroll({
			    	// link video quảng cáo
				    src:{src:"<?php echo $this->qc_src; ?>",type:"video/mp4"},
				    // trang sẽ chuyển đến khi click
				    href:"<?php echo $this->qc_link_chuyen; ?>",
				    // tắt chế độ thông báo
				    adsOptions: {debug:true}
		    		});
		    </script>
			<?php
		}
	}
	public function setSrc144($src)
	{
		$this->src144 = $src;
	}
	public function setSrc360($src)
	{
		$this->src360 = $src;
	}

	public function setSrc480($src)
	{
		$this->src480 = $src;
	}
	public function setSrc720($src)
	{
		$this->src720 = $src;
	}
	public function setSrc1080($src)
	{
		$this->src1080 = $src;
	}
	public function setSrc2160($src)
	{
		$this->src2160 = $src;
	}
	// add src youtube
	public function setSrcYoutube($src)
	{
		$this->src_youtube = $src;
	}
	protected function getSrcYoutube(){
		return $this->src_youtube;
	}
	public function setIdVideo($id)
	{
		$this->id_video = $id;
	}
	public function getIdVideo()
	{
		return $this->id_video;
	}
	protected function getSrc144(){
		return $this->src144;
	}
	protected function getSrc360(){
		return $this->src360;
	}
	protected function getSrc480(){
		return $this->src480;
	}
	protected function getSrc720(){
		return $this->src720;
	}
	protected function getSrc1080(){
		return $this->src1080;
	}
	protected function getSrc2160(){
		return $this->src2160;
	}
}
//use
// require 'VideojsPlay.php';
// $video = new VideojsPlay();
// $video->setDirIndex(''); //set dir lib
// //add poster
// $video->setPosterVideo('http://taihinhanhdep.xyz/wp-content/uploads/2016/03/anh-dep-tinh-yeu-lang-man-hoat-hinh.jpg');
// //set source
// $video->setSrc144('oceans.mp4');
// //... 360, 480...
// or video source youtube
// $video->setSrcYoutube('https://www.youtube.com/watch?v=AZ4Nihe6aKo');
// $video->videoYoutubeScript();
// //add track vtt
// $video->setSrcTrackVTT('track.vtt', 'en');
// //or add track ass
// $video->setSrcTrackASS('The.Pursuit.Of.Happyness.2006.720p.BrRip.x264.YIFY.ass');
// //set ads video
// $video->setQuangCaoVideo('https://www.localhost/videojs/oceans.mp4', 'google.com');
// //
// $video->videoHtml5Script();// script --> good all




 ?>