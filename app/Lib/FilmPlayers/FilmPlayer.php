<?php namespace App\Lib\FilmPlayers;

/**
* 
*/
use App\Lib\Videojs\VideojsPlay;
use App\Lib\GetLinkVideo\GetLinkVideo;


class FilmPlayer
{
	public function getFilmVideojs($film_video, $poster_video, $film_track = ''){

		if(count($film_video) == 1){
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
			if($film_video->film_src_name == 'youtube'){
				$video->setSrcYoutube($film_video->film_src_full);
				$video->videoYoutubeScript();
			}
			elseif ($film_video->film_src_name == 'google drive'){
				if(env('DRIVE_USE') == 'embeb'){
					$get_link_video = new GetLinkVideo();
					$video->setSrcYoutube($get_link_video->getLinkDriveEmbedYoutube($film_video->film_src_full));
					$video->videoIframe();
				}elseif(env('DRIVE_USE') == 'proxy'){
					if($film_video->film_src_360p != null){
						$video->setSrc360(route('videoStream.getProxy', [$film_video->id, '360p']));
					}
					if($film_video->film_src_480p != null){
						$video->setSrc480(route('videoStream.getProxy', [$film_video->id, '480p']));
					}
					if($film_video->film_src_720p != null){
						$video->setSrc720(route('videoStream.getProxy', [$film_video->id, '720p']));
					}
					if($film_video->film_src_1080p != null){
						$video->setSrc1080(route('videoStream.getProxy', [$film_video->id, '1080p']));
					}
					if($film_video->film_src_2160p != null){
						$video->setSrc2160(route('videoStream.getProxy', [$film_video->id, '2160p']));
					}
					$video->videoHtml5Script();
				}
			}

			elseif ($film_video->film_src_name == 'google photos') {
				if($film_video->film_src_360p != null){
				$video->setSrc360($film_video->film_src_360p);
				}
				if($film_video->film_src_480p != null){
					$video->setSrc480($film_video->film_src_480p);
				}
				if($film_video->film_src_720p != null){
					$video->setSrc720($film_video->film_src_720p);
				}
				if($film_video->film_src_1080p != null){
					$video->setSrc1080($film_video->film_src_1080p);
				}
				if($film_video->film_src_2160p != null){
					$video->setSrc2160($film_video->film_src_2160p);
				}
				$video->videoHtml5Script();
			}elseif($film_video->film_src_name == 'local'){
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
		}
	}
}


?>