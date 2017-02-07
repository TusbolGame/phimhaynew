<?php namespace App\Lib\FilmProcess;

/**
* 
*/
use App\Lib\Videojs\VideojsPlay;
class FilmProcess
{
	public function getFilmNameVnEn($film_name_vn, $film_name_en){
		if($film_name_vn == null){
			return $film_name_en;
		}
		if($film_name_en == null){
			return $film_name_vn;
		}
		return $film_name_vn.'-'.$film_name_en;
	}
	public function getFilmNameVn($film_name_vn, $film_name_en){
		if($film_name_vn != null){
			return $film_name_vn;
		}
		return $film_name_en;
	}
	public function getFilmNameEn($film_name_vn, $film_name_en){
		if($film_name_en != null){
			return $film_name_en;
		}
		return $film_name_vn;
	}

	public function getTitleInfo($film_name_vn, $film_name_en, $film_years, $film_quality){
		return $this->getFilmNameVnEn($film_name_vn, $film_name_en).' '.$film_years.' '.$film_quality;
	}
	public function getTitleWatch($film_name_vn, $film_name_en, $film_years, $film_quality, $film_category, $film_episode = 'Trailer'){
		if($film_category == 'le' || $film_category == 'hhle'){
			return $this->getTitleInfo($film_name_vn, $film_name_en, $film_years, $film_quality);
		}else{
			//phim bo
			//if episode =0 => trailer
			if($film_episode == 'Trailer'){
				return $this->getFilmNameVnEn($film_name_vn, $film_name_en).' '.$film_episode.' '.$film_years;
			}else{
				return $this->getFilmNameVnEn($film_name_vn, $film_name_en).' tập '.$film_episode.' '.$film_years.' '.$film_quality;
			}
		}
	}
	public function getFilmDescriptionInfo($film_info){
		$kq_info = null;
		if($film_info != null){
			//remove tag
			$kq_info = strip_tags($film_info);
			//lay 100 words dau tien
			return $this->getWords($kq_info, 100);
		}
		return $kq_info;
	}
	public function getFilmDescriptionWatch($film_info, $film_category){
		if($film_category == 'le' || $film_category == 'hhle'){
			$kq_info = null;
			if($film_info != null){
				//remove tag
				$kq_info = strip_tags($film_info);
				//lay 100 words dau tien
				return $this->getWords($kq_info, 100);
			}
			return $kq_info;
		}else{
			//bo
			return $this->getTitleWatch($film_name_vn, $film_name_en, $film_years, $film_quality, $film_category, $film_episode);
		}
	}
	//get 1 so tu dau tien
	protected function getWords($str, $wordCount = 10){
		return implode( 
		    '', 
		    array_slice( 
		    	preg_split(
		    		'/([\s,\.;\?\!]+)/', 
		    		$str, 
		    		$wordCount*2+1, 
		    		PREG_SPLIT_DELIM_CAPTURE
		    	),
		    	0,
		    	$wordCount*2-1
		    )
		);
	}
	public function xulyFilmStatus($film_category, $film_quality, $film_episode, $film_time){
		if($film_category == 'le' || $film_category == 'hhle'){
			return $this->xulyGetFilmQuality($film_quality);
		}else{
			//phim bo,hhbo
			return 'Tập '.$film_episode.'/'.$film_time.' '.$this->xulyGetFilmQuality($film_quality);
		}
	}
	public function xulyGetFilmTime($film_time, $film_category){
		if($film_time != null){
			if($film_category == 'le' || $film_category == 'hhle' ){
				return $film_time.' phút';
			}else{
				return $film_time.' tập';
			}
		}else{
			return '??';
		}	
	}
	public function xulyGetFilmQuality($film_quality){
		if($film_quality != null){
			if($film_quality == '360p' || $film_quality == '480p'){
				return 'SD';
			}else if($film_quality == '720p'){
				return 'HD';
			}else if($film_quality == '1080p'){
				return 'Full HD';
			}else{
				//2160p
				return '2K';
			}
		}
	}
	public function xulyGetFilmLanguage($film_language){
		if($film_language != null){
			//vd 1 array: vs,tm,lt
			$data = explode(',', $film_language);
			$xuly = array(
				'vs' => 'VietSub',
				'es' => 'EnglishSub',
				'tm' => 'Thuyết minh',
				'lt' => 'Lồng Tiếng',
				'raw' => 'Raw'
				);
			$result = array();
			foreach ($data as $key) {
				$result[$key] = $xuly[$key];
			}
			return implode(', ', $result);	
		}	
	}
	public function xulyGetFilmType($film_type, $film_category = null){
		
		$data = explode(',', $film_type);
		echo '<ul>';
		$xuly = array('le'=>'Phim lẻ', 'bo'=>'Phim bộ',
						'hh'=>'Phim hoạt hình',
						'chien-tranh'=>'Chiến tranh', 'co-trang'=>'Cổ trang', 'hai-huoc'=>'Hài hước',
						'hanh-dong'=>'Hành động', 'hinh-su'=>'Hình sự', 'kinh-di'=>'Kinh dị', 
						'hoi-hop-gay-can'=>'Hồi hộp Gây cấn',
						'phieu-luu'=>'Phiêu lưu', 'vo-thuat'=>'Võ thuật', 'vien-tuong'=>'Viễn tưởng',
						'tam-ly'=>'Tâm lý', 'tinh-cam'=>'Tình cảm', 'tai-lieu'=>'Tài liệu',
						'than-thoai'=>'Thần thoại', 'trinh-tham'=>'trinh thám', 'gia-tuong'=>'Giả tưởng', 'hoc-duong'=>'Học đường', 'phep-thuat'=>'Phép thuật', 'sieu-nhien'=>'Siêu nhiên', 'zombie' => 'Zombie'
						);
			
		if(!empty($film_category)){
			if($film_category == 'hhle' || $film_category == 'hhbo'){
				$film_category = 'hh';
			}
			echo '<li><a href="'.url('film?category='.$film_category).'" title="'.$xuly[$film_category].'">'.$xuly[$film_category].'</a></li>';
		}
		if(count($data) > 0){
			
			foreach ($data as $type) {
				echo '<li><a href="'.url('film?type='.$type).'" title="'.$xuly[$type].'">'.$xuly[$type].'</a></li>';
			}		
		}
		echo '</ul>';
	}
	public function xulyGetFilmCountry($film_country){
		$data = explode(',', $film_country);
		if(count($data) > 0){
			//xử lý --> tags a
			$xuly = array('anh'=>'Anh', 'an-do'=>'Ấn Độ', 'au-my'=>'Âu-Mỹ',
						'dai-loan'=>'Đài Loan', 'han-quoc'=>'Hàn Quốc', 'hong-kong'=>'Hồng Kông',
						'my'=>'Mỹ', 'nga' => 'Nga', 'nhat-ban'=>'Nhật Bản', 'viet-nam'=>'Việt Nam', 
						'thai-lan'=>'Thái Lan', 'trung-quoc'=>'Trung Quốc',
						'quoc-gia-khac'=>'Quốc Gia khác'
						);
			echo '<ul>';
			foreach ($data as $key) {
				echo '<li><a href="'.url('film?key='.$key).'" title="'.$xuly[$key].'">'.$xuly[$key].'</a></li>';
			}
			echo '</ul>';
		}		
	}
	//chua
	public function xylyGetFilmLoai(){
		$film_loai = $film_video->getFilmLoai();
		$film_loai_name = '';
		if($film_loai == 'le'){
			$film_loai_name = 'lẻ';
		}
		if($film_loai == 'bo'){
			$film_loai_name = 'bộ';
		}
		//xu ly phim hhbo, hhle--> change hoat-hinh
		if($film_loai == 'hhbo' || $film_loai == 'hhle'){
			$film_loai = 'hoat-hinh';
			$film_loai_name = 'hoạt hình';
		}
		?>
			<a href="<?php echo '../../the-loai/phim-'.$film_loai.'/'; ?>" title="Phim <?php echo $film_loai_name; ?>">Phim <?php echo $film_loai_name; ?></a>
		<?php
	}
	public function xulyGetFilmKeyWords($film_key_words){
		$data = explode(',', $film_key_words);
		if(count($data) > 0){
			foreach ($data as $key) {
				//change space to -
					$temp = preg_replace('/ /', '-', $key);
				echo '<li><a href="'.url('film?name='.$temp).'" title="'.$key.'">'.$key.'</a></li>';
			}
		}
	}
	protected function clearUtf8($s){
		$t = $s;
		$t = preg_replace('/[áàảãạâấầẩẫậăắằẳẵặ]/u' ,'a', $t);
		$t = preg_replace('/[éèẻẽẹêếềểễệ]/u' ,'e', $t);
		$t = preg_replace('/[íìỉĩị]/u' ,'i', $t);
		$t = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u' ,'o', $t);
		$t = preg_replace('/[úùủũụưứừửữự]/u' ,'u', $t);
		$t = preg_replace('/[đĐ]/u' ,'d', $t);
		return $t;
	}
	public function getFilmNameVnEnNoUtf8($film_name)
	{
		$name = $film_name;
		// xoa ki tu 2 cham : ( )
		$name = preg_replace('/[:()]/u', '', $name);
		//doi chu hoa thanh thuong
		$name = mb_convert_case($name, MB_CASE_LOWER,'utf-8');
		// xoa utf8
		$name = $this->clearUtf8($name);
		// thay ki tu space thanh -
		$name = preg_replace('/ /', '-', $name);
		return $name;
	}
	public function getFilmDirName($film_name_vn, $film_name_en, $film_years){
		return $this->getFilmNameVnEnNoUtf8($this->getFilmNameVnEn($film_name_vn, $film_name_en)).'-'.$film_years;
	}
	public function getFilmVideojs($film_video, $poster_video){
		if(count($film_video) == 1){
			$video = new VideojsPlay();
			$video->setDirIndex(url('public'));
			$video->setPosterVideo($poster_video);
			if($film_video->film_src_name == 'youtube'){
				$video->setSrcYoutube($film_video->film_src_full);
				$video->videoYoutubeScript();
			}elseif ($film_video->film_src_name == 'google photos' || $film_video->film_src_name == 'google drive') {
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
			}
		}
	}

}


?>