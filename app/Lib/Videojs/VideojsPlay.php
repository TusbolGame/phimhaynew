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
	protected $src_track = ''; // file .vtt
	protected $track_language = 'vi'; //default vi
	protected $support_not = '<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that
				<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
    		</p>';
    protected $qc_src = '';
    protected $qc_link_chuyen = '';
    protected $src_poster = '';
    //dir_index
    protected $dir_index = ''; //bình thường require ở index
	// src lib
	protected $lib_videojs = '/videojs/video.js';
	protected $lib_videojs_swf = '/videojs/video-js.swf'; // hỗ trợ file flash
	protected $lib_videojs_reresolution_switcher = '/videojs/videojs-resolution-switcher.js';
	protected $lib_youtube = '/videojs/youtube.js';
	//lib qc
	protected $lib_videojs_ads = '/videojs/videojs.ads.js';
	protected $lib_videojs_preroll = '/videojs/videojs-preroll.js';
	protected function setSrcLibIndex(){
		//set src lib
		$this->lib_videojs = $this->dir_index.$this->lib_videojs;
		$this->lib_videojs_swf = $this->dir_index.$this->lib_videojs_swf;
		$this->lib_videojs_reresolution_switcher = $this->dir_index.$this->lib_videojs_reresolution_switcher;
		$this->lib_youtube = $this->dir_index.$this->lib_youtube;
		$this->lib_videojs_ads = $this->dir_index.$this->lib_videojs_ads;
		$this->lib_videojs_preroll = $this->dir_index.$this->lib_videojs_preroll;
	}
	public function setDirIndex($dir){
		$this->dir_index = $dir;
		$this->setSrcLibIndex();
		//add lib videojs
		?>
		<link href="<?php echo $dir; ?>/videojs/video-js.css" rel="stylesheet">
  		<link href="<?php echo $dir; ?>/videojs/videojs-resolution-switcher.css" rel="stylesheet">
  		<link href="<?php echo $dir; ?>/videojs/videojs-preroll.css" rel="stylesheet" type="text/css">
		<script src="<?php echo $this->lib_videojs; ?>"></script>
		<script type="javascript/text">
		    videojs.options.flash.swf = "<?php echo $this->lib_videojs_swf; ?>";
		</script>
		<script src="<?php echo $this->lib_videojs_reresolution_switcher; ?>"></script>
		<?php
	}
	protected function addTrack()
	{
		if($this->getSrcTrack()!=''){
		?>
			<track kind="captions" src="<?php echo $this->getSrcTrack(); ?>" 
			<?php if($this->getTrackLanguage() == 'en'){ ?>
					srclang="en" label="English" 
					<?php } // end if($this->getTrackLanguage() == 'en')
					else{ // nguoc lai la vietnamese, default
						?>
						srclang="vi" label="Vietnamese"
						<?php
					}
					 ?>
			default>
		<?php
		} // end if($this->getSrcTrack()!='')
	}
	/* video flash ko the add track, chu y */
	public function videoFlash(){
		?>
		<video id="<?php echo $this->getIdVideo(); ?>" class="video-js vjs-default-skin vjs-big-play-centered" data-setup='{"fluid": true}'
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
				techOrder: ['flash'],
				plugins: {
					videoJsResolutionSwitcher: {
						default: 'low',
						dynamicLabel: true
					}
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
	public function videoYoutubeScript()
	{
		?>
		<script src="<?php echo $this->lib_youtube; ?>"></script>
		<video id="<?php echo $this->getIdVideo(); ?>" class="video-js vjs-default-skin vjs-big-play-centered" data-setup='{"fluid": true}'
			<?php 
			//set poster
			$this->getPosterVideo();
			 ?>
		>
		<?php 
		// add not support
	    echo $this->support_not;
		// add track, neu co, neu ko thi bo qua
		$this->addTrack();
		 ?>
		</video>
		<script> // error script
		    videojs('<?php echo $this->getIdVideo(); ?>', {
		        controls: true,
		        width: 640,
		        height: 264,
		        techOrder:  ["youtube"],
		        sources: [{ "type": "video/youtube", "src": "<?php echo $this->src_youtube; ?>"}],
				plugins: {
					videoJsResolutionSwitcher: {
						default: 'low',
						dynamicLabel: true
					}
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
	public function videoYoutubeTagVideo()
	{
		?>
		<script src="<?php echo $this->lib_youtube; ?>"></script>
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
		$this->addTrack();
		 ?>
		</video>
		<script>
    		videojs('<?php echo $this->getIdVideo(); ?>').videoJsResolutionSwitcher();
		</script>
		<?php
		// disable event click mouse right
		//$this->setEventClickDisableMouseRightVideo();
	}
	public function videoHtml5TagVideo()
	{
		?>
		<video id="<?php echo $this->getIdVideo(); ?>" class="video-js vjs-default-skin vjs-big-play-centered" width="640" height="264" controls data-setup='{"fluid": true}'
		<?php 
			//set poster
			$this->getPosterVideo();
		?>
		data-setup='{}'>
			<?php 
			// hiển thị source
			$this->addAllSrcTagVideo(); 
    		// add not support
    		echo $this->support_not;
			// add track, neu co, neu ko thi bo qua
			$this->addTrack();
		 ?>
		</video>
		<script>
	    	videojs('<?php echo $this->getIdVideo(); ?>').videoJsResolutionSwitcher();
		</script>
		<?php
		// add quang cao
		$this->addQuangCaoVideo();
		// disable event click mouse right
		$this->setEventClickDisableMouseRightVideo();
	}
	public function videoHtml5Script()
	{
		?>
		<video id="<?php echo $this->getIdVideo(); ?>" class="video-js vjs-default-skin vjs-big-play-centered" data-setup='{"fluid": true}'
			<?php 
			//set poster
			$this->getPosterVideo();
			?>
		>
    		<?php 
    		// add not support
    		echo $this->support_not;
			// add track, neu co, neu ko thi bo qua
			$this->addTrack();
		 	?>
		</video>
		<script>
		    		videojs('<?php echo $this->getIdVideo(); ?>', {
					controls: true,
					preload: 'auto',
					width: 640,
					height: 264,
					plugins: {
					videoJsResolutionSwitcher: {
		        	default: 'low',
		        	dynamicLabel: true
		        }
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
	public function setSrcTrack($srctrack)
	{
		$this->src_track = $srctrack;
	}
	protected function getSrcTrack()
	{
		return $this->src_track;
	}
	public function setTrackLanguage($lang)
	{
		$this->track_language = $lang;
	}
	protected function getTrackLanguage()
	{
		return $this->track_language;
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
	protected function addQuangCaoVideo()
	{
		//neu ton tai add qc
		if($this->qc_src!=''){
			?>
			<!-- lib quang cao -->
			<link href="../../videojs/videojs.ads.css" rel="stylesheet">
			<script src="<?php echo $this->lib_videojs_ads; ?>"></script>
			<script src="<?php echo $this->lib_videojs_preroll; ?>"></script>

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
 ?>