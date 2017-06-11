<?php namespace App\Lib\FilmPlayers;

/**
* 
*/
use App\Lib\Videojs\VideojsPlay;


class FilmPlayer
{
	public function getTrailerYoutube($url_youtube, $poster_video){
		$video = new VideojsPlay();
		$video->setDirIndex(url('public/videojs').'/');
		$video->setPosterVideo($poster_video);
		$video->usingTechYoutube();
		$video->setSrcYoutube($url_youtube);
		$video->getCssRequire();
		$video->getJsRequire();
		$video->getVideojs();
	}
	public function getFilmVideojs($data_source, $poster_video, $film_track = ''){
		if(!empty($data_source) && $data_source['film_src_name'] != ''){
			$video = new VideojsPlay();
			$video->setDirIndex(url('public/videojs').'/');
			$video->setPosterVideo($poster_video);
			if(count($film_track) == 1 && !empty($film_track)){
				//vtt or ass
				//src_track// default local
				$src_track = asset('resources/phim/tracks/'.$film_track->film_track_src);
				if($film_track->film_track_type == 'vtt'){
					$video->setSrcTrackVTT($src_track, 'vi');
				}else if($film_track->film_track_type == 'ass'){
					$video->setSrcTrackASS($src_track);
				}
			}
			
			if($data_source['film_src_name'] == 'youtube'){
				$video->usingTechYoutube();
				$video->setSrcYoutube($data_source['film_src_full']);
			}
			// elseif ($data_source['film_src_name'] == 'google drive'){
			// 	// if(env('DRIVE_USE') == 'embeb'){
			// 	// 	$get_link_video = new GetLinkVideo();
			// 	// 	$video->setSrcYoutube($get_link_video->getLinkDriveEmbedYoutube($film_video->film_src_full));
			// 	// 	$video->videoIframe();
			// 	// }elseif(env('DRIVE_USE') == 'proxy'){
			// 	// 	if($trailer == 'yes'){
			// 	// 		//trailer
			// 	// 		if($film_video->film_src_360p != null){
			// 	// 		$video->setSrc360(route('videoStream.getProxy', [$film_video->id, '360p']).'?trailer=yes');
			// 	// 		}
			// 	// 		if($film_video->film_src_480p != null){
			// 	// 			$video->setSrc480(route('videoStream.getProxy', [$film_video->id, '480p']).'?trailer=yes');
			// 	// 		}
			// 	// 		if($film_video->film_src_720p != null){
			// 	// 			$video->setSrc720(route('videoStream.getProxy', [$film_video->id, '720p']).'?trailer=yes');
			// 	// 		}
			// 	// 		if($film_video->film_src_1080p != null){
			// 	// 			$video->setSrc1080(route('videoStream.getProxy', [$film_video->id, '1080p']).'?trailer=yes');
			// 	// 		}
			// 	// 		if($film_video->film_src_2160p != null){
			// 	// 			$video->setSrc2160(route('videoStream.getProxy', [$film_video->id, '2160p']).'?trailer=yes');
			// 	// 		}
			// 	// 	}else{
			// 	// 		//phim
			// 	// 		if($film_video->film_src_360p != null){
			// 	// 		$video->setSrc360(route('videoStream.getProxy', [$film_video->id, '360p']));
			// 	// 		}
			// 	// 		if($film_video->film_src_480p != null){
			// 	// 			$video->setSrc480(route('videoStream.getProxy', [$film_video->id, '480p']));
			// 	// 		}
			// 	// 		if($film_video->film_src_720p != null){
			// 	// 			$video->setSrc720(route('videoStream.getProxy', [$film_video->id, '720p']));
			// 	// 		}
			// 	// 		if($film_video->film_src_1080p != null){
			// 	// 			$video->setSrc1080(route('videoStream.getProxy', [$film_video->id, '1080p']));
			// 	// 		}
			// 	// 		if($film_video->film_src_2160p != null){
			// 	// 			$video->setSrc2160(route('videoStream.getProxy', [$film_video->id, '2160p']));
			// 	// 		}
			// 	// 	}
					
			// 	// 	$video->videoHtml5Script();
			// 	// }
			// }
			else{
				//show ra
				if(isset($data_source['film_src_360p'])){
					$video->setSrc360($data_source['film_src_360p']);
				}
				if(isset($data_source['film_src_480p'])){
					$video->setSrc480($data_source['film_src_480p']);
				}
				if(isset($data_source['film_src_720p'])){
					$video->setSrc720($data_source['film_src_720p']);
				}
				if(isset($data_source['film_src_1080p'])){
					$video->setSrc1080($data_source['film_src_1080p']);
				}
				if(isset($data_source['film_src_2160p'])){
					$video->setSrc2160($data_source['film_src_2160p']);
				}
				
			}
			//get video
			$video->getCssRequire();
			$video->getJsRequire();
			$video->getVideojs();
			/*
			elseif($film_video->film_src_name == 'local'){
				//
				$path = route('videoStream.getVideoStream', '').'/';
				if($film_video->film_src_360p != null){
				$video->setSrc360($path.$film_video->film_src_360p);
				}
				if($film_video->film_src_480p != null){
					$video->setSrc480($path.$film_video->film_src_480p);
				}
				if($film_video->film_src_720p != null){
					$video->setSrc720($path.$film_video->film_src_720p);
				}
				if($film_video->film_src_1080p != null){
					$video->setSrc1080($path.$film_video->film_src_1080p);
				}
				if($film_video->film_src_2160p != null){
					$video->setSrc2160($path.$film_video->film_src_2160p);
				}
				$video->videoHtml5Script();
			}
			*/
		}
	}
}


?>