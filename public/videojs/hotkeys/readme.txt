plugin skip 5s
cách1: call plugin------------------
<script>
    videojs('<?php echo $this->getIdVideo(); ?>', {
        controls: true,
        width: 640,
        height: 264,
        poster: "url-poster.jpg", //poster
        // techOrder:  ["youtube"],
        // sources: [{ "type": "video/youtube", "src": ""}],
		plugins: {	
			hotkeys:{
        		seekStep: 5 //skip 5s
      		}
		}
		}, function(){
			var player = this;
			window.player = player;
			player.on('resolutionchange', function(){
			console.info('Source changed');
			});
		});
</script>
//
cách2: call with player------------------
<script>
    videojs('<?php echo $this->getIdVideo(); ?>', {
        controls: true,
        width: 640,
        height: 264,
        poster: "url-poster.jpg", //poster
        // techOrder:  ["youtube"],
        // sources: [{ "type": "video/youtube", "src": ""}],
		plugins: {
			//...
		}
		}, function(){
			var player = this;
			window.player = player;
	      	//hotkeys
	      	player.ready(function() {
      		this.hotkeys({
		        seekStep: 5 //skip 5s
		      	});
		    });
			player.on('resolutionchange', function(){
			console.info('Source changed');
			});
		});
</script>