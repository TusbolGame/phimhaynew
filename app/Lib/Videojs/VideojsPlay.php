<?php namespace App\Lib\Videojs;
/**
* Class video js
* Chú ý, phải đưa các file video-js.css và file videojs-resolution-switcher.css
	vào <head> trước khi sử dụng
*/
class VideojsPlay
{
	protected $id_video; // default
	protected $src360; // 
	protected $src480;
	protected $src720; //
	protected $src1080;
	protected $src2160;
	protected $tech_order_name;
	protected $src_youtube;
	protected $src_track_vtt; // file .vtt
	protected $track_vtt_language; 
	protected $src_track_ass; // file .ass .ssa
    protected $ads_video_src;
    protected $ads_video_redirect;
    protected $src_poster;
    //dir_index
    protected $dir_index; 
    //plugin
    public function __construct()
	{
		$this->dir_index = '';//bình thường require ở index
		$this->id_video = 'my_video'; // default
		$this->src360 = false;
		$this->src480 = false;
		$this->src720 = false;
		$this->src1080 = false;
		$this->src2160 = false;
		//techOrder
		$this->tech_order_name = false; //flash, youtube
		$this->src_poster = false;
		//ad
		$this->ads_video_src = false;
		$this->ads_video_redirect = '';
		//track
		$this->src_track_ass = false;
		//vtt
		$this->src_track_vtt = false;
		$this->track_vtt_language = 'vi'; //default vi
	}
	//error
	// public function usingFlash(){
	// 	$this->tech_order_name = 'flash';
	// }
	public function usingTechYoutube(){
		$this->tech_order_name = 'youtube';
	}
	public function setSrcYoutube($src){
		$this->src_youtube = $src;
	}
	protected function getVideoTag(){
		/*
		<video id="id-video" class="video-js vjs-default-skin vjs-big-play-centered">
		//not support videojs
			<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that
				<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
			//track - multi track
			<track kind="captions" src="src-track-en.vtt" srclang="en" label="English" default>
			<track kind="captions" src="src-track-vi.vtt" srclang="vi" label="Vietnamese">
			
		</video>
		
		*/
		echo '<video id="'.$this->getIdVideo().'" class="video-js vjs-default-skin vjs-big-play-centered">';
		// add not support
	    echo '<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>';
	    // add track, neu co, neu ko thi bo qua
		if($this->src_track_vtt){
			$lang = ['vi' => 'Vietnamese', 'en' => 'English'];
		?>
			<track kind="captions" src="<?php echo $this->src_track_vtt; ?>" srclang="<?php echo $this->track_vtt_language; ?>" label="<?php (isset($lang[$this->track_vtt_language]) ? $lang[$this->track_vtt_language] : 'Default') ?>" default>
		<?php
		} // end if($this->src_track_vtt)
	    echo '</video>';
	}
	protected function getVideoScript(){
		/*
		<script>
		    videojs('<?php echo $this->getIdVideo(); ?>', {
		        controls: true,
		        //preload: 'auto', //require if using techOrder: ['flash']
		        width: 640,
		        height: 264,
		        poster: "url-poster.jpg", //poster
		        techOrder: ['flash'], // flash, youtube, video bt ko cần, flash -> error
		        // techOrder:  ["youtube"],
		        // sources: [{ "type": "video/youtube", "src": ""}],
				plugins: {
					//plugin
					videoJsResolutionSwitcher: {
						default: 'low',
						dynamicLabel: true
					}
					,
					hotkeys:{
		        		seekStep: 5 //skip 5s
		      		}
					// track ass
			        ,ass: {
		            	'src': ["src-track.ass"],
		            	'delay': -0.1,
		          	}
				}
				}, function(){
					var player = this;
					window.player = player;
					player.updateSrc([
				        //source
				       {
							src: 'src-360p.mp4',
							type: 'video/mp4',
							label: '360',
							res: 360
			        	},
			        	{
							src: 'src-480p.mp4',
							type: 'video/mp4',
							label: '480',
							res: 480
			        	},
			      	]);
					player.on('resolutionchange', function(){
					console.info('Source changed');
					});
				});
		</script>
		*/
		?>
		<script>
		    videojs('<?php echo $this->getIdVideo(); ?>', {
		        controls: true,
		        preload: 'auto',
		        width: 640,
		        height: 264,
		        fluid: true, //responsive

		        <?php
		        //check poster
		        if($this->src_poster){
		        	echo 'poster: "'.$this->src_poster.'",';
		        }
				//check techOrder
		        if($this->tech_order_name){
		        	echo 'techOrder: ["'.$this->tech_order_name.'"],';
		        	if($this->tech_order_name == 'youtube'){
		        		echo 'sources: [{ "type": "video/youtube", "src": "'.$this->src_youtube.'"}],';
		        	}
		        }
		        ?>
		        // 
				plugins: {
					videoJsResolutionSwitcher: {
						default: 'low',
						dynamicLabel: true
					}
					,
					hotkeys:{
		        		seekStep: 5 //skip 5s
		      		}
		      		<?php 
		      			//check ad video
				        if($this->ads_video_src){
				        	?>
				        	,preroll:{
				        		src: {
				        			src: "<?php echo $this->ads_video_src; ?>",
				        			type: "video/mp4"
				        		},
				        		href: "<?php echo $this->ads_video_redirect; ?>",
				        		// tắt chế độ thông báo
				    			adsOptions: {debug: false}
				        	}
				        	<?php
				        }
				        //track ass
						if($this->src_track_ass){
							//neu ton tai --> add
							?>
							,ass: {
				            	'src': ["<?php echo $this->src_track_ass; ?>"],
				            	'delay': -0.1,
				          	}
							<?php
						}
		      		?>
				}
				}, function(){
					var player = this;
					window.player = player;
					<?php 
					//check if not techOrder youtube -> update src
					if($this->tech_order_name != 'youtube'){
						?>
						player.updateSrc([
				        <?php 
					        // source
					        $this->addAllSrcScript();
				        ?>
			      		]);
						<?php
					}
					?>
					//store volume value
					player.persistvolume({
        				namespace: "HERO"
      				});
					player.on('resolutionchange', function(){
					console.info('Source changed');
					});
				});
		</script>
		<?php
		// disable event click mouse right
		$this->setEventClickDisableMouseRightVideo();
	}
	function getVideoJs(){
		$this->getVideoTag();
		$this->getVideoScript();
	}
	public function getCssRequire(){
		?>
		<!-- style videojs -->
		<link rel="stylesheet" type="text/css" href="<?php echo $this->dir_index; ?>videojs/video-js.css">
		<!-- style resolution switcher -->
		<link rel="stylesheet" type="text/css" href="<?php echo $this->dir_index; ?>videojs-resolution-switcher/videojs-resolution-switcher.css">
		<?php 
			if($this->ads_video_src){
				?>
				<!-- lib ads -->
				<link rel="stylesheet" type="text/css" href="<?php echo $this->dir_index; ?>videojs-ads/videojs.ads.css">
				<link rel="stylesheet" type="text/css" href="<?php echo $this->dir_index; ?>videojs-ads/videojs-preroll.css">
				<?php
			}
		?>
		<?php 
			if($this->src_track_ass){
				?>
				<!-- track ass -->
				<link rel="stylesheet" type="text/css" href="<?php echo $this->dir_index; ?>libjass/libjass.css">
				<link rel="stylesheet" type="text/css" href="<?php echo $this->dir_index; ?>videojs-ass-master/src/videojs.ass.css">
				<?php
			}
	}
	public function getJsRequire(){
		?>
		<!-- videojs js -->
		<script src="<?php echo $this->dir_index; ?>videojs/video.js"></script>
		<!-- videojs flash -->
		<script>
		    videojs.options.flash.swf = "<?php echo $this->dir_index; ?>videojs/video-js.swf";
		</script>
		
		<!-- videojs resolution switcher js -->
		<script src="<?php echo $this->dir_index; ?>videojs-resolution-switcher/videojs-resolution-switcher.js"></script>
		<?php 
			if($this->tech_order_name == 'youtube'){
				?>
				<!-- youtube -->
				<script src="<?php echo $this->dir_index; ?>youtube-js/youtube.js"></script>
				<?php
			}
		?>
		
		<!-- hotkeys -->
		<script src="<?php echo $this->dir_index; ?>hotkeys/hotkeys.js"></script>
		<!-- store volume value -->
		<script src="<?php echo $this->dir_index; ?>videojs-persistvolume/videojs.persistvolume.js"></script>
		<?php 
			if($this->ads_video_src){
				?>
				<!-- lib ads -->
				<script src="<?php echo $this->dir_index; ?>videojs-ads/videojs.ads.js"></script>
				<script src="<?php echo $this->dir_index; ?>videojs-ads/videojs-preroll.js"></script>
				<?php
			}
			if($this->src_track_ass){
				?>
				<!-- track ass -->
				<script src="<?php echo $this->dir_index; ?>libjass/libjass.js"></script>
				<script src="<?php echo $this->dir_index; ?>videojs-ass-master/src/videojs.ass.js"></script>
				<?php
			}
	}
	public function setDirIndex($dir = ''){
		$this->dir_index = $dir;
	}
	public function getDirIndex(){
		return $this->dir_index;
	}
	//
	protected function addAllSrcScript(){
		$this->setSrcScript($this->src360, 'video/mp4', '360', 360);
		$this->setSrcScript($this->src480, 'video/mp4', '480', 480);
		$this->setSrcScript($this->src720, 'video/mp4', '720', 720);
		$this->setSrcScript($this->src1080, 'video/mp4', '1080', 1080);
		$this->setSrcScript($this->src2160, 'video/mp4', '2160', 2160);
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
	// mặc định src là vi
	public function setSrcTrackVTT($src_track_vtt, $lang = 'vi')
	{
		$this->src_track_vtt = $src_track_vtt;
		$this->track_vtt_language = $lang;
	}
	public function setSrcTrackASS($src_track_ass)
	{
		$this->src_track_ass = $src_track_ass;
	}
	protected function getSrcTrackASS(){
		return $this->src_track_ass;
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
		$this->src_poster = $srcposter;
	}
	public function setAdsVideo($ads_src, $ads_redirect)
	{
		$this->ads_video_src = $ads_src;
		$this->ads_video_redirect = $ads_redirect;
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
	public function setIdVideo($id)
	{
		$this->id_video = $id;
	}
	public function getIdVideo()
	{
		return $this->id_video;
	}
}

//use
// require 'VideojsPlay.php';
// $video = new VideojsPlay();
//set dir lib
	// $video->setDirIndex(''); 
//add poster
	// $video->setPosterVideo('poster.jpg');
//set source
	//----src youtube
	// $video->usingTechYoutube();
	// $video->setSrcYoutube('https://www.youtube.com/watch?v=x3Y_qzR72Zs');
	// //----src bt: 360, 480, 720, 1080...
	// $video->setSrc360('oceans.mp4');
	// $video->setSrc720('oceans.mp4');
//track
	//add track vtt -> only 1
	// $video->setSrcTrackVTT('track.vtt', 'en');
	// //or add track ass
	// $video->setSrcTrackASS('The.Pursuit.Of.Happyness.2006.720p.BrRip.x264.YIFY.ass');
//set ads video
	// $video->setAdsVideo('src-video-ads', 'url-ads-redirect');
//link require style css
	// $video->getJsRequire();
//link require js
	// $video->getCssRequire();
//built videojs
	// $video->getVideoJs();




 ?>