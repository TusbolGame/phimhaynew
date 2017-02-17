<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		
		// $this->call('FilmJobDatabaseSeeder');
		// $this->call('FilmSliderDatabaseSeeder');
		// $this->call('FilmRelateDatabaseSeeder');
		// $this->call('PhimHayConfigDatabaseSeeder');
		// $this->call('FilmDetailDatabaseSeeder');
		// $this->call('FilmListDatabaseSeeder');
		// $this->call('FilmTrailerDatabaseSeeder');
		// $this->call('FilmEpisodeDatabaseSeeder');
		// $this->call('FilmUserDiffDatabaseSeeder');
	}

}
class FilmUserDiffDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('film_user_diff')->insert([
			//1
			[
				'id' => 1,
			],
			
			]);
	}

}
class FilmRelateDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('film_relates')->insert([
			//1
			['film_relate_name' => 'Không có phim liên quan'],
			//2
			['film_relate_name' => 'Tần Thời Minh Nguyệt'],
			//3
			['film_relate_name' => 'Lost'],
			//4
			['film_relate_name' => 'Terra Formars'],
			//5
			['film_relate_name' => 'Gakusen Toshi Asterisk'],
			//6
			['film_relate_name' => 'Hercules'],
			//7
			['film_relate_name' => 'Constantine']
			]);
	}

}
class FilmJobDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('film_jobs')->insert([
			//1
			['job_name' => 'đạo diễn'],
			//2
			['job_name' => 'diễn viên'],
			//3
			['job_name' => 'nhà sản xuất'],
			//4
			['job_name' => 'nhạc phim'],
			//5
			['job_name' => 'nhà văn']
			]);
	}

}
class FilmCountryDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('film_countries')->insert([
			//1
			['country_name' => 'Anh', 'country_alias' => 'anh'],
			['country_name' => 'Ấn Độ', 'country_alias' => 'an-do'],
			['country_name' => 'Âu-Mỹ', 'country_alias' => 'au-my'],
			['country_name' => 'Đài Loan', 'country_alias' => 'dai-loan'],
			['country_name' => 'Hồng Kông', 'country_alias' => 'hong-kong'],
			['country_name' => 'Mỹ', 'country_alias' => 'my'],
			['country_name' => 'Nga', 'country_alias' => 'nga'],
			['country_name' => 'Nhật Bản', 'country_alias' => 'nhat-ban'],
			['country_name' => 'Việt Nam', 'country_alias' => 'viet-nam'],
			['country_name' => 'Thái Lan', 'country_alias' => 'thai-lan'],
			['country_name' => 'Trung Quốc', 'country_alias' => 'trung-quoc'],
			['country_name' => 'Quốc Gia Khác', 'country_alias' => 'quoc-gia-khac']
			]);
	}

}
class FilmSliderDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('film_sliders')->insert([
			//1
			[
				'slider_name' => 'Tokyo Ravens',
				'slider_dir' => 'https://www.localhost/Dropbox/phimhaynew/film/tokyo-ravens-2013/7',
				'slider_image' => 'http://4.bp.blogspot.com/-8vj_XW5vtDQ/WG3zwFIcQPI/AAAAAAAAAp4/7G2l8HoCb9Yr-nCe1kDUBy_Gg-DCnWVyACK4B/s1600/tokyo-ravens-2013-poster-video.jpg'
			],//2
			[
				'slider_name' => 'https://www.localhost/Dropbox/phimhaynew/film/gakusen-toshi-asterisk-2-2016/5',
				'slider_dir' => 'https://www.localhost/Dropbox/phimhaynew/film/gakusen-toshi-asterisk-2-2016/5',
				'slider_image' => 'http://1.bp.blogspot.com/-adQxs6gFrFw/WG8gUWDuJBI/AAAAAAAAA5Y/X_7fmizBgBA_dbYGffSsh1SCsUamjIeogCK4B/s1600/gakusen-toshi-asterisk-2-2016-poster-video.jpg'
			],//3
			[
				'slider_name' => 'Guilty Crown',
				'slider_dir' => 'https://www.localhost/Dropbox/phimhaynew/film/guilty-crown-2012/6',
				'slider_image' => 'http://3.bp.blogspot.com/-99Ie3zbvyJY/WG8jExIeZiI/AAAAAAAAA6I/O-jMkWNSZscDC8FpZzMARH8SJsxzPMFdwCK4B/s1600/guilty-crown-2012-poster-video.jpg'
			],//4
			[
				'slider_name' => 'The White Haired Witch of Lunar Kingdom -Bạch Phát Ma Nữ',
				'slider_dir' => 'https://www.localhost/Dropbox/phimhaynew/film/bach-phat-ma-nu-the-white-haired-witch-of-lunar-kingdom-2014/12',
				'slider_image' => 'http://4.bp.blogspot.com/-nQ5UfipVQek/WG5pLfoi9NI/AAAAAAAAAwY/78IVu4Kld90CYoDuxf_gCSVcphjdoKVmACK4B/s1600/bach-phat-ma-nu-the-white-haired-witch-2014-poster-video.jpg'
			],

		]);
	}

}
class PhimHayConfigDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('phim_hay_configs')->insert([
			[
				'get_link_local' => 1, 
				'get_link_remote_api' => 'https://api.blogit.vn/getlink.php?link=', 
				'get_link_episode_local' => 1,
				'fb_app_id' => '367135626990588',
				'fb_page_url' => 'https://www.facebook.com/PhimHay-396819140663825',
				'fb_page_name' => 'Phim Hay'
			]
			
		]);
	}

}
class FilmDetailDatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('film_details')->insert([
			//1
			//vùng nước tử thần 2016
			[	
				'film_category' => 'le', 
				'film_info' => '<p>Bộ phim kể về một c&ocirc; g&aacute;i trẻ Mia (do Blake Lively thủ vai) đang bị mắc kẹt một m&igrave;nh tr&ecirc;n một mỏm đ&aacute; c&aacute;ch bờ khoảng 20km. Mở đầu trailer l&agrave; h&igrave;nh ảnh biển cả m&ecirc;nh m&ocirc;ng với những ngọn s&oacute;ng biển dữ tợn từng đợt, từng đợt dồn dập v&agrave; mạnh mẽ.&lt;br&gt;Giữa thi&ecirc;n nhi&ecirc;n bao la, rộng lớn sự xuất hiện trơ trọi của một c&ocirc; g&aacute;i đang bị thương khiến người xem c&agrave;ng th&ecirc;m t&ograve; m&ograve;, đặt ra h&agrave;ng trăm dấu chấm hỏi. Sự hiếu kỳ ấy c&agrave;ng tăng cao khi nh&acirc;n vật thứ hai xuất hiện &ndash; c&aacute; mập trắng, lo&agrave;i sinh vật săn mồi đầy &aacute;m ảnh dưới đ&aacute;y biển s&acirc;u đang c&oacute; mặt tại v&ugrave;ng nước cạn.</p><p><img src="https://2.bp.blogspot.com/-sYt732Uc1XY/WG3GiqlkYuI/AAAAAAAAAmU/thKowrEueEIj-lJFiwHB7s4q_LPFqZ3xgCLcB/s1600/vung-nuoc-tu-than-the-shallows-2016-poster-video.jpg" alt="" width="710" height="444" /></p>', 
				'film_score_imdb' => 6.9, 
				'film_score_aw' => 0, 
				'film_type' => 'kinh-di,hoi-hop-gay-can', 
				'film_country' => 'my', 
				'film_director' => '', 
				'film_actor' => '', 
				'film_release_date' => '2016-08-05',
				'film_production_company' => '', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'https://2.bp.blogspot.com/-N-XhRA5X4Yg/WG3Gint456I/AAAAAAAAAmc/KLjPTJHXZAMijEtMeGmEYzSMVka6zds7QCLcB/s1600/vung-nuoc-tu-than-the-shallows-poster-450x600.jpg', 
				'film_poster_video' => 'https://2.bp.blogspot.com/-sYt732Uc1XY/WG3GiqlkYuI/AAAAAAAAAmU/thKowrEueEIj-lJFiwHB7s4q_LPFqZ3xgCLcB/s1600/vung-nuoc-tu-than-the-shallows-2016-poster-video.jpg',
				'film_key_words' =>'shallows, vùng nước tử thần'
			],
			//2
			//terra-formars-2014
			[	'film_category' => 'hhbo', 
				'film_info' => 'Giờ là năm 2577, con tàu có người lái đầu tiên đã đáp xuống Sao Hỏa với 6 phi hành gia được đưa đến để làm nhiệm vụ. Nhưng tất cả những gì họ thấy được là Những con Gián đột biến hình người với sức mạnh kinh hồn. Họ đã bị giết sạch, tuy nhiên, họ đã gửi được tín hiệu về Trái Đất. Giờ đây, con người đã đưa các chiến binh ưu tú nhất để diệt gọn đám bọ đột biến và giành lại Sao Hỏa. ', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,phieu-luu,vien-tuong', 
				'film_country' => 'nhat-ban', 
				'film_director' => 'Jaume Collet Serra', 
				'film_actor' => 'Blake Lively (Nancy), Oscar Jaenada (Carlos)', 
				'film_release_date' => '',
				'film_production_company' => '', 
				'film_relate_id' => 4, 
				'film_thumbnail_big' => 'http://1.bp.blogspot.com/-xWX17uxxGmc/WG8N-UcmiCI/AAAAAAAAA3c/g8nCQ94czncI8LtdGixmFRiMzoJXu6HpgCK4B/s1600/terra-formars-2014-poster-big.jpg', 
				'film_poster_video' => 'http://1.bp.blogspot.com/-ROK6r8ExohU/WG8N-IlnqdI/AAAAAAAAA3M/uhTdxqanV6wAaZjB2anG60Rur8emlT3AgCK4B/s1600/terra-formars-2014-poster-video.jpg',
				'film_key_words' =>'Terra Formars'
			],
			//3
			//terra-formars-revenge-2016
			[	'film_category' => 'hhbo', 
				'film_info' => 'Terraformars Revenge là sự tiếp nối của Phụ lục I arc, là phần tiếp theo của BUGS-I arc, được đặt trong một dự án OVA, cũng như các bộ phim live-action sắp tới. 
					Terraformars: Revenge có cốt truyện xoay quanh nhóm nhân vật chính có nhiệm vụ bảo vệ trái đất khỏi cuộc xâm lăng của những sinh vật đầy bí ẩn đến từ hành tinh Sao Hỏa. Các nhà khoa học thế kỷ 21 có nhiệm vụ terraforming hạt giống hành tinh này với một loại tảo sửa đổi để hấp thụ ánh sáng mặt trời và thanh lọc không khí, và gián mà xác chết lan tảo khắp hành tinh vì chúng ăn. 
					Năm trăm năm sau, con tàu có người lái đầu tiên đến những vùng đất sao Hỏa và sáu thành viên phi hành đoàn của mình bị tấn công bởi gián hình người đột biến khổng lồ với sức mạnh vật lý đáng kinh ngạc, sau đó dán nhãn “Terraformars”; phi hành đoàn bị xóa sổ sau khi gửi một cảnh báo về Trái đất. Nhiều thập kỷ sau đó, một đoàn đa quốc gia được gửi để tiêu diệt những con bọ đột biến và kiểm soát được các hành tinh đỏ chỉ để được kẻ bại trận là tốt, ngoại trừ hai người sống sót người quản lý để trở về Trái đất, một câu chửi thề để trở về và trả thù cho đồng rơi họ. Như một chuyến thám hiểm thứ ba được lắp ráp, câu hỏi được đặt ra về nguồn gốc thực sự của Terraformars và kết nối họ với một loại virus nhân loại bị mắc bệnh chết người. Để chống lại sức mạnh và sự nhanh nhẹn của Terraformars, các thành viên của đoàn thám hiểm thứ hai và thứ ba trải qua biến đổi gen để kế thừa các đặc tính của sinh vật khác, chỉ có thể sau khi có một cơ quan đặc biệt được cấy ghép với một cơ hội 36% sống sót trong phẫu thuật riêng của mình. ', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,phieu-luu,vien-tuong', 
				'film_country' => 'nhat-ban', 
				'film_director' => '', 
				'film_actor' => '', 
				'film_release_date' => '',
				'film_production_company' => '', 
				'film_relate_id' => 4, 
				'film_thumbnail_big' => 'http://3.bp.blogspot.com/-Vx_it9EJ7Ws/WG8RslrjwwI/AAAAAAAAA4M/TC3NVEHC9k0iZtc19lWHy9sGDA4jEd-lwCK4B/s1600/terra-formars-revenge-2016-poster-big.jpg', 
				'film_poster_video' => 'http://1.bp.blogspot.com/-3nrgoIIJrk0/WG8RsolZCsI/AAAAAAAAA4E/kxaVJUNoKYInj73DsBvl2Kr-X7QL1wY8wCK4B/s1600/terra-formars-revenge-2016-poster-video.jpg',
				'film_key_words' => 'Terra Formars'
			],
			//4
			//gakusen-toshi-asterisk-1-2015
			[	'film_category' => 'hhbo', 
				'film_info' => 'Gakusen Toshi Asterisk 1 là bộ tiểu thuyết thuộc thể loại hành động, khoa học viễn tưởng do Miyazaki Yuu sáng tác và okiura vẽ minh hoạ. Bối cảnh diễn ra câu chuyện là Học viện Seidokan nằm trên thành phố nổi Rikka, nơi tổ chức sự kiện Star Wars. Đó là một sự kiện trọng đại của thế giới, tập trung những chiến binh trẻ tuổi tài giỏi đến từ 6 ngôi trường khác nhau nhằm tìm ra người đứng đầu. Nhân vật chính là Ayato Amagiri đã chuyển đến Rikka sau khi nhận được lời mời của Chủ tịch Hội học sinh trường Seidoukan. Nhưng ngay ngày đầu tiên nhập học, anh đã vô tình chọc giận cô nàng hung dữ Julis với biệt danh “Hoả công chúa”. ', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,gia-tuong', 
				'film_country' => 'nhat-ban', 
				'film_director' => '', 
				'film_actor' => '', 
				'film_release_date' => '??/??/2015',
				'film_production_company' => '', 
				'film_relate_id' => 5, 
				'film_thumbnail_big' => 'http://3.bp.blogspot.com/-WP8g8BTtFks/WG8bKf4sn8I/AAAAAAAAA48/XHEoRbmvkZUoaD8cxCwNDDs7CIiiuTQQACK4B/s1600/gakusen-toshi-asterisk-1-2015-poster-big.jpg', 
				'film_poster_video' => 'http://2.bp.blogspot.com/-AOcDmj39DsE/WG8bJ_qdPwI/AAAAAAAAA4g/M5mh6oxQAoIjnHrFQCDfPjXOv5Mr16VhwCK4B/s1600/gakusen-toshi-asterisk-1-2015-poster-video.jpg',
				'film_key_words' => 'Gakusen Toshi Asterisk'
			]
			//gakusen-toshi-asterisk-2-2016
			//5
			,
			[	'film_category' => 'hhbo', 
				'film_info' => 'Gakusen Toshi Asterisk | The Asterisk War: The Academy City on the Water | Academy Battle City Asterisk là bộ tiểu thuyết thuộc thể loại hành động, khoa học viễn tưởng do Miyazaki Yuu sáng tác và okiura vẽ minh hoạ. Bối cảnh diễn ra câu chuyện là Học viện Seidokan nằm trên thành phố nổi Rikka, nơi tổ chức sự kiện Star Wars. Đó là một sự kiện trọng đại của thế giới, tập trung những chiến binh trẻ tuổi tài giỏi đến từ 6 ngôi trường khác nhau nhằm tìm ra người đứng đầu.', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,gia-tuong', 
				'film_country' => 'nhat-ban', 
				'film_director' => '', 
				'film_actor' => '', 
				'film_release_date' => '??/??/2016',
				'film_production_company' => '', 
				'film_relate_id' => 5, 
				'film_thumbnail_big' => 'http://1.bp.blogspot.com/-L35hEo6dozs/WG8gUImf15I/AAAAAAAAA5U/LjxGLP5JUS4CRycANN-REoNLsSpE-g4cACK4B/s1600/gakusen-toshi-asterisk-2-2016-poster-big.jpg', 
				'film_poster_video' => 'http://1.bp.blogspot.com/-adQxs6gFrFw/WG8gUWDuJBI/AAAAAAAAA5Y/X_7fmizBgBA_dbYGffSsh1SCsUamjIeogCK4B/s1600/gakusen-toshi-asterisk-2-2016-poster-video.jpg',
				'film_key_words' => 'Gakusen Toshi Asterisk'
			]
			//6
			//Guilty Crown 2012
			,
			[	'film_category' => 'hhbo', 
				'film_info' => 'Sau thảm họa do virus Apocalypse - Khải Huyền gây ra. Toàn bộ nước Nhật bị tàn phá nặng nề và rơi vào hỗn loạn phải nhờ đến tổ chức do các nước trên thế giới lập ra ứng cứu. Nhân vật chính của câu chuyện, Ouma Shu, một nam sinh cấp 3 bình thường sống trong một xã hội bất ổn với tâm trạng chán chường và ngại va chạm trong một lần tình cờ đã gặp một người con gái mà về sau thay đổi hoàn toàn cuộc đời cậu.', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,gia-tuong,phep-thuat', 
				'film_country' => 'nhat-ban', 
				'film_director' => '', 
				'film_actor' => '', 
				'film_release_date' => '??/??/2012',
				'film_production_company' => '', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://4.bp.blogspot.com/-gIOJMp_Kxw0/WG8jEaL1bvI/AAAAAAAAA6A/YONPwXwMsBcXPARD51HHtvPu_UfghIeMgCK4B/s1600/guilty-crown-2012-poster-big.jpg', 
				'film_poster_video' => 'http://3.bp.blogspot.com/-99Ie3zbvyJY/WG8jExIeZiI/AAAAAAAAA6I/O-jMkWNSZscDC8FpZzMARH8SJsxzPMFdwCK4B/s1600/guilty-crown-2012-poster-video.jpg',
				'film_key_words' => 'Guilty Crown'
			]
			//7
			//tokyo-ravens-2013
			,
			[	'film_category' => 'hhbo', 
				'film_info' => 'Câu chuyện xoay quanh Harutora, một nam sinh xuất thân từ một nhánh của gia tộc Tsuchimikado danh giá có truyền thống hành nghề pháp sư Onmyoudou. Thế nhưng do không có khả năng nhìn thấy năng lượng tâm linh nên cậu chỉ là một học sinh trung học bình thường. Cho đến khi Natsume, bạn thuở nhỏ của Harutora và là trưởng tộc tiếp theo của nhà Tsuchimikado, tái ngộ với Harutora và thay đổi tuơng lai của cậu ta.', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,gia-tuong,phep-thuat', 
				'film_country' => 'nhat-ban', 
				'film_director' => '', 
				'film_actor' => '', 
				'film_release_date' => '??/??/2013',
				'film_production_company' => '', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://3.bp.blogspot.com/-egOsib0ulrg/WG3zwAef-5I/AAAAAAAAAqQ/lKo_dExB_WUrvaNqcVVMEwyEofYjqcy-wCK4B/s1600/tokyo-ravens-2013-poster-big.jpg', 
				'film_poster_video' => 'http://4.bp.blogspot.com/-8vj_XW5vtDQ/WG3zwFIcQPI/AAAAAAAAAp4/7G2l8HoCb9Yr-nCe1kDUBy_Gg-DCnWVyACK4B/s1600/tokyo-ravens-2013-poster-video.jpg',
				'film_key_words' => 'Tokyo Ravens'
			],
			//8
			//k return of kings 2015
			[	'film_category' => 'hhbo', 
				'film_info' => 'Tại Nhật Bản lúc hiện đại, nơi mà lịch sử chồng chéo mọi thứ với thực tế. Có, bảy "Vua" lớn mạnh cùng tồn tại. Cùng với những người cùng dòng họ chia sẻ quyền lực cho nhau, các vị vua mỗi gia tộc được hình thành. Từ đó các cuộc chiến nổ ra gây nên sự hỗn loạn khắp nơi, Số phận của các vị vua đó sẽ ra sao ? mời bạn đón xem', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hoat-hinh,hanh-dong,vien-tuong,phep-thuat', 
				'film_country' => 'nhat-ban', 
				'film_director' => '', 
				'film_actor' => '', 
				'film_release_date' => '??/??/2015',
				'film_production_company' => '', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://3.bp.blogspot.com/-D4b6HhHS8kc/WG31MExHZ9I/AAAAAAAAAqk/9uBdgdIXTBcb5BlwxGecLr0b6kAkbpjcACK4B/s1600/k-return-of-things-2015-poster-big.jpg', 
				'film_poster_video' => 'http://4.bp.blogspot.com/-Y3FENuvkEgc/WG31MZcHRKI/AAAAAAAAAqs/YKG7jGr4BnEDv2R2XUEz2pKEWbrZCTC5ACK4B/s1600/k-return-of-things-2015-poster-video.jpg',
				'film_key_words' => 'k return of kings'
			],
			//9
			//Ao No Exorcist 2011
			[	'film_category' => 'hhbo', 
				'film_info' => 'Phim chỉ dành cho đối tượng trên 13 tuổi. Câu truyện xoay quanh một chàng trai tên là Okumura Rin, cậu được nuôi lớn bởi một Chuyên Gia Diệt Quỷ (Exorcist) nổi tiếng tên là Fujimoto Shirou, rồi một ngày cậu chợt biết được rằng mình chính là con trai của quỷ dữ Satan, rồi số phận của cậu đứng giữa sự lựa chọn: làm con trai của quỷ hoặc là trở thành một Chuyên Gia Diệt Quỷ.', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,gia-tuong,sieu-nhien', 
				'film_country' => 'nhat-ban', 
				'film_director' => '', 
				'film_actor' => '', 
				'film_release_date' => '??/??/2011',
				'film_production_company' => '', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://2.bp.blogspot.com/-S1OZmOGOgIE/WG32XIIKlPI/AAAAAAAAArU/KlEILXCoEsU0X0OG_pgFuc9O17Ft4FOxgCK4B/s1600/ao-no-exorcist-2011-poster-big.jpg', 
				'film_poster_video' => 'http://1.bp.blogspot.com/-bCDgazet2e0/WG32XcLorjI/AAAAAAAAArc/fPR1jFelJecw6HMGbkq6ks2od0Bs-zS_wCK4B/s1600/ao-no-exorcist-2011-poster-video.jpg',
				'film_key_words' => 'Ao No Exorcist'
			],
			//10
			//Sword Art Online 1 2013
			[	'film_category' => 'hhbo', 
				'film_info' => 'Con đường sống duy nhất là đánh bại mọi kẻ thù. Cái chết trong game đồng nghĩa với cái chết ngoài đời thực. Bằng Nerve Gear, mười ngàn con người lao đầu vào một trò chơi bí ẩn "Sword Art Online", để rồi bị giam cầm trong đó, buộc phải dấn thân vào một đấu trường sinh tử. Anh main của chúng ta, Kirito, một trong số các game thủ, đã nhận ra được sự thật khủng khiếp này. Anh đơn thương độc mã, chiến đấu trong một lâu đài bay khổng lồ - mang tên "Aincrad". Để có thể hoàn thành trò chơi và trở về với thực tại, anh phải vượt qua đủ 100 thử thách. Liệu anh có thể làm được hay anh sẽ về với cát bụi?', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,tinh-cam,gia-tuong,phieu-luu', 
				'film_country' => 'nhat-ban', 
				'film_director' => '', 
				'film_actor' => '', 
				'film_release_date' => '??/??/2013',
				'film_production_company' => '', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://2.bp.blogspot.com/-5Sxz3Kn9vVQ/WG34q1-X_8I/AAAAAAAAAs8/KX7EiQDtbmYKheSMkEK_7L7WH4yw8y8eQCK4B/s1600/sword-art-online-1-2013-poster-big.jpg', 
				'film_poster_video' => 'http://1.bp.blogspot.com/-oCed3pjCn7g/WG34rtoXuiI/AAAAAAAAAtU/o3HPrq6UtKo0PBECGUemMrIq96xMWBZNACK4B/s1600/sword-art-online-1-poster-video.jpg',
				'film_key_words' => 'Sword Art Online, Đao Kiếm Thần Vực'
			],
			//11
			//Sword Art Online 2 2014
			[	'film_category' => 'hhbo', 
				'film_info' => 'Một năm sau khi phá đảo Sword Art Online (SAO), Kirito đã được Kikuoka mời khám phá thử Gun Gale Online, mà cụ thể là Death Gun, một vũ khí dường như là liên kết những cái chết trong thế giới thực tế ảo và thế giới thật. Khi vào game, Kirito gặp Sinon, người hướng dẫn cậu cách chơi (cày cuốc, sắm đồ, PK này nọ). Dần dần Kirito phát hiện ra những cái chết bí ẩn đều có liên quan đến một Guild có tên là Laughing Coffin trong SAO ngày xưa. (nguồn SAO Wikia)
				', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,tinh-cam,gia-tuong,phieu-luu', 
				'film_country' => 'nhat-ban', 
				'film_director' => '', 
				'film_actor' => '', 
				'film_release_date' => '??/??/2014',
				'film_production_company' => '', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://2.bp.blogspot.com/-9SYqiyp1III/WG397czdLvI/AAAAAAAAAt0/-NiFWWTaQmA723M_h3KhwQn7uCbrifjUgCK4B/s1600/sword-art-online-2-2014-poster-big.jpg', 
				'film_poster_video' => 'http://2.bp.blogspot.com/-BGcwaBWsGW0/WG397mroCoI/AAAAAAAAAuI/Yrf_DrDQT0Ab60GwGi5eAHzgS8Rf1GmKQCK4B/s1600/sword-art-online-2-2014-poster-video.jpg',
				'film_key_words' => 'Sword Art Online'
			],
			//12
			// Bạch Phát Ma Nữ The White Haired Witch of Lunar Kingdom 2014
			[	'film_category' => 'le', 
				'film_info' => 'Phim Có bối cảnh là đời nhà Minh, Bạch phát ma nữ xoay quanh câu chuyện tình buồn giữa Luyện Nghê Thường (Phạm Băng Băng) và Trác Nhất Hàng (Huỳnh Hiểu Minh). Trên đường đến Bắc Kinh để tỏ lòng thành kính tới hoàng đế, Nhất Hàng đã gặp và yêu một phụ nữ xinh đẹp tên Nghê Thường. Tuy nhiên, những sư phụ trong Võ Đang phái của Nhất Hàng đã phản đối mối quan hệ này bởi Nghê Thường bị nghi ngờ chính là người đã ám sát ông nội Nhất Hàng. Sau khi để Nhất Hàng tới Bắc Kinh với mục đích làm sáng tỏ sự thật, Nghê Thường phải nhận cú sốc khi biết tin Nhất Hàng đã bội ước và cưới vợ. Trước sự thật đó, mái tóc của Nghê Thường bạc trắng chỉ sau 1 đêm.', 
				'film_score_imdb' => 4.9, 
				'film_score_aw' => 0, 
				'film_type' => 'tinh-cam,than-thoai', 
				'film_country' => 'trung-quoc', 
				'film_director' => 'Zhang Zhiliang', 
				'film_actor' => 'Huỳnh Hiểu Minh (Zhuo Yihang), Phạm Băng Băng (Lian Nishang), Triệu Văn Trác (Jin Duyi)', 
				'film_release_date' => '??/??/2014',
				'film_production_company' => '', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://1.bp.blogspot.com/-bc57tpSoL5Y/WG5m8wQ5rXI/AAAAAAAAAwE/daFz-3q-T4wvEeuUxKsrfPTtY5iFfaIGwCK4B/s1600/bach-phat-ma-nu-the-white-haired-witch-2014-poster-big.jpg', 
				'film_poster_video' => 'http://4.bp.blogspot.com/-nQ5UfipVQek/WG5pLfoi9NI/AAAAAAAAAwY/78IVu4Kld90CYoDuxf_gCSVcphjdoKVmACK4B/s1600/bach-phat-ma-nu-the-white-haired-witch-2014-poster-video.jpg',
				'film_key_words' => 'The White Haired Witch of Lunar Kingdom, Bạch Phát Ma Nữ'
			],
			//13
			//tuyet-dinh-kung-fu-kung-fu-hustle-2004
			[	'film_category' => 'le', 
				'film_info' => 'Trong xã hội hỗn loạn ở Trung Quốc những năm 1940, các băng nhóm thực sự có ảnh hưởng. Đáng sợ nhất phải kể đến đảng Lưỡi Búa. Đại ca của đảng Lưỡi búa Lúc bấy giờ là Sum (Trần Quốc Khôn). Hắn vốn là kẻ say mê chém giết lại cực kỳ nhẫn tâm. Băng nhóm của Sum đi đến đâu nỗi kinh hoàng theo tới đó. Người dân thành phố thì lo lắng, đám cảnh sát thì sợ sệt. Chỉ duy có khu ổ chuột Chuồng Heo là không bị đám côn đồ đảng Lưỡi Rìu nhũng nhiễu vì người dân nơi đây quá nghèo. Nhưng một ngày kia, đột nhiên có hai tên lang thang giả dạng lưu manh Sing (Châu Tinh Trì) và Bone xuất hiện và định moi tiền của một anh thợ cắt tóc. Xung đột xảy ra và bọn chúng được phen bất ngờ khi toàn bộ dân khu này ai cũng rất giỏi võ. Nhưng rắc rối ở chỗ đảng Lưỡi Rìu lại kéo tới chi viện, chúng bị các cao thủ công phu đánh cho một trận thừa sống thiếu chết. Mẫu thuẫn trở nên sâu sắc hơn bao giờ hết, đai ca Sum kéo quân tới cho đám dân đen một bài học cũng bị họ đánh cho tan tác. Để rửa sạch mối nhục này, Sum phái Sing đi mời đại cao thủ Quái Vật (Lương Tiểu Long) bất bại về làm cỏ khu Chuồng Heo. Tuy nhiên, xuất hiện một người anh hùng có khả năng chặn đứng Quái Vật, anh là ai?', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,hai-huoc,vo-thuat', 
				'film_country' => 'hong-kong', 
				'film_director' => 'Châu Tinh Trì', 
				'film_actor' => 'Châu Tinh Trì,Man Keung Chan', 
				'film_release_date' => '20/12/2004',
				'film_production_company' => '', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://3.bp.blogspot.com/-nM9H_8uccX8/WHXEXbIeIHI/AAAAAAAAA7s/jvLMpjGIew8Q4aUnvmOTVbu3-kBfCYB7QCK4B/s1600/tuyet-dinh-kung-fu-kung-fu-hustle-2004-poster-big.jpg', 
				'film_poster_video' => 'http://2.bp.blogspot.com/-xZ7-plHnBE8/WHXEXiyMYrI/AAAAAAAAA78/Egm5WQoiJ2sy4Vqvb3uQ2QcfT8v3o5emgCK4B/s1600/tuyet-dinh-kung-fu-kung-fu-hustle-2004-poster-video.jpg',
				'film_key_words' => 'Tuyệt Đỉnh Kung Fu,Kung Fu Hustle,Kung Fu'
			],
			//14
			//Tôi Là Người Hùng - I Am A Hero 2016
			[	'film_category' => 'le', 
				'film_info' => 'Dựa trên bộ truyện “I Am a Hero” sáng tác bởi Kengo Hanazawa (Xuất bản lần đầu trên tạp chí truyện tranh thiếu niên Big Comic Spirits, vào ngày 20 tháng 4 năm 2009). Bộ phim được khởi quay vào đầu tháng 6, năm 2014 và đóng máy vào tháng 8, năm 2014.
				Một loại virus bí ẩn đột ngột lây lan toàn nước Nhật khiến dân tình hoảng loạn trên diện rộng. Những người bị nhiễm virus được gọi với cái tên là ZQN. ZQN có trong mình sức mạnh siêu nhiên và những người bị ZQN cắn cũng sẽ biến thành chúng.
				Suzuki Hideo (Yo Oizumi) đã bất ngờ gặp được cô nữ sinh cấp 3 Hayakari Hiromi (Kasumi Arimura). Hai chú cháu đã cùng nhau chạy trốn, nhưng Hiromi đã bị cắn bởi một đứa trẻ nhiễm ZQN. Vì đứa trẻ nhiễm ZQN đó chưa có răng nên cô chưa hoàn toàn biến thành ZQN. Hành trình kiếm nơi trú ẩn an toàn của hai chú cháu sẽ ra sao ? Hãy đón xem bộ phim để biết thêm chi tiết nhé :))
				', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,zombie,kinh-di', 
				'film_country' => 'nhat-ban', 
				'film_director' => 'Shinsuke Sato', 
				'film_actor' => 'Yo Oizumi (Suzuki Hideo), Kasumi Arimura (Hayakari Hiromi), Yu Tokui (Abe-san)', 
				'film_release_date' => '23/04/2016',
				'film_production_company' => 'Minami Ichikawa', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://1.bp.blogspot.com/-RNNWM1bIH9k/WHXIsy0ysjI/AAAAAAAAA8Q/75rA9H35XAsggiLOs7PRGLaZXLhJDX0jQCK4B/s1600/i-am-a-hero-2016-poster-big.jpg', 
				'film_poster_video' => 'http://1.bp.blogspot.com/-5eettg1cJ5Q/WHXItJIhEgI/AAAAAAAAA8g/7avtxnLWMiQtkmfS9GLu1uTj-pTbmz8NQCK4B/s1600/i-am-a-hero-2016-poster-video.jpg',
				'film_key_words' => 'Tôi Là Người Hùng,I Am A Hero'
			],
			//15
			//Héc Quyn - Hercules: The Thracian Wars 2014
			[	'film_category' => 'le', 
				'film_info' => 'Hercules. Bị ám ảnh bởi một tội lỗi đã gây ra trong quá khứ, Hercules giờ đây trở thành một “tay lính đánh thuê” và cùng với năm bạn đồng hành trung thành, anh phiêu lưu khắp Hy Lạp, bán sức mạnh của mình để đổi lấy vàng và dùng danh tiếng lẫy lừng khiến kẻ thù khiếp sợ. Nhưng khi vị vua nhân từ của xứ Thrace và cháu gái ông nhờ đến sự giúp đỡ của Hercules để đánh bại một tên chúa tể tàn bạo khát máu, anh nhận ra rằng một khi thực thi công lý và giành lấy vinh quang, anh sẽ trở lại thành người anh hùng năm xưa, trở lại thành Hercules trong thần thoại.', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,than-thoai', 
				'film_country' => 'my', 
				'film_director' => 'Brett Ratner', 
				'film_actor' => 'Dwayne Johnson (Hercules), Irina Shayk (Megara), Ingrid Bolsø Berdal (Atalanta), Ian McShane (Amphiaraus), John Hurt (Cotys)', 
				'film_release_date' => '25/07/2014',
				'film_production_company' => 'Brett Ratner, Beau Flynn, Barry Levine', 
				'film_relate_id' => 6, 
				'film_thumbnail_big' => 'http://1.bp.blogspot.com/-KywKesbDRp8/WHYEMmdaZPI/AAAAAAAAA9Q/fxFLiPQBn-A9ZVEzEZyaAskaYM_P-7PiwCK4B/s1600/hec-quyn-hercules-2014-poster-big.jpg', 
				'film_poster_video' => 'http://4.bp.blogspot.com/-Jt6r__AkiJY/WHYEMi91rCI/AAAAAAAAA9A/53xqRoEHALUrwIlT5G3hAuOdY-wAUZsrQCK4B/s1600/hec-quyn-hercules-2014-poster-video.jpg',
				'film_key_words' => 'Héc Quyn,Hercules,The Thracian Wars4'
			],
			//16
			//Chiến Binh Frankenstein - I, Frankenstein 2014 
			[	'film_category' => 'le', 
				'film_info' => 'Tôi, Frankenstein - I, Frankenstein là một bộ phim hành động giả tưởng Mỷ của đạo diễn Stuart Baettie dựa trên cuốn tiểu thuyết của Kevin Grevioux. Hai thế kỷ sau khi tiến sĩ Frankenstein lắp ráp và tạo ra nguồn sức mạnh mới cho thuộc hạ của mình - Adam (Aaron Eckhart). Ông bị lôi kéo vào một cuộc chiến tranh giữa hai chủng tộc bất tử: Nhân sư, những người bảo vệ những nét tinh hoa của nhân loại và ác quỷ. Kể từ khi Adam không còn là con người hay quỷ, nữ hoàng Leonore (Miranda Otto) và hoàng tử quỷ Naberius (Bill Nighy), mỗi người muốn anh ta phục vụ cho mục đích riêng của họ. Đó cũng chính là lý do để Adam khám phá con người bên trong và đi tìm câu trả lời cho mục đích tồn tại của mình.', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hoat-hinh,hanh-dong,vien-tuong', 
				'film_country' => 'my', 
				'film_director' => 'Stuart Beattie', 
				'film_actor' => 'Aaron Eckhart (Quái vật Frankenstein), Yvonne Strahovski (Terra)', 
				'film_release_date' => '20/01/2014',
				'film_production_company' => 'Tom Rosenberg, Gary Lucchesi, Richard S. Wright, Andrew Mason', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://2.bp.blogspot.com/-kMpKQW8CpLI/WHYLVb_ATfI/AAAAAAAAA98/131h8xWf2aIuvaJ8VfJhPAAROVDdCOElgCK4B/s1600/chien-binh-frankenstein-i-frankenstein-2014-poster-big.jpg', 
				'film_poster_video' => 'http://4.bp.blogspot.com/-pxhPGHmVV9g/WHYLV_Vk3QI/AAAAAAAAA-Q/y5NY1LNSbzMcKKTaw29HLwh1nFiIOf5sQCK4B/s1600/chien-binh-frankenstein-i-frankenstein-2014-poster-video.jpg',
				'film_key_words' => 'Chiến Binh Frankenstein,Frankenstein'
			]
			,
			//17
			//Hành Tinh XT 59 - Vychislitel Titanium Strafplanet XT-59 2014
			[	'film_category' => 'le', 
				'film_info' => 'Hành Tinh XT-59 - Titanium - Strafplanet XT-59/Vychislitel 2014: Trong một tương lai xa, một nhóm tù nhân thấy mình bị kết án lưu đày trên một hành tinh XT-59... Dưới chân họ, một mối đe dọa lớn hơn ... Để có được một nơi trú ẩn bình yên thì họ phải vượt qua rất nhiều trở ngại, để kết quả đạt được là tự do và hạnh phúc...', 
				'film_score_imdb' => 4.2, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,vien-tuong,phieu-luu', 
				'film_country' => 'nga', 
				'film_director' => 'Dmitriy Grachev', 
				'film_actor' => 'Yevgeny Mironov (Erwin Kann), Anna Chipovskaya (Kristi), Vinnie Jones (Just van Borg)', 
				'film_release_date' => '18/12/2014',
				'film_production_company' => 'Fyodor Sergeyevich Bondarchuk, Dmitriy Mednikov, Aleksey Kurenkov', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://4.bp.blogspot.com/-Ofl_OtK0zqg/WHYQCs3dmcI/AAAAAAAAA-s/VUDRrbJZJhQhEX1zD3T0Q5Gjues2bcUmACK4B/s1600/hanh-tinh-xt-59-vychislitel-2014-poster-big.jpg', 
				'film_poster_video' => 'http://1.bp.blogspot.com/-QfORJWtDW0s/WHYQCpA2jgI/AAAAAAAAA-k/u3KxhRsVfscyPPhqeCyIABUvs2tGm756gCK4B/s1600/hanh-tinh-xt-59-vychislitel-2014-poster-video.jpg',
				'film_key_words' => 'Hành Tinh XT-59,Vychislitel,Titanium Strafplanet XT-59 2014'
			],
			//18
			//Hành Tinh Đỏ - Red Planet 2000
			[	'film_category' => 'le', 
				'film_info' => 'Phim Hành Tinh Đỏ lấy bối cảnh tương lai, hệ sinh thái trái Đất đứng bên bờ diệt vong bởi tình trạng ô nhiễm và bùng nổ dân số. Trước tình hình đó, nhiều quốc gia đã nghĩ tới chuyện đưa dân lên sao hỏa. Trong những lần đổ bộ lên sao hỏa, các nhà khoa học mỹ tiến hành trồng tảo tại một trạm sinh thái để tạo ra bầu khí quyển trên hành tinh đỏ, chuẩn bị cho việc di dân sau này.
					12 năm sau, lượng không khí mà tảo tạo ra đột nhiên suy giảm, một con tàu vũ trụ mang tên mars-1 được phóng lên sao hỏa để tìm hiểu tình hình. Phi hành đoàn gồm 6 người, trong đó có nữ chỉ huy Kate Bwman, chuyên gia di truyền học Quinn Burchenal, nhà khoa học già kiêm bác sĩ phẫu thuật Bud Chantillas và kỹ sư máy Robby Gallagher. Liệu họ có tìm ra được những bí ẩn trên sao hỏa và sống sót để trở về hay không?', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,vien-tuong', 
				'film_country' => 'my', 
				'film_director' => 'Antony Hoffman', 
				'film_actor' => 'Carrie‑Anne Moss (Cmdr. Kate Bowman), Val Kilmer (Robby Gallagher), Tom Sizemore (Dr. Quinn Burchenal)', 
				'film_release_date' => '06/11/2000',
				'film_production_company' => 'Mark Canton, Bruce Berman, Jorge Saralegui', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://4.bp.blogspot.com/-hFb617gTpeA/WHYUAbpWr6I/AAAAAAAAA_Y/EYJ42awxjEMRuiKaeVyE8OQhI9duNZRagCK4B/s1600/hanh-tinh-do-red-planet-2000-poster-big.jpg', 
				'film_poster_video' => 'http://3.bp.blogspot.com/-mNe4DNPo2OU/WHYUALfOgbI/AAAAAAAAA_I/qf4WD6BsqF8SPZ3O4AFctsNqiQPnfeapwCK4B/s1600/hanh-tinh-do-red-planet-2000-poster-video.jpg',
				'film_key_words' => 'Hành Tinh Đỏ,Red Planet'
			],
			//19
			//Người Đến Từ Địa Ngục - Constantine 2005
			[	'film_category' => 'le', 
				'film_info' => 'John Constantine, người được tạo hóa ban tặng một món quà mà anh hoàn toàn không muốn, đó là khả năng nhận diện bản thể của thiên thần và ác quỷ tồn tại trong mỗi con người, chuyên điều tra những vụ án đầy huyền bí và siêu nhiên. Anh hợp tác với nữ thám tử Los Angeles là Angela Dodson điều tra cái chết bí ẩn của chị gái sinh đôi bị tâm thần Isabel Dodson. Khi còn sống, Isabel thường nhắc đến những điều quái dị mà người thường không thấy được. Lúc này trên vùng sa mạc Mexico, mầm mống của cái ác và bóng tối đang chờ cơ hội để trỗi dậy.', 
				'film_score_imdb' => 6.9, 
				'film_score_aw' => 0, 
				'film_type' => 'vien-tuong,kinh-di', 
				'film_country' => 'hong-kong', 
				'film_director' => 'Francis Lawrence', 
				'film_actor' => 'Keanu Reeves (John Constantine), Rachel Weisz (Isabel Dodson, Angela Dodson), Tilda Swinton (Gabriel), Shia LaBeouf (Chas Kramer)', 
				'film_release_date' => '08/02/2005',
				'film_production_company' => 'Warner Bros', 
				'film_relate_id' => 7, 
				'film_thumbnail_big' => 'http://3.bp.blogspot.com/-Wwai-cglITw/WHYZKRQRcgI/AAAAAAAAA_w/c68mca6IjtAvk8q6K7gvRZoq8FGONo04ACK4B/s1600/nguoi-den-tu-dia-nguc-constantine-2005-poster-big.jpg', 
				'film_poster_video' => 'http://4.bp.blogspot.com/-AQFetNS4dG4/WHYZKbzO-CI/AAAAAAAAA_o/Exq127UknJMf_JjpbmZFUwFuZuJI3PNGgCK4B/s1600/nguoi-den-tu-dia-nguc-constantine-2005-poster-video.jpg',
				'film_key_words' => 'người đến từ địa ngục,constantine'
			],
			//20
			//Bậc Thầy Diệt Quỷ - Constantine 2014
			[	'film_category' => 'bo', 
				'film_info' => 'John Constantine , một thợ săn quỷ và bậc thầy huyền bí, phải đấu tranh với tội lỗi quá khứ của mình trong khi bảo vệ những người vô tội khỏi những hiểm họa siêu nhiên hội tụ liên tục phá vỡ thế giới do các "Rising Darkness". Cân bằng hành động của mình trên các dòng của thiện và ác, Constantine sử dụng kỹ năng của mình và một bản đồ siêu nhiên nhìn vào viên phi lê để đoán tương lai cho cuộc hành trình trên toàn quốc để gửi những nỗi kinh hoàng trở lại với thế giới riêng của họ, tất cả cho những hy vọng cứu chuộc linh hồn mình khỏi sự đau khổ đời đời.', 
				'film_score_imdb' => 7.6, 
				'film_score_aw' => 0, 
				'film_type' => 'vien-tuong,kinh-di', 
				'film_country' => 'my', 
				'film_director' => '', 
				'film_actor' => 'Matt Ryan (John Constantine), Harold Perrineau (Manny), Angélica Celaya (Zed Martin), Charles Halford (Chas Chandler), Lucy Griffiths (Liv Aberdine)', 
				'film_release_date' => '24/10/2014',
				'film_production_company' => 'DC Comics', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => 'http://1.bp.blogspot.com/-B4WkR5JcVMM/WHzDhOOy64I/AAAAAAAABA4/ME1InW0pKM0Iqo1JgmNNWB_TbLfWfPBHwCK4B/s1600/bac-thay-diet-quy-constantine-1-2014-poster-big.jpg', 
				'film_poster_video' => 'http://1.bp.blogspot.com/-iRAKHOhPDlI/WHzDg__rkQI/AAAAAAAABAg/K5wtfJ6GB0wf4-c7UC5Txyop79dd3ZakQCK4B/s1600/bac-thay-diet-quy-constantine-1-2014-poster-video.jpg',
				'film_key_words' => 'Constantine,bậc thầy diệt quỷ'
			],
			/*
			//1
			//
			[	'film_category' => 'hhbo', 
				'film_info' => '', 
				'film_score_imdb' => 0, 
				'film_score_aw' => 0, 
				'film_type' => 'hanh-dong,vien-tuong', 
				'film_country' => '', 
				'film_director' => '', 
				'film_actor' => '', 
				'film_release_date' => '20/01/2014',
				'film_production_company' => '', 
				'film_relate_id' => 1, 
				'film_thumbnail_big' => '', 
				'film_poster_video' => '',
				'film_key_words' => ''
			]
			*/
			
			]);
	}

}
class FilmListDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('film_lists')->insert([
			[
				'id' => 1,
				'film_name_vn' => 'Vùng Nước Tử Thần',
				'film_name_en' => 'The Shallows',
				'film_time' => 86,
				'film_years' => '2016',
				'film_quality' => '720p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'https://3.bp.blogspot.com/-y1Jy2iksdK8/WG3GiuomhjI/AAAAAAAAAmY/sI3JTWtW-bIe1SlHZ20kkjelHeF9Cx3CACLcB/s1600/vung-nuoc-tu-than-the-shallows-poster-300x400.jpg',
				'film_dir_name' => 'vung-nuoc-tu-than-the-shallows-2016',
				'film_status' => 'HD'
			],
			[
				'id' => 2,
				'film_name_vn' => '',
				'film_name_en' => 'Terra Formars',
				'film_time' => '13',
				'film_years' => '2014',
				'film_quality' => '720p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://1.bp.blogspot.com/-xoHg6jNrPOQ/WG8N-BLXp6I/AAAAAAAAA3A/dBv1TblBEGc79XTSUoE3AC4HgjUA8XcZwCK4B/s1600/terra-formars-2014-poster-small.jpg',
				'film_dir_name' => 'terra-formars-2014',
				'film_status' => 'HD'
			]
			,
			[
				'id' => 3,
				'film_name_vn' => '',
				'film_name_en' => 'Terra Formars Revenge',
				'film_time' => '13',
				'film_years' => '2016',
				'film_quality' => '720p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://2.bp.blogspot.com/-M52EZqDuda8/WG8RseFjJFI/AAAAAAAAA3s/3CbeN-ApWZsBh7HxKVpUH6vnvowxL7E2gCK4B/s1600/terra-formars-revenge-2016-poster-small.jpg',
				'film_dir_name' => 'terra-formars-revenge-2016',
				'film_status' => 'HD'
			],
			[
				'id' => 4,
				'film_name_vn' => '',
				'film_name_en' => 'Gakusen Toshi Asterisk 1',
				'film_time' => 12,
				'film_years' => '2015',
				'film_quality' => '720p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://2.bp.blogspot.com/-T2vVh6iQork/WG8bKU_LUDI/AAAAAAAAA40/3aqWWqCK3x4HHQdESiUDLWHgG7BUHo7ZgCK4B/s1600/gakusen-toshi-asterisk-1-2015-poster-small.jpg',
				'film_dir_name' => 'gakusen-toshi-asterisk-1-2015',
				'film_status' => 'HD'
			],
			[
				'id' => 5,
				'film_name_vn' => '',
				'film_name_en' => 'Gakusen Toshi Asterisk 2',
				'film_time' => 12,
				'film_years' => '2016',
				'film_quality' => '720p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://3.bp.blogspot.com/-9AF4zHeaivA/WG8gUKbp8rI/AAAAAAAAA5c/jgiDPYjCWa0-ekjWpFjrV8jm52Ky7FmgwCK4B/s1600/gakusen-toshi-asterisk-2-2016-poster-small.jpg',
				'film_dir_name' => 'gakusen-toshi-asterisk-2-2016',
				'film_status' => 'HD'
			]
			,
			[
				'id' => 6,
				'film_name_vn' => '',
				'film_name_en' => 'Guilty Crown',
				'film_time' => 22,
				'film_years' => '2012',
				'film_quality' => '720p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://4.bp.blogspot.com/-DKyuYy2j7DA/WG8jEX0JWOI/AAAAAAAAA50/Iu8l0h-6KUkwaN9VeWbSES6VLZEU0DLzgCK4B/s1600/guilty-crown-2012-poster-small.jpg',
				'film_dir_name' => 'guilty-crown-2012',
				'film_status' => 'HD'
			]
			,
			[
				'id' => 7,
				'film_name_vn' => '',
				'film_name_en' => 'Tokyo Ravens',
				'film_time' => 24,
				'film_years' => '2013',
				'film_quality' => '720p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://3.bp.blogspot.com/-vzpeCkFO_nE/WG3zwLvrCzI/AAAAAAAAAp8/YBOv6LWbUugyEc5t6QOkgHfGQM1MuBpcwCK4B/s1600/tokyo-ravens-2013-poster-small.jpg',
				'film_dir_name' => 'tokyo-ravens-2013',
				'film_status' => 'HD'
			]
			,
			[
				'id' => 8,
				'film_name_vn' => '',
				'film_name_en' => 'K Return Of Things',
				'film_time' => 13,
				'film_years' => '2015',
				'film_quality' => '720p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://4.bp.blogspot.com/-BINBqVhV2Sw/WG31MALUPjI/AAAAAAAAAqc/7n0x1UiaOKIlf4almQPazqQ8dv_TOV08gCK4B/s1600/k-return-of-things-2015-poster-small.jpg',
				'film_dir_name' => 'k-return-of-things-2015',
				'film_status' => 'HD'
			],
			[
				'id' => 9,
				'film_name_vn' => '',
				'film_name_en' => 'Ao No Exorcist',
				'film_time' => 25,
				'film_years' => '2011',
				'film_quality' => '720p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://2.bp.blogspot.com/-evHe8KDA3rA/WG32XLOWWfI/AAAAAAAAArM/A3NpINAp7r02-8c5Abc1pAAGqQF8UQxuACK4B/s1600/ao-no-exorcist-2011-poster-small.jpg',
				'film_dir_name' => 'ao-no-exorcist-2011',
				'film_status' => 'HD'
			],
			[
				'id' => 10,
				'film_name_vn' => 'Đao Kiếm Thần Vực',
				'film_name_en' => 'Sword Art Online 1',
				'film_time' => 25,
				'film_years' => '2013',
				'film_quality' => '1080p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://4.bp.blogspot.com/-bscWGHiJNso/WG34p-gB_RI/AAAAAAAAAsE/d4Tj-m7tC9oussIVU8cXrrHhQd2svWzSgCK4B/s1600/sword-art-online-1-2013-poster-small.jpg',
				'film_dir_name' => 'sword-art-online-1-2013',
				'film_status' => 'HD'
			],
			[
				'id' => 11,
				'film_name_vn' => '',
				'film_name_en' => 'Sword Art Online 2',
				'film_time' => 24,
				'film_years' => '2014',
				'film_quality' => '1080p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://1.bp.blogspot.com/-wBENpebwR8k/WG397UAsyWI/AAAAAAAAAug/YlAUxsn9rSIfm7i6AUbXo4yLW2gLLtv7gCK4B/s1600/sword-art-online-2-2014-poster-small.jpg',
				'film_dir_name' => 'sword-art-online-2-2014',
				'film_status' => 'Full HD'
			],
			[
				'id' => 12,
				'film_name_vn' => 'Bạch Phát Ma Nữ ',
				'film_name_en' => 'The White Haired Witch of Lunar Kingdom',
				'film_time' => 104,
				'film_years' => '2014',
				'film_quality' => '1080p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://3.bp.blogspot.com/-dtp2nsMP_7s/WG5m8vK4HgI/AAAAAAAAAv0/dEoO8fTFBdotqVCvv7rvcPG-a1YhitKWwCK4B/s1600/bach-phat-ma-nu-the-white-haired-witch-2014-poster-small.jpg',
				'film_dir_name' => 'bach-phat-ma-nu-the-white-haired-witch-of-lunar-kingdom-2014',
				'film_status' => 'Full HD'
			]
			,
			[
				'id' => 13,
				'film_name_vn' => 'Tuyệt Đỉnh Kung Fu',
				'film_name_en' => 'Kung Fu Hustle',
				'film_time' => 93,
				'film_years' => '2004',
				'film_quality' => '1080p',
				'film_language' => 'tm',
				'film_thumbnail_small' => 'http://1.bp.blogspot.com/-D7ESaH8LIRw/WHXEWfD86wI/AAAAAAAAA7c/Bsf5Yc25AaUFP_GGuIV9mgJe2PqMOHR7gCK4B/s1600/tuyet-dinh-kung-fu-kung-fu-hustle-2004-poster-small.jpg',
				'film_dir_name' => 'tuyet-dinh-kung-fu-kung-fu-hustle-2004',
				'film_status' => 'Full HD'
			]
			,
			[
				'id' => 14,
				'film_name_vn' => 'Tôi Là Người Hùng',
				'film_name_en' => 'I Am A Hero',
				'film_time' => 126,
				'film_years' => '2016',
				'film_quality' => '1080p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://2.bp.blogspot.com/-G35g3-W31rk/WHXItNP2XzI/AAAAAAAAA8o/JvffMZtaWtsPJ_NRMaLscfKnTJBhxdRlACK4B/s1600/i-am-a-hero-2016-poster-small.jpg',
				'film_dir_name' => 'toi-la-nguoi-hung-i-am-hero-2016',
				'film_status' => 'Full HD'
			],
			//15
			[
				'id' => 15,
				'film_name_vn' => 'Héc Quyn',
				'film_name_en' => 'Hercules: The Thracian Wars',
				'film_time' => 120,
				'film_years' => '2014',
				'film_quality' => '720p',
				'film_language' => 'vs,tm',
				'film_thumbnail_small' => 'http://2.bp.blogspot.com/-BPXTHqbAibM/WHYEMnAnjlI/AAAAAAAAA9I/8WHvhiEhB9EncL1on8Gw0mPIvelhduevwCK4B/s1600/hec-quyn-hercules-2014-poster-small.jpg',
				'film_dir_name' => 'hec-quyn-hercules-the-thracian-wars-2014',
				'film_status' => 'HD'
			],
			//16
			[
				'id' => 16,
				'film_name_vn' => 'Chiến Binh Frankenstein',
				'film_name_en' => 'I, Frankenstein',
				'film_time' => 120,
				'film_years' => '2014',
				'film_quality' => '720p',
				'film_language' => 'tm',
				'film_thumbnail_small' => 'http://1.bp.blogspot.com/-elD6uZkP1kE/WHYLVY5zWUI/AAAAAAAAA-A/5xZt2fxVtvEPd3Ku7V_u3kuIjg8trXbTQCK4B/s1600/chien-binh-frankenstein-i-frankenstein-2014-poster-small.jpg',
				'film_dir_name' => 'chien-binh-frankenstein-i-frankenstein-2014',
				'film_status' => 'HD'
			],
			//17
			[
				'id' => 17,
				'film_name_vn' => 'Hành Tinh XT-59',
				'film_name_en' => 'Vychislitel Titanium Strafplanet XT-59',
				'film_time' => 84,
				'film_years' => '2014',
				'film_quality' => '720p',
				'film_language' => 'tm',
				'film_thumbnail_small' => 'http://4.bp.blogspot.com/-rHW77G0RGJc/WHYQCQEO2LI/AAAAAAAAA-c/cceOXIxqT98CZ9fX5dAMZ42v5as3vT84gCK4B/s1600/hanh-tinh-xt-59-vychislitel-2014-poster-small.jpg',
				'film_dir_name' => 'hanh-tinh-xt-59-vychislitel-titanium-strafplanet-xt-59-2014',
				'film_status' => 'HD'
			],
			//18
			[
				'id' => 18,
				'film_name_vn' => 'Hành Tinh Đỏ',
				'film_name_en' => 'Red Planet',
				'film_time' => 110,
				'film_years' => '2000',
				'film_quality' => '720p',
				'film_language' => 'tm',
				'film_thumbnail_small' => 'http://1.bp.blogspot.com/-bBPaYDbY9tA/WHYT__UlQdI/AAAAAAAAA_A/TYn_WZP9dgMXILTfAnHeEDx0U_pmTLpfQCK4B/s1600/hanh-tinh-do-red-planet-2000-poster-small.jpg',
				'film_dir_name' => 'hanh-tinh-do-red-planet-2000',
				'film_status' => 'HD'
			],
			//19
			[
				'id' => 19,
				'film_name_vn' => 'Người Đến Từ Địa Ngục (Kẻ Cứu Rỗi Nhân Loại)',
				'film_name_en' => 'Constantine',
				'film_time' => 97,
				'film_years' => '2005',
				'film_quality' => '720p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://2.bp.blogspot.com/-g1rXI6g_mCk/WHYZKnJPjUI/AAAAAAAAA_4/xVfAgGzOMJIvyS6uNmBg6cs2M424zz-kgCK4B/s1600/nguoi-den-tu-dia-nguc-constantine-2005-poster-small.jpg',
				'film_dir_name' => 'nguoi-den-tu-dia-nguc-constantine-2005',
				'film_status' => 'HD'
			],
			//
			[
				'id' => 20,
				'film_name_vn' => 'Bậc Thầy Diệt Quỷ',
				'film_name_en' => 'Constantine',
				'film_time' => 13,
				'film_years' => '2014',
				'film_quality' => '720p',
				'film_language' => 'vs',
				'film_thumbnail_small' => 'http://1.bp.blogspot.com/-uPN2w-Pm--8/WHzDg7-rpzI/AAAAAAAABAo/ikC3OrQ6-mEog45J6iFsCnz7jzfFXDFxACK4B/s1600/bac-thay-diet-quy-constantine-1-2014-poster-small.jpg',
				'film_dir_name' => 'bac-thay-diet-quy-constantine-1-2014',
				'film_status' => 'Trailer'
			]
			
			]);
	}

}
class FilmTrailerDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('film_trailers')->insert([
			//1
			[
				'id' => 1, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=EgdxIlSuB70'
			],
			//2
			[
				'id' => 2, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=ynoIotD4a5k'
			],
			//3
			[
				'id' => 3, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=wd-GUUREFB8'
			],
			//4
			[
				'id' => 4, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=v29P-wchMZQ'
			],
			//5
			[
				'id' => 5, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=A45hvq7C5GM'
			],
			//6
			[
				'id' => 6, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=fyPwHrd00WQ'
			],
			//7
			[
				'id' => 7, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=21zRVyEuau4'
			],
			//8
			[
				'id' => 8, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=NSMspPT8wlI'
			],
			//9
			[
				'id' => 9, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=CwKiLNS7Vfk'
			],
			//10
			[
				'id' => 10, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=6ohYYtxfDCg'
			],
			//11
			[
				'id' => 11, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=trnbig5IDnM'
			],
			//12
			[
				'id' => 12, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=MYAcx0iYPBg'
			]
			,
			//13
			[
				'id' => 13, 
				'film_episode_language' => 'en', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=-m3IB7N_PRk'
			],
			//14
			[
				'id' => 14, 
				'film_episode_language' => 'en', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=uK-Z1vas_9g'
			],
			//15
			[
				'id' => 15, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=OwlynHlZEc4'
			],
			//16
			[
				'id' => 16, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=pxOSPfUw3qw'
			],
			//17
			[
				'id' => 17, 
				'film_episode_language' => 'en', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=hgVcTzT1qmc'
			],
			//18
			[
				'id' => 18, 
				'film_episode_language' => 'en', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=g13ceurNcgI'
			],
			//19
			[
				'id' => 19, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.ssyoutube.com/watch?v=DEa508Xmmio'
			],
			//1
			[
				'id' => 20, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=o5mQ5nqyw3M'
			],
			/*
			//1
			[
				'id' => 1, 
				'film_episode_language' => 'vs', 
				'film_src_name' => 'youtube',
				'film_src_full' => ''
			]
			*/
		]);
	}

}

class FilmEpisodeDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('film_episodes')->insert([
			//1
			[
				'film_id' => 1, 
				'film_episode_language' => 'tm', 
				'film_episode' => 0, 
				'film_episode_quality' => '720p', 
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipOpT9t3IxAJrHG0TBtoN2eWpUc2l4N36-uzmaXDs7J-RdMYyv80SgU8pUdVUYP17Q/photo/AF1QipM1kn7tRYDvmPw0YlBRoO_KxGu0zWipXmfjV7Kh?key=MlIwWUtlcFhwZzhUZ1pkbWZKdkpwcjZtT080aGtB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/IoUG8yXfR2UH1lGQspJNXd3RWxBZ7isfmkSWUX9KR3tvzMNZ-IZJK_ocL_sehnwuqRB4LycJnEQ1HWJeD1Bn_1TEtEDBNQOHyibK2EMSYzp9jVPUOprTj4J-x1ztQZdyt1Y36w=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/IoUG8yXfR2UH1lGQspJNXd3RWxBZ7isfmkSWUX9KR3tvzMNZ-IZJK_ocL_sehnwuqRB4LycJnEQ1HWJeD1Bn_1TEtEDBNQOHyibK2EMSYzp9jVPUOprTj4J-x1ztQZdyt1Y36w=m22',
				'film_src_1080p' => ''
			],
			//2 ep 1
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 1, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipPGrsMHFunkgtg0UJKduJmCYBemUjwqwtTRQksYGv1DaAdAatSifgGOL8C7rvE7Vg/photo/AF1QipOvT6KcgeriNITpDahxhY65TWso-gr5WE7ZGK9d?key=bGZyS0ZhVjBzRl9rTk5MMXZiaFdyanp1MWFsdUFR',
				'film_src_360p' => 'https://lh3.googleusercontent.com/J856s21MYL_dnKzFuBm6Wp-FQN5psPF8H3HV9uO42cFuw7jWU3fMQIO1qtIDDpRhvMDqHe55-GVhQ67NLpyfTWI9S0VGAAguuxl1JK9aZIA4QskWKhXvzd_h3vzByIJy6Zvg0w=m18	',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/J856s21MYL_dnKzFuBm6Wp-FQN5psPF8H3HV9uO42cFuw7jWU3fMQIO1qtIDDpRhvMDqHe55-GVhQ67NLpyfTWI9S0VGAAguuxl1JK9aZIA4QskWKhXvzd_h3vzByIJy6Zvg0w=m22',
				'film_src_1080p' => ''
			],
			//2 ep 2
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 2, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipMG_IRMUTMp6cDxWPaTlpnlbj7IZPZUp7zvP95XfSniWxajY3AH3hQf9uh9AMM6EQ/photo/AF1QipOYVx5S6it5vVOGrywMJbmb2i1yXsVQZwRTnaVl?key=WXVHQmlXVzhIMUJObHgxOTlMZmMyRFhiTTNXdDB3',
				'film_src_360p' => 'https://lh3.googleusercontent.com/Dea7Z30fA6l0MQBdjXKOtdC3lyePLR54eH1Hm8CmPKmGW7nQ6_E6z0HOBR-EGrySQoVOdO8a8c6xJDUee9WJPP-UMXqbbAZCm91OTFYzrqKGKcqx_1QO0mU1fUiNaZ46viCtTA=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/Dea7Z30fA6l0MQBdjXKOtdC3lyePLR54eH1Hm8CmPKmGW7nQ6_E6z0HOBR-EGrySQoVOdO8a8c6xJDUee9WJPP-UMXqbbAZCm91OTFYzrqKGKcqx_1QO0mU1fUiNaZ46viCtTA=m22',
				'film_src_1080p' => ''
			],
			//2 ep 3
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 3, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipOQycE3mcXU7C-D-tbAFCf0ERHVaL0HLfaCznLiNBuvuyAbSduCyCTe9PRFgjV_3A/photo/AF1QipOC4Ogt4U1-9J9iq6vgCyf7WaZWmmFP8lyOn-vG?key=U1V3d2tka0RtQml4S1RCckJObzNwM1cxOExoczZn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/l0bZvp3jhPgrHS4fDimhfhWrQymJ_cjUBjSjvb9UXgAlef-6r_XNFtQJ3XEMPyKeb_epWeteFXtXiqWZQkWU9Qph9YsCx-TERRQhwnQwv_0v5KyBtuvG8aCLZUhHppIX5gewLw=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/l0bZvp3jhPgrHS4fDimhfhWrQymJ_cjUBjSjvb9UXgAlef-6r_XNFtQJ3XEMPyKeb_epWeteFXtXiqWZQkWU9Qph9YsCx-TERRQhwnQwv_0v5KyBtuvG8aCLZUhHppIX5gewLw=m22',
				'film_src_1080p' => ''
			],
			//2 ep 4
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 4, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipN8wdVwVIxdUxkAnm9nOrxPpc1ujJdRVSOc9E-DFwRLtW8JouJDaZQID3X0IP1XVA/photo/AF1QipPlV0PSV4weyb-Ew20iZl8yz-fxmZa4T9As_RCP?key=bmVjSW8wUmFIbWplT0VmNnhzUEdmcTkxTFRzdTNR',
				'film_src_360p' => 'https://lh3.googleusercontent.com/OgHH4lc5Jub86h9AP_aOXGVpFWR9o7X_iWRr4XeR7ayvYeElsHDJwW55BDXMLjAZd2mFpIvbk0R7cdW7NBgtT7dsdWvutBk0UGTgkj0mEgQBtLnmRMjlUVotbPATHVFhm0QJSg=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/OgHH4lc5Jub86h9AP_aOXGVpFWR9o7X_iWRr4XeR7ayvYeElsHDJwW55BDXMLjAZd2mFpIvbk0R7cdW7NBgtT7dsdWvutBk0UGTgkj0mEgQBtLnmRMjlUVotbPATHVFhm0QJSg=m22',
				'film_src_1080p' => ''
			],
			//2 ep 5
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 5, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipOcsVAWy0_7jB59NSvkPvP393hZUbfPW0rZXs0hlL0iAjBd30TITnWqpDzN4T71GA/photo/AF1QipPDHHk4zQODinzI_EPr0N91kvzmpQq-kywnuJB1?key=S0N0V0xrOUQ2ODJXUThmRm9CeDA0SHBlY2lINXFn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/oQHLDPG2qOOPu0_S2lsdiE7Bi-It8HUAGbtKmduW1b48TcL_jn3qjDrVrixtv5dQf8MOZXRVItquumdiLrlxcgWG91hSyCm-8nqQ9ClAQjouw2mvru-mBtNrLJCMhV3ConOjOQ=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/oQHLDPG2qOOPu0_S2lsdiE7Bi-It8HUAGbtKmduW1b48TcL_jn3qjDrVrixtv5dQf8MOZXRVItquumdiLrlxcgWG91hSyCm-8nqQ9ClAQjouw2mvru-mBtNrLJCMhV3ConOjOQ=m22',
				'film_src_1080p' => ''
			],
			//2 ep 6
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 6, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipMA7gFfAOwUCgq6dvPhtwvvfq9TiBrwSrq1p2yO1pzSK-b3Lvd6okONrRK9rNyqBw/photo/AF1QipMH7qfzDa1hxKvo3ucFij677OeO-pzRSvSaFCA8?key=cm1SMHRpOTJoSnUzUFhRdWlTamhnS1FBYWVKMXVn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/OoLOuTKyWlTCV7JCGDZ7x9Wrm5glcpSbblLAUDIFHpmt48T_xaYloMTnrTRQcmg6FIIMJQib3_FZ-PV2yMaoctn3p2dAUdSGJ1v7pGc8cn01b-c2n52ld0QtAtzEVXvNRx_iEA=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/OoLOuTKyWlTCV7JCGDZ7x9Wrm5glcpSbblLAUDIFHpmt48T_xaYloMTnrTRQcmg6FIIMJQib3_FZ-PV2yMaoctn3p2dAUdSGJ1v7pGc8cn01b-c2n52ld0QtAtzEVXvNRx_iEA=m22',
				'film_src_1080p' => ''
			],
			//2 ep 7
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 7, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipPqN519zSI2UyG-uoRtzGdmNe7GL-qkuDkOLQWP7gkqMVnlLy9D2fvoL8r4c2RwCg/photo/AF1QipOkCV6K8jxW-iD2jG-Uum7IZkC1qvE_HUzdzQzQ?key=dDNnclpwN3ZfQTFjTk9KZlE1V0JUWmFQUlNrdVVR',
				'film_src_360p' => 'https://lh3.googleusercontent.com/XYPxB64pSbHo60RU0i6MdkoLkMcoxGRuTnZrwHXFqE1iFAanv9fEzRsd21sUiWsvwp8WWnvmOlvG2NkFrT6n3RpLJ0basSbIak2v8a2z-jdbdLTQRUmDZVHKZlP6vJQfAHBdqw=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/XYPxB64pSbHo60RU0i6MdkoLkMcoxGRuTnZrwHXFqE1iFAanv9fEzRsd21sUiWsvwp8WWnvmOlvG2NkFrT6n3RpLJ0basSbIak2v8a2z-jdbdLTQRUmDZVHKZlP6vJQfAHBdqw=m22',
				'film_src_1080p' => ''
			],
			//2 ep 8
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 8, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipMP52RLvHWt12Web9PAGgmAq5c6jg3H2oaiNVqONfqWGbSSF6667oFDULfPoT95_g/photo/AF1QipMfDvYswUym38W3dr2rxjAdezfVHTQvDb3WNgv6?key=LU9ObjB6Q1E4dXA0eGtSTHZWdFp2Z0Z3N01HX01B',
				'film_src_360p' => 'https://lh3.googleusercontent.com/sSqlJGGCGSg6GIA8ElAFMjx-82EGI710NyYSmwSBbdhT8i5Rjn8_yERZzyYVax4vTyEzgqqKi-jrSToE21eROaFQn5XD5JtF5OP8or2xYOfYrgQou7J1pydFL3FB0CuOKVzQ6w=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/sSqlJGGCGSg6GIA8ElAFMjx-82EGI710NyYSmwSBbdhT8i5Rjn8_yERZzyYVax4vTyEzgqqKi-jrSToE21eROaFQn5XD5JtF5OP8or2xYOfYrgQou7J1pydFL3FB0CuOKVzQ6w=m22',
				'film_src_1080p' => ''
			],
			//2 ep 9
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 9, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipPz-9tO60B5GjJy1uJiW9BdgyK9i0oFiSJB3vdujvPN38SmxC94Tkqpyhv0tQqqFA/photo/AF1QipOwPCNWoG9rCukn1MStp01lexlweET1E-GOvDJO?key=ZVV5RGdRcmR2U0JTYnhlTXpPNWFDXzQ2ZGlsb1RB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/nj6CIqT4r0Ni7a67QHoDpgA6dAYZUx8JXVoJpzcgYYHGE0vOoQ0bmzsQLiYV5wAtP_10MCrXHJE7DPUh2pyMcSmHWZoetaEH2z7jJ5wej8FYYM-OcAZDkMlJPa0yLMS9oWU_Xg=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/nj6CIqT4r0Ni7a67QHoDpgA6dAYZUx8JXVoJpzcgYYHGE0vOoQ0bmzsQLiYV5wAtP_10MCrXHJE7DPUh2pyMcSmHWZoetaEH2z7jJ5wej8FYYM-OcAZDkMlJPa0yLMS9oWU_Xg=m22',
				'film_src_1080p' => ''
			],
			//2 ep 10
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 10, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipN9GGhU1A-HGC--QqyPqNd3Ohn9A95fQwBu-_8rdLW37hNRAQAanuQmnb-2Lv7Jyg/photo/AF1QipNXElWldfseQ02pmCTKA_enA6S3BBjd9aUPd3t2?key=TFA0VlRwUDJBbHMyTnQ1XzBYWHVtWWl6X3pVejNB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/g58FhtnEFBMAIJ8xYQOl4glQluTuro5kOqlm7a3tcEkFXZOfV4X8AfsEiXvhuyxmMTFzuAql7nY-pimnWZ7arwLfImTRjPlTXQtIkJ8rqvNTlVYgBh0r5lDnNMSG-biBqnKMaQ=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/g58FhtnEFBMAIJ8xYQOl4glQluTuro5kOqlm7a3tcEkFXZOfV4X8AfsEiXvhuyxmMTFzuAql7nY-pimnWZ7arwLfImTRjPlTXQtIkJ8rqvNTlVYgBh0r5lDnNMSG-biBqnKMaQ=m22',
				'film_src_1080p' => ''
			],
			//2 ep 11
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 11, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipNSBGIt71JhbJN1m9I0T19nYE1chAp-gDNNR19Ek7X2qcI946SLgMprLsITfcLqww/photo/AF1QipM8dComQEkxe9jgcDfwN62fX7JXMe2xAl23rmSl?key=aFFBRzRNYW9zd2xUT1VkOGlPLWhjQTJTa2laOVJ3',
				'film_src_360p' => 'https://lh3.googleusercontent.com/zDiig32BVw9_un8EqMVFnt2TMs78K-eogyRI_kQHMzw0wmhy8oaH5g0xshHW527NuTOsMzZuoRL65DiGrKK2vu0oo1rl_2UD0yS048rqK35mN-QXxuIT9b96izoLFC3VFaFBig=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/zDiig32BVw9_un8EqMVFnt2TMs78K-eogyRI_kQHMzw0wmhy8oaH5g0xshHW527NuTOsMzZuoRL65DiGrKK2vu0oo1rl_2UD0yS048rqK35mN-QXxuIT9b96izoLFC3VFaFBig=m22',
				'film_src_1080p' => ''
			],
			//2 ep 12
			[
				'film_id' => 2, 
				'film_episode_language' => 'vs',
				'film_episode' => 12, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipNeBzM_KthrYB_FE3FoLS-9c-6DBnB0n8l2cwrXiGI1bOQImvGpozBudpW9rtRE9g/photo/AF1QipNEffh7gy4JJWRhux3f-fO3cp7ZyUX71UN-v6uM?key=bGdfR2RISTlJaWhrMmRmYXN4WkNZUUR3Sy1zcEJ3',
				'film_src_360p' => 'https://lh3.googleusercontent.com/03PXyLVOYQ7NfZUrrEoIJvswWu7wnemojo3L5Z2noG2RiAE-rojqcXRxmzc3nAm-dH9jRQBN4l4nvolmRVEgnZgPDKkkN4616EUqeNKw8uu3nfZqe9rXHfSX0lw4JIXRYbmfNA=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/03PXyLVOYQ7NfZUrrEoIJvswWu7wnemojo3L5Z2noG2RiAE-rojqcXRxmzc3nAm-dH9jRQBN4l4nvolmRVEgnZgPDKkkN4616EUqeNKw8uu3nfZqe9rXHfSX0lw4JIXRYbmfNA=m22',
				'film_src_1080p' => ''
			]
			,
			//14
			[
				'film_id' => 14, 
				'film_episode_language' => 'vs',
				'film_episode' => 0, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipPQjDWvhG1x6yWtyAz72-V7CQJeMk3tj1bSn2-Ds98xWcnCDKHhqcxVRGrxqPxn4w/photo/AF1QipO__vdIaGzq1x3sBXPW8ErZOTUl9Lq_3Tt_OZpd?key=NnU0dkMxVDZwbVl6RF83NHJpVWg1M1BHRXhzZHJn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/dvKtWwli5r44Alw7Vau5E8motIjEVn635UIf6FxE2xlL8dwlB8NUCj2jRRKPjQnrsVtdeQQS_yiQH2JPwEEo2E3xPWW-LsXa6CcoX9dXrgOh6BJqeJCcObXIXzas2dG8vp911w=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/dvKtWwli5r44Alw7Vau5E8motIjEVn635UIf6FxE2xlL8dwlB8NUCj2jRRKPjQnrsVtdeQQS_yiQH2JPwEEo2E3xPWW-LsXa6CcoX9dXrgOh6BJqeJCcObXIXzas2dG8vp911w=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/dvKtWwli5r44Alw7Vau5E8motIjEVn635UIf6FxE2xlL8dwlB8NUCj2jRRKPjQnrsVtdeQQS_yiQH2JPwEEo2E3xPWW-LsXa6CcoX9dXrgOh6BJqeJCcObXIXzas2dG8vp911w=m37'
			]
			,
			//13
			[
				'film_id' => 13, 
				'film_episode_language' => 'tm',
				'film_episode' => 0, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipN6GJMmawu5OezQnWaQ57gq1vKCliAZAXbUXPgkvdP2-k8emJOM0GIudOR__6hw1w/photo/AF1QipNpIeistAMpgZ9oTfR4Hz568VFHzkeVobFEP3Xg?key=MVJWV21SbDV0N1EyZXQ5TW5fQXd6a1JneXp1TzZB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/59cBzaBD4t7dCbjTJgExObatMH-eYzolHp446SlWHwb1QtxfRU71hnoIK8ARQ45znkSgzb08e5y61RRPW1wxN8nFqstoXjRuaQZXeWZBY4vLFRxZ7_uDq5gXA3tozAJbR-VJag=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/59cBzaBD4t7dCbjTJgExObatMH-eYzolHp446SlWHwb1QtxfRU71hnoIK8ARQ45znkSgzb08e5y61RRPW1wxN8nFqstoXjRuaQZXeWZBY4vLFRxZ7_uDq5gXA3tozAJbR-VJag=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/59cBzaBD4t7dCbjTJgExObatMH-eYzolHp446SlWHwb1QtxfRU71hnoIK8ARQ45znkSgzb08e5y61RRPW1wxN8nFqstoXjRuaQZXeWZBY4vLFRxZ7_uDq5gXA3tozAJbR-VJag=m37'
			]
			
			,
			//12
			[
				'film_id' => 12, 
				'film_episode_language' => 'tm',
				'film_episode' => 0, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipOqaf6colA1mS_siJJQCnRdDLwe2whSWiWwbkMjxt45LAQoaTdrApOcP9kjEihxRQ/photo/AF1QipN_3pmrpk-4V4QVy2ui7E5uT7lDJXJDtw0MpCrf?key=Vm1nQ3ljR2tSVEVDZUh6OVd6b3hZRXJIQ2t3aU5B',
				'film_src_360p' => 'https://lh3.googleusercontent.com/6euxGl6ByBFnZdyKy2hgsDd8CnhJ8AvwV4xG2LbYdslhbujUGsEP5aZxYQv5FN9ANLuB_Dv5IyRFd1tOe2TMb0-qb8bjWGXAdA7i6xEnFV36_QipzQGjX81SvxNmdyTdgQr-fw=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/6euxGl6ByBFnZdyKy2hgsDd8CnhJ8AvwV4xG2LbYdslhbujUGsEP5aZxYQv5FN9ANLuB_Dv5IyRFd1tOe2TMb0-qb8bjWGXAdA7i6xEnFV36_QipzQGjX81SvxNmdyTdgQr-fw=m22',
				'film_src_1080p' => ''
			]
			,
			//12
			[
				'film_id' => 12, 
				'film_episode_language' => 'tm',
				'film_episode' => 0, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'youtube',
				'film_src_full' => 'https://www.youtube.com/watch?v=1f9Rtpr_FhQ',
				'film_src_360p' => '',
				'film_src_480p' => '',
				'film_src_720p' => '',
				'film_src_1080p' => ''
			],
			//15
			[
				'film_id' => 15, 
				'film_episode_language' => 'tm',
				'film_episode' => 0, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipPBODfOo6v6S1ESslWkFn8pVzjuIk3fD8Vl2hxjQx9kfVuZFJFdU0qc2uvu99cwqA/photo/AF1QipPxpe229WBcTZpViMGGOKmyDGIlQcdhlk1tVT2X?key=V2JmRDB4NTRGQ3I5cFpUVmJYenB1Y0xEbW1JVWNB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/-Y6-qx80kDxsM_QqNSkMwbJPJs_OS1960LCqUV8L_5lPKA-k89taw31YZMwNhFJBgspAN6j-YSslW4Ig2lE7oY3PgguoPibN6BocxVQ2OwXjQcqKXSUC77ToaMRtekLE3I6jMQ=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/-Y6-qx80kDxsM_QqNSkMwbJPJs_OS1960LCqUV8L_5lPKA-k89taw31YZMwNhFJBgspAN6j-YSslW4Ig2lE7oY3PgguoPibN6BocxVQ2OwXjQcqKXSUC77ToaMRtekLE3I6jMQ=m22',
				'film_src_1080p' => ''
			]
			,
			//15
			[
				'film_id' => 15, 
				'film_episode_language' => 'vs',
				'film_episode' => 0, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipO-u97F3GB2lUrTZA3skgDHrWKaXZeFfXjgdp72HstKx1vApyOCTk7HGckIr6B2NQ/photo/AF1QipM0vM34jedbhGhJyIc3QgOhtQ-0BH19-kUfsDLx?key=ekxVWm81RnQxR2NRaDZvS2VYV0UtZGs1Wld3TFNn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/M-9iSDuAIzcC1y8mms1ELvnj7xES5Ylkx5GxmEXC7T4-SVB1VR--9wvqo4R6t6gxtiiKAsPSpyAWDCX-eGpHcZcJzPbaJFlkhpGZkFoWUWUNhPEpXuyLGUV6tOrebpWw3X818Q=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/M-9iSDuAIzcC1y8mms1ELvnj7xES5Ylkx5GxmEXC7T4-SVB1VR--9wvqo4R6t6gxtiiKAsPSpyAWDCX-eGpHcZcJzPbaJFlkhpGZkFoWUWUNhPEpXuyLGUV6tOrebpWw3X818Q=m22',
				'film_src_1080p' => ''
			]
			,
			//16
			[
				'film_id' => 16, 
				'film_episode_language' => 'tm',
				'film_episode' => 0, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipMe2mQMA3TIBge1JtQ5quSTimvzgCDizUmZadnJGgNLqWj1inBtspzbBxk3KDpFiA/photo/AF1QipP6AhlTKCnJLZmjp-krqW2SJhxTAFM-wMgnBHZU?key=bmMtU0NfOUJoeTh3eUg3SV9qWFhoRGZIeHR1bjRR',
				'film_src_360p' => 'https://lh3.googleusercontent.com/GBRnMM1qA6O1itxVp9NktTjRU1qWUzMk9PvS1eIjqyCa1SGK5umlLFHtDN4ai2UsUR3Li1bXP6kXHKcpNr2cwPTmiKznFQgW7pId3hDg8fG3Du3yekYkbOik2-oRUE4DzYOZww=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/GBRnMM1qA6O1itxVp9NktTjRU1qWUzMk9PvS1eIjqyCa1SGK5umlLFHtDN4ai2UsUR3Li1bXP6kXHKcpNr2cwPTmiKznFQgW7pId3hDg8fG3Du3yekYkbOik2-oRUE4DzYOZww=m22',
				'film_src_1080p' => ''
			],
			//17
			[
				'film_id' => 17, 
				'film_episode_language' => 'tm',
				'film_episode' => 0, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipM7ZBBtyyWSKnv2NZjWdSZ31wis5bk8GtBiGhPm72x5J6Jl9zTJ6LK-btr_L_KkZA/photo/AF1QipMVUBBJlWUU9H1xlBG3LV_9lrYQMGN9AMUBa3Op?key=bUNzNkFiZ2c1LTE2N3UxSTNfTGppWnBtd2FWeDN3',
				'film_src_360p' => 'https://lh3.googleusercontent.com/mUo0BK9Bh220XVtme5BL5PgPBqvjH1XPEDrCwwl-DxQ-KRp_-hglCh0K1QSQybhBeXUFt-2Kfj5v0YNfvMpx23hyiKzRZJrsD_ycwNdidjnJsrizLkyPB0hJ1Ntuw8BbnDB_tw=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/mUo0BK9Bh220XVtme5BL5PgPBqvjH1XPEDrCwwl-DxQ-KRp_-hglCh0K1QSQybhBeXUFt-2Kfj5v0YNfvMpx23hyiKzRZJrsD_ycwNdidjnJsrizLkyPB0hJ1Ntuw8BbnDB_tw=m22',
				'film_src_1080p' => ''
			],
			//18
			[
				'film_id' => 18, 
				'film_episode_language' => 'tm',
				'film_episode' => 0, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipOPrMCCm8uD3P3bz0Ov2_SVtrtQITcyzlNyPAZxTHvd-KWHsQKxeK8_VvKicVKX3A/photo/AF1QipOIEIt2xy_hKxognBA5M3QRp5VrKBchEeDNCHZs?key=V252VldFbEhNSlVodEVzVzZYdGNtcGFlMFZNSXNn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/75wP09NqW6P8HCGmNCNx_HPjTk3UiRlHP5wL71J-v2KkdRJaZF4CIiaH9jP6rD91sl3XYUuVQJQPS3Burbi9dLud5dCkJ0Wa7cW4W-xow2y3Nnkrsb0qGRAIr9JjIaTTU0mNGg=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/75wP09NqW6P8HCGmNCNx_HPjTk3UiRlHP5wL71J-v2KkdRJaZF4CIiaH9jP6rD91sl3XYUuVQJQPS3Burbi9dLud5dCkJ0Wa7cW4W-xow2y3Nnkrsb0qGRAIr9JjIaTTU0mNGg=m22',
				'film_src_1080p' => ''
			],
			//19
			[
				'film_id' => 19, 
				'film_episode_language' => 'vs',
				'film_episode' => 0, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipOleo1htpBp6ZSy2Ird5sLgi7Bf3KV-e-5Vp-QlCzUqPNLiPouQMjlYgTeTB2ey2w/photo/AF1QipNrNfRDP2_EJNqshQ9bBQXuldlVmAZE1KFbFKdx?key=a0puakVGMGlZX3VTbndjeWJMTWh0dm9nVXY0T3Zn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/tLqkadK9ZeI7Wi7kVygpxGLUG1gCCYa69GcOq1UpiNTuV88fkpcs5jo1vEpkB6BzkR4KMMFqQRhWtcrVq5GbUz0jnTVsDV2ixHZxpG33hB1EZp3rV6gF4Ay84pfq8QJpirhVYQ=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/tLqkadK9ZeI7Wi7kVygpxGLUG1gCCYa69GcOq1UpiNTuV88fkpcs5jo1vEpkB6BzkR4KMMFqQRhWtcrVq5GbUz0jnTVsDV2ixHZxpG33hB1EZp3rV6gF4Ay84pfq8QJpirhVYQ=m22',
				'film_src_1080p' => ''
			],
			//20 ep1
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 1, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipOULIREGvMfGDLROyM5DWfTaKXI8Nt9o3QGFLy24VJFp8lkjxam-HeMaqugD4bIIg/photo/AF1QipMX85AVT_TzAQE2J-zUR1idVWl5lD3wbllJME4Z?key=QmpGMVFSMHM2ejkyQjRhd0xjTS12WVFBQnlqTFlB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/6AOkEgUXZZLF1gfUpvb3AAvQXoBg-NgHaGs15OC6OxDnLouOSXrQRcfInuku3GewQV4hoFs1nenTF-oh704jU5Vnj9gqDD8TU5sIl9rXQdlJ7yLgENKcBp4hx5dBp93WhnLPCQ=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/6AOkEgUXZZLF1gfUpvb3AAvQXoBg-NgHaGs15OC6OxDnLouOSXrQRcfInuku3GewQV4hoFs1nenTF-oh704jU5Vnj9gqDD8TU5sIl9rXQdlJ7yLgENKcBp4hx5dBp93WhnLPCQ=m22	',
				'film_src_1080p' => ''
			],
			//20 ep2
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 2, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipN1Bpi0uVjh_3XewnzVqvKhMP-vNgqCgvS-XWe5_etDI67Z-eQaanODrsHB0odyPw/photo/AF1QipO3DKBwPmF4412H1VettAkEcAQbyRWwzqT3II-q?key=enk1dzBxenlYN3dMQnV2c0dlazhVX1E2VTcwWUNB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/4Q7mQimE6N54lkruBhB9lg4wJZiGnjSWppmsAdEu3nxmN41qTsPRwSbJTbaRxVfFoR88st7jsacaZCV5jeBN4GbGNdEf-I-gY7_3wEylNczX_qNobI02dmCf7KF65ARiWb64GQ=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/4Q7mQimE6N54lkruBhB9lg4wJZiGnjSWppmsAdEu3nxmN41qTsPRwSbJTbaRxVfFoR88st7jsacaZCV5jeBN4GbGNdEf-I-gY7_3wEylNczX_qNobI02dmCf7KF65ARiWb64GQ=m22',
				'film_src_1080p' => ''
			],
			//20 ep3
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 3, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipOYUpyj5XgtZx_iCy2DVYiXUmVN8uI9uZ_LBye7ZYE2jDQWXYZtP7h7NeCI0pPegw/photo/AF1QipMUsWE7dZM2i7OMjmsa9edY5fQlIqT_1vGzo8ch?key=RlZmVWR2YzlXUkwzTzktRnppai10VnZZTHl0WWF3',
				'film_src_360p' => 'https://lh3.googleusercontent.com/Vsqeb35Pr1IR7e0o-p0qC5oum89HtLFO_apxZMC01opgiZ4oMHk1VIkKv6PEalEn7wcwfApWpEPkN9ZOmK3ge-3eDtZZCjVYKV1FnOuqdgbzotRZfArjmWJOnrA1ZFT85QqEAw=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/Vsqeb35Pr1IR7e0o-p0qC5oum89HtLFO_apxZMC01opgiZ4oMHk1VIkKv6PEalEn7wcwfApWpEPkN9ZOmK3ge-3eDtZZCjVYKV1FnOuqdgbzotRZfArjmWJOnrA1ZFT85QqEAw=m22',
				'film_src_1080p' => ''
			],
			//20 ep4
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 4, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipN3HjZeECoBFvZjzdauryQDnxkTh-SEkWtn6Um1DPhHQV1mE1FECnU_xvAUfuy2tA/photo/AF1QipOgjbr8FXX8Z-rvhAi53OrjyBulZmdv1Qq3v2T4?key=Smh1N1QzQm4wMzhZWHgxVkRZYlRjUFBNdF9qcExR',
				'film_src_360p' => 'https://lh3.googleusercontent.com/6PT0WbgcEZGTird9JcVSABeDHJxoIpZucQAPOtk0Am7O3a9yNXLDYDyH0AO0JKDvMIj6HLAwcFFkF8NtD-3Zn3lXSuf1V_K7l9yHKZOTvCe-9pXRfvVu8Pd6XyelrvO6Q6RMeA=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/6PT0WbgcEZGTird9JcVSABeDHJxoIpZucQAPOtk0Am7O3a9yNXLDYDyH0AO0JKDvMIj6HLAwcFFkF8NtD-3Zn3lXSuf1V_K7l9yHKZOTvCe-9pXRfvVu8Pd6XyelrvO6Q6RMeA=m22',
				'film_src_1080p' => ''
			],
			//20 ep5
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 5, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipNynpgwJbsIWTL0yWXLqZkDi4ka_H1uFD8P4z6NuwvDpLQqu_6HjFao1_Ox-2RK1w/photo/AF1QipM1cc4CO0KX7Ulm8UO8cOaZRZRkmL2-LR_r4Mq4?key=ZGR1UkVmdXFNMXBZdVZhdV9hUEgxU1pmM0J0M3Nn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/ZK5I8SxfavKbGVlAsdo5fZa_PVcI1hCt2CWf6LnbYDdKJRs5OjZxAX1vGxBD4uhL72bsqwNSTrmcS-kc-Zv0H4O29HyOmTYcHoUmcEG8Y12WGsbr0w01tLvDQurlZSo1wWYOfA=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/ZK5I8SxfavKbGVlAsdo5fZa_PVcI1hCt2CWf6LnbYDdKJRs5OjZxAX1vGxBD4uhL72bsqwNSTrmcS-kc-Zv0H4O29HyOmTYcHoUmcEG8Y12WGsbr0w01tLvDQurlZSo1wWYOfA=m22',
				'film_src_1080p' => ''
			],
			//20 ep6
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 6, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipOinz5byaOgcrxpr194SIXqrk2hyjxZb07X7726XOt3uxeBm9GTf1fGOA0Kcb0_Kw/photo/AF1QipPkanXxdfzypDC8RFeKFQ45wrm6aVJJJcx5SCiV?key=YzVWWFFVWkFKazg1NnVwN0NTVXREemJILTlJYTFB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/U0H5kyvYY8vcTu76slv9gFScWo_qXUFWZcCStepELzRdM1tUmxpOjpKo_c71TMapY5-lY9cLauwuciqdWr1W8yQZNgF_EuE8k81fG9T0Bs088B3RxNf8Sz3ygy_0sOaBOnPgGg=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/U0H5kyvYY8vcTu76slv9gFScWo_qXUFWZcCStepELzRdM1tUmxpOjpKo_c71TMapY5-lY9cLauwuciqdWr1W8yQZNgF_EuE8k81fG9T0Bs088B3RxNf8Sz3ygy_0sOaBOnPgGg=m22',
				'film_src_1080p' => ''
			],
			//20 ep7
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 7, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipNFF8kwvKR0-gyoQa2oaUfjz11qXHM60nIVEFLqas8MuhqRtFOx6fboXFSGAk22Xg/photo/AF1QipOcquE0laNC6Ewd2lG_74AEpb96hMlWUWFHCZW1?key=SVBOdVhUZHU1NU05TVViNWdfelpieHVjT2lqeXh3',
				'film_src_360p' => 'https://lh3.googleusercontent.com/VDE1SJDeeubpLxsd5YDkClH90wI6eYlbRc5Smei1zgM1AGv58rgW5mmDq4puHE1Rxh71vV4Rs4ciBHx_9aFeCBNKGxH6986KFOc65Obtuskw58DxWHoytTq_fKRUGbepxIBgkQ=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/VDE1SJDeeubpLxsd5YDkClH90wI6eYlbRc5Smei1zgM1AGv58rgW5mmDq4puHE1Rxh71vV4Rs4ciBHx_9aFeCBNKGxH6986KFOc65Obtuskw58DxWHoytTq_fKRUGbepxIBgkQ=m22',
				'film_src_1080p' => ''
			],
			//20 ep8
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 8, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipMQtc2pI9x7h6k3TF7nuEgbnmcQoeFvehdhDNc4l-DYLArkML0hichfv8B_HsDX2w/photo/AF1QipM01xFkdQN5OKl_PeevVE-HLOkVN677PhT6RE0D?key=bkI0SVBSaW5NLS12c254TTJGSTZIOThNU01neklR',
				'film_src_360p' => 'https://lh3.googleusercontent.com/OthbRsEW8wtpiTK1FgwWNSpGKL3sxXdfdkfcded8D6TFFtmVauKFtQSup4ZPzqO3R0HFzW-5g34dOMz5gncPecl_RGLFlieUmcdbbiLPbY0lkN3FlTa15vhxXjvOUyIEpAA9dw=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/OthbRsEW8wtpiTK1FgwWNSpGKL3sxXdfdkfcded8D6TFFtmVauKFtQSup4ZPzqO3R0HFzW-5g34dOMz5gncPecl_RGLFlieUmcdbbiLPbY0lkN3FlTa15vhxXjvOUyIEpAA9dw=m22',
				'film_src_1080p' => ''
			],
			//20 ep9
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 9, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipPJvEc8pW3nrg7YYPr198yQseCK3kfb7nE0cTqvqQNZWxF_NgDgkSA8IlwEs0Ra_g/photo/AF1QipOzBIWPj-wWvyc5yyd09ZAFtHeFdZSM4wvXDVYv?key=ekxOQUp1WVg0OEJvdjFSMFIwd3o4UVZtLThRTGFB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/l8gFVnySFJ2pSjkPxlV5_y_Ue3FOXsjN2VSH6gSKXC_ELjCIz5wyh9lTM034jAGIqTdwhuSavA79RTzJhUme1CsM8p1EYwAXo6NiYbWRGUWEhWV7kBXMEAcPGvGWdUyfSXnH3A=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/l8gFVnySFJ2pSjkPxlV5_y_Ue3FOXsjN2VSH6gSKXC_ELjCIz5wyh9lTM034jAGIqTdwhuSavA79RTzJhUme1CsM8p1EYwAXo6NiYbWRGUWEhWV7kBXMEAcPGvGWdUyfSXnH3A=m22',
				'film_src_1080p' => ''
			],
			//20 ep10
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 10, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipPbrO5H6ivWy_E2THHOTtWH3fHTFQlUGlYyvbqte4YxihbsrQGalGNw0q-0Jt2bEA/photo/AF1QipPIcXiFJqcZMOfrvhCANxQkTR3BnhICXq-kqutT?key=M3I0OTkzbHBTbDYxRkVyUVNsZDlROWpzdlk4VjNB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/hnP1Mkct1VvmlglnxwtitnzgDjLBqA4VjF2L-6Fsl0H0f-XBsO8M9QXct9_mX_iTHEqRbC2qLBTqGkeAfb2rXLtWbUp9CEu2E-gyZpB2QBgUOlnR_BYAhmsq7__pFS7ztt0orA=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/hnP1Mkct1VvmlglnxwtitnzgDjLBqA4VjF2L-6Fsl0H0f-XBsO8M9QXct9_mX_iTHEqRbC2qLBTqGkeAfb2rXLtWbUp9CEu2E-gyZpB2QBgUOlnR_BYAhmsq7__pFS7ztt0orA=m22',
				'film_src_1080p' => ''
			],
			//20 ep11
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 11, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipNwEchHA50GqabbRjU9SKm1xV8Maa8VzbPJcRQgAkqHm1RWUm30g5k-mzIxgJXl0w/photo/AF1QipMIyi5RlenaipGn5Z_ihVdnEg_C93-AgIq5MSXx?key=T0JfSnIxVHpGb21zNmdMS2xoQVVnaTBrNGZlRjRn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/_oKChBrb69vfsULykAV49PO3BwkLAHLCvkhb19RHsv5StU7ackepJilY57IyR81kxznahvPDD3AGRRubxDHj5r2LBZ7U37HbSu6P9eXa5HLTSkumP0bwnfkDRElRwd6DctIyVw=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/_oKChBrb69vfsULykAV49PO3BwkLAHLCvkhb19RHsv5StU7ackepJilY57IyR81kxznahvPDD3AGRRubxDHj5r2LBZ7U37HbSu6P9eXa5HLTSkumP0bwnfkDRElRwd6DctIyVw=m22',
				'film_src_1080p' => ''
			],
			//20 ep12
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 12, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipPZ0Y43NT9Ouekacy7yRxTBYxj-JM0v8WvDyHGgZCi8jJTPbIznDR-rvG3Md7ljHA/photo/AF1QipN_InjIx-yD-1j2TgbZhfbJslrW5CGPIVQjf5gb?key=aEFSV3JZNTZLcVFxVDBiT21ndDE5b1NKWnhlWWZn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/dYn5INeX0fKZkvLpZGEuc6j468WQL00NJY5mRPcDrQmMdkeFgHalEHl1dS9kPMMQmrbwRTkJv2UBEvVnFepZeTnPDjhriLPptxMOzFwNgIGGpqQ7wWT-kM5Cr_xfkznm6ev6IQ=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/dYn5INeX0fKZkvLpZGEuc6j468WQL00NJY5mRPcDrQmMdkeFgHalEHl1dS9kPMMQmrbwRTkJv2UBEvVnFepZeTnPDjhriLPptxMOzFwNgIGGpqQ7wWT-kM5Cr_xfkznm6ev6IQ=m22',
				'film_src_1080p' => ''
			],
			//20 ep13
			[
				'film_id' => 20, 
				'film_episode_language' => 'vs',
				'film_episode' => 13, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipPByBY733irCg_fLR6jcgVONo-OKYgYvy811g6Jxk_oek22kbVJe6bWT3HdE5oiHg/photo/AF1QipMcra7veUnPz-E5WfvZyaKzGNanm8GI7Sb6hN_g?key=NXNTWThVMUd2Zm9zeE83YXBJc1hnWmtNZGJiTTR3',
				'film_src_360p' => 'https://lh3.googleusercontent.com/GjkyEgWlxMpru_1tr8GZ5fwPZn4bQtsm2TgWQSUhcnTF7-ibVF2NZLLbCyHQdFQl0tQWDzZWk9H24eb_x5hQKpj4U2xcUTf3fFd17or-ysrxRgsgzZ_Pek0tGk06YB1Ji7_Wxg=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/GjkyEgWlxMpru_1tr8GZ5fwPZn4bQtsm2TgWQSUhcnTF7-ibVF2NZLLbCyHQdFQl0tQWDzZWk9H24eb_x5hQKpj4U2xcUTf3fFd17or-ysrxRgsgzZ_Pek0tGk06YB1Ji7_Wxg=m22',
				'film_src_1080p' => ''
			]
			
			,
			//10 ep1
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 1, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipPlrbkHoRQh8Iy_D1Uz11Z-RgAb0L_d22uLpZWxamG4ygb8CqrROdl4_ed8bxtlPQ/photo/AF1QipOi0OC2u68lVEeXnIGmHSKC9EVlzL2VNI19pMZ2?key=TmlIbDI4NnloemJoeWU5TkdzZ2pMS2NtZHIzd2pB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/bR8QHrMySSYDBO33JoC9FYGgYzh5OsXNa_G4k-uizR23KYZOSE95rjnE00uKK5ZKL5EyxD6HROf8vSPH5bX5gHj24VmZoDj3u1thWA2-XMHFc70jCQvlDWT2drfPKmaQhSgiww=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/bR8QHrMySSYDBO33JoC9FYGgYzh5OsXNa_G4k-uizR23KYZOSE95rjnE00uKK5ZKL5EyxD6HROf8vSPH5bX5gHj24VmZoDj3u1thWA2-XMHFc70jCQvlDWT2drfPKmaQhSgiww=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/bR8QHrMySSYDBO33JoC9FYGgYzh5OsXNa_G4k-uizR23KYZOSE95rjnE00uKK5ZKL5EyxD6HROf8vSPH5bX5gHj24VmZoDj3u1thWA2-XMHFc70jCQvlDWT2drfPKmaQhSgiww=m37'
			],
			//10 ep2
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 2, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipMggurduxF8Kjt8xr2NEtW1baXNHehkvs9rOr8aN0YLuQZ5Pn902I8yecGAsguM4A/photo/AF1QipM3D8E2khq_VLSG-fvOu06kiWejAl968QcDw2p5?key=VlVob0xKeHBhZHpfRjJ0TDRSMGJqdDJyM1B0SEh3',
				'film_src_360p' => 'https://lh3.googleusercontent.com/FsN_lXHhj8z0Cgxpdit2owdt1S_LGFYdgyZCqujzu5FJ0VUuCUOj4TAFRGXQWMTZv6JQl4zFAFrPrQylOamX6NSSa0Dm53es7rUQqCL3BJZsU_HZ19_3ip4PMZMpaUmSn9hybQ=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/FsN_lXHhj8z0Cgxpdit2owdt1S_LGFYdgyZCqujzu5FJ0VUuCUOj4TAFRGXQWMTZv6JQl4zFAFrPrQylOamX6NSSa0Dm53es7rUQqCL3BJZsU_HZ19_3ip4PMZMpaUmSn9hybQ=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/FsN_lXHhj8z0Cgxpdit2owdt1S_LGFYdgyZCqujzu5FJ0VUuCUOj4TAFRGXQWMTZv6JQl4zFAFrPrQylOamX6NSSa0Dm53es7rUQqCL3BJZsU_HZ19_3ip4PMZMpaUmSn9hybQ=m37'
			],
			//10 ep3
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 3, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipMkzWCpe23catQLH1-sHOQ-PEC-l2_QgO7k2hz-MNE6Dq5jIl_nsq3F9UrDDVYpRA/photo/AF1QipMG9dDCUHWFUt0fGiMaokes_E4aLV1wC8tuIkd3?key=RTQwYW9FcTJfMlhHLWpuaWk3aDdVNjNCR2lNd1VR',
				'film_src_360p' => 'https://lh3.googleusercontent.com/M3g7gz-2EQMx4fZjiKzk9lqlyHoYt-l_rEJrMykVohb3To1XQBciH5I17ApbYlwWfHSzQw9rvn30VS-mnfZdK11Iu9V63tJ0pcqCXHAqXQi32lDP6O41NhWfDqWfIhGDexTNTA=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/M3g7gz-2EQMx4fZjiKzk9lqlyHoYt-l_rEJrMykVohb3To1XQBciH5I17ApbYlwWfHSzQw9rvn30VS-mnfZdK11Iu9V63tJ0pcqCXHAqXQi32lDP6O41NhWfDqWfIhGDexTNTA=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/M3g7gz-2EQMx4fZjiKzk9lqlyHoYt-l_rEJrMykVohb3To1XQBciH5I17ApbYlwWfHSzQw9rvn30VS-mnfZdK11Iu9V63tJ0pcqCXHAqXQi32lDP6O41NhWfDqWfIhGDexTNTA=m37'
			]
			,
			//10 ep4
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 4, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipNO5hoXVpgEJvMqjhUgqzdJkrEZpHDf3cVjw7sMPzIdTX2MSmNwMB1H5afngR24RA/photo/AF1QipPC9G3zKbbHtbq9whTznvKnvB5mhp2jn2mq4Wdq?key=NXNyckRNRnNQbkJoYVdGek55ZTlWZ1N1ckNtNUFn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/Ko0EuQra8RGdIVI0aP08b8WGvCvqwPaLHrEIUbZz9svTiamlgqCiyF1H1AhfQWrsY2lojK5ZtVQJbuRHl-kmeIHHOd_Dl0SPZPVK-UycblpLNMUXGIZ_yi4zznW3A02hyrAjOA=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/Ko0EuQra8RGdIVI0aP08b8WGvCvqwPaLHrEIUbZz9svTiamlgqCiyF1H1AhfQWrsY2lojK5ZtVQJbuRHl-kmeIHHOd_Dl0SPZPVK-UycblpLNMUXGIZ_yi4zznW3A02hyrAjOA=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/Ko0EuQra8RGdIVI0aP08b8WGvCvqwPaLHrEIUbZz9svTiamlgqCiyF1H1AhfQWrsY2lojK5ZtVQJbuRHl-kmeIHHOd_Dl0SPZPVK-UycblpLNMUXGIZ_yi4zznW3A02hyrAjOA=m37'
			]
			,
			//10 ep5
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 5, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipMZakw2k7SZyRqkLMkHE16aalMynJ8w9tWRJT99dOIeiFdlff1yxfEuhymcLBQaVg/photo/AF1QipOpYMP_KSVdwLM7Uw18B4lE7G6aK9h3-WlFWqr4?key=RnFzQjhhZ3BWeDdxVktIRUZoUkVETHBOOGUwY1JR',
				'film_src_360p' => 'https://lh3.googleusercontent.com/b4w7xgvmJIf3wxX0MySmlE1yhwI79ssPtjg1Z18CbXczt_LjH_QCeHgnUCcasSf4nhILzKTfdac15j6d5KZS_hm6pR94X-gS0uvzxx-OfIpcrKZRQka_Zh-zjzk2NJEeFmfKaw=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/b4w7xgvmJIf3wxX0MySmlE1yhwI79ssPtjg1Z18CbXczt_LjH_QCeHgnUCcasSf4nhILzKTfdac15j6d5KZS_hm6pR94X-gS0uvzxx-OfIpcrKZRQka_Zh-zjzk2NJEeFmfKaw=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/b4w7xgvmJIf3wxX0MySmlE1yhwI79ssPtjg1Z18CbXczt_LjH_QCeHgnUCcasSf4nhILzKTfdac15j6d5KZS_hm6pR94X-gS0uvzxx-OfIpcrKZRQka_Zh-zjzk2NJEeFmfKaw=m37'
			]
			,
			//10 ep6
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 6, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipOfFisayhEnQWQngZ7MC7rdQpAOLsTtVuZMuE61jZujIPSaQcM9eSscOw_zIyqgmA/photo/AF1QipM6iMqJlidxI9FXJI8MEa20H4vpFR_cmQKXmEpt?key=MEUyTTc2eTlyQXRjXzRkSTBMNUs2LVV3ZklZcWl3',
				'film_src_360p' => 'https://lh3.googleusercontent.com/tnpCdreM5Os-aJ7m1pxgsn2sz1esUFqX3NhBZDa9SRUgaRZO3m2T8UnoMgjigdY-D7vb7nfiyz8z43yP-qWUER38ijcg64l48U5RB4PEC47Qru9MnF7Cq1Dk4nOWOc4HPRVirg=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/tnpCdreM5Os-aJ7m1pxgsn2sz1esUFqX3NhBZDa9SRUgaRZO3m2T8UnoMgjigdY-D7vb7nfiyz8z43yP-qWUER38ijcg64l48U5RB4PEC47Qru9MnF7Cq1Dk4nOWOc4HPRVirg=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/tnpCdreM5Os-aJ7m1pxgsn2sz1esUFqX3NhBZDa9SRUgaRZO3m2T8UnoMgjigdY-D7vb7nfiyz8z43yP-qWUER38ijcg64l48U5RB4PEC47Qru9MnF7Cq1Dk4nOWOc4HPRVirg=m37'
			]
			,
			//10 ep7
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 7, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipPyy-ejBjcpI75CXqGfsG2wtr6MANvFsCczLu0qr7NU3IKsQk3ps0fWR31y0yvQQQ/photo/AF1QipPPmSl8C1XshmnSutvtkJP9QvkxgRM-Qdy69ps9?key=YzdLRmtBZlVyVW9CMnVTTzhGbk1NYUQ4eU5KQWdB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/7UlEf4hs1zp6gcMkxG0LL4qZYQoZiBQaghDA8WBHQypz9DIgFtXD8TFCG0SvHlzqgD155omrMo-B16Joi1-VOUVqatVfP6B4GtIrzcThPeEgKd0HKwOGaw9-RJbbx56l0GWUCA=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/7UlEf4hs1zp6gcMkxG0LL4qZYQoZiBQaghDA8WBHQypz9DIgFtXD8TFCG0SvHlzqgD155omrMo-B16Joi1-VOUVqatVfP6B4GtIrzcThPeEgKd0HKwOGaw9-RJbbx56l0GWUCA=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/7UlEf4hs1zp6gcMkxG0LL4qZYQoZiBQaghDA8WBHQypz9DIgFtXD8TFCG0SvHlzqgD155omrMo-B16Joi1-VOUVqatVfP6B4GtIrzcThPeEgKd0HKwOGaw9-RJbbx56l0GWUCA=m37'
			]
			,
			//10 ep8
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 8, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipNrmgReJRbegGXUHr2dO99QkkW0u6YbeK_WMsASMmCY6bEUAiXoRpvyO1h0ptN2pg/photo/AF1QipM-DctPaPNKRpZr7L0JQt7LFVxCpk8hepJDOtca?key=LWNRRm5lbExWbG5qd1o5NGhrM1dZQjNRRkZyaGRn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/uBA4BCSFfWqaQxO6ccfYWz9e8jIu0BdrWLQ7kzVCvhzKhhJlN9-1lAovd2kRN41wZZo_UWeT5vhnawYiKNvYkgzYhEekxLLtJ10ICyV2igrR6mlH9HA-J6G8L2rzsnZUn0Q4ZQ=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/uBA4BCSFfWqaQxO6ccfYWz9e8jIu0BdrWLQ7kzVCvhzKhhJlN9-1lAovd2kRN41wZZo_UWeT5vhnawYiKNvYkgzYhEekxLLtJ10ICyV2igrR6mlH9HA-J6G8L2rzsnZUn0Q4ZQ=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/uBA4BCSFfWqaQxO6ccfYWz9e8jIu0BdrWLQ7kzVCvhzKhhJlN9-1lAovd2kRN41wZZo_UWeT5vhnawYiKNvYkgzYhEekxLLtJ10ICyV2igrR6mlH9HA-J6G8L2rzsnZUn0Q4ZQ=m37'
			]
			,
			//10 ep9
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 9, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipO-7qD14-DGw1L7LyRVVkEsHapH9tl87487CQxOpRahwADeu3XsydUVE2-868EYIA/photo/AF1QipN7dhmYi9EIvvpfPjFU--HavkVzhunZ_oLYKgxs?key=UkdPbk42aDJUcU0xOHJXbTRKUXpaVjlROEItYnVB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/iCwLT3t3dki7asFr07-BM1JVoo3Nmi2msB2cnS7Jv_wXPAyYxBC6ivn8wKX0dyaW7VzrQeIeQSebYJ3iyPGXSKPeRcaI_f2VCFW_eI99OXfJ0vA21GBZgGm5iZqYhpFnqO9UFw=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/iCwLT3t3dki7asFr07-BM1JVoo3Nmi2msB2cnS7Jv_wXPAyYxBC6ivn8wKX0dyaW7VzrQeIeQSebYJ3iyPGXSKPeRcaI_f2VCFW_eI99OXfJ0vA21GBZgGm5iZqYhpFnqO9UFw=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/iCwLT3t3dki7asFr07-BM1JVoo3Nmi2msB2cnS7Jv_wXPAyYxBC6ivn8wKX0dyaW7VzrQeIeQSebYJ3iyPGXSKPeRcaI_f2VCFW_eI99OXfJ0vA21GBZgGm5iZqYhpFnqO9UFw=m37'
			]
			,
			//10 ep10
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 10, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipP-q1OZ7CSmEMtKnxNjn1qR1spM79Qp1QlYKZtCRdxyZOZdjTqNN4E_h5O3UjPAcA/photo/AF1QipPYAg8BAJdye5c6dxmKEpWjs18Bd1NIiz9vWPiW?key=OF9sUkVaRjdHQU8tX0l3Zm5Tb04zRzl0VUVPQ1Zn',
				'film_src_360p' => 'https://lh3.googleusercontent.com/qAW6l8WMd5s97sRy1eL_nANfTt8l4F2F-buG2gU1YmvGHOAozuYUIsFUqZjDjTjJeJcqla_iUoJOKGjSgFIqpyPHuGxUSPeMarw3tdV08VYX6YLdDBRizMLs-72CgCYf1Hbgww=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/qAW6l8WMd5s97sRy1eL_nANfTt8l4F2F-buG2gU1YmvGHOAozuYUIsFUqZjDjTjJeJcqla_iUoJOKGjSgFIqpyPHuGxUSPeMarw3tdV08VYX6YLdDBRizMLs-72CgCYf1Hbgww=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/qAW6l8WMd5s97sRy1eL_nANfTt8l4F2F-buG2gU1YmvGHOAozuYUIsFUqZjDjTjJeJcqla_iUoJOKGjSgFIqpyPHuGxUSPeMarw3tdV08VYX6YLdDBRizMLs-72CgCYf1Hbgww=m37'
			]
			,
			//10 ep11
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 11, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipOGMseUA05eE2mw187rMvxYkg4MzFDKU5iqFE4uElqM229Gl9SGzDR-9xMjIePYSA/photo/AF1QipMVv2mAjsintH1pi-rLuT4QkWbICoQfKinjxPKi?key=ZFl1cy1oNG1SZGZxd0ZfQnhJcEtoNllGS21YU3ln',
				'film_src_360p' => 'https://lh3.googleusercontent.com/XqOVLWPeqmQX4aBeaznKdhEGoPS_MOVtXlgkx-58TPrIImViLb23ADIlZlltZjo3TBozUTpf1s3_xSufl7zoThH7cP45TUik4c0KThk0wYzWramGsdzsKBsCm1Dc5W11E9J_6A=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/XqOVLWPeqmQX4aBeaznKdhEGoPS_MOVtXlgkx-58TPrIImViLb23ADIlZlltZjo3TBozUTpf1s3_xSufl7zoThH7cP45TUik4c0KThk0wYzWramGsdzsKBsCm1Dc5W11E9J_6A=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/XqOVLWPeqmQX4aBeaznKdhEGoPS_MOVtXlgkx-58TPrIImViLb23ADIlZlltZjo3TBozUTpf1s3_xSufl7zoThH7cP45TUik4c0KThk0wYzWramGsdzsKBsCm1Dc5W11E9J_6A=m37'
			]
			,
			//10 ep12
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => 12, 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => 'https://photos.google.com/share/AF1QipNMmd_bNcrypV_xn3Fl37mT3DkeQ-OqHwJYanZBUaUj5Vi9Y94ECYtyE7uCTeSiGQ/photo/AF1QipN6ZO4R-hqtPXPJRotTqa3wO_OAnIcrs7RzKZ3d?key=RDdfZEtaY2lqZ2FET1VKZWt3U3Q5QXRtR2NGc2tB',
				'film_src_360p' => 'https://lh3.googleusercontent.com/4kBr3js1cvg_o8WDi-isBOSAFTaP7TWoKzCWC2TjysGZr31jwCte8qaioeGfGNbCcpcfziUDntu-fvHcUShc1an1zEtkOSRH6043JBi-QR_tuhsyw2AZXYEsEQxC9fWOvz-76Q=m18',
				'film_src_480p' => '',
				'film_src_720p' => 'https://lh3.googleusercontent.com/4kBr3js1cvg_o8WDi-isBOSAFTaP7TWoKzCWC2TjysGZr31jwCte8qaioeGfGNbCcpcfziUDntu-fvHcUShc1an1zEtkOSRH6043JBi-QR_tuhsyw2AZXYEsEQxC9fWOvz-76Q=m22',
				'film_src_1080p' => 'https://lh3.googleusercontent.com/4kBr3js1cvg_o8WDi-isBOSAFTaP7TWoKzCWC2TjysGZr31jwCte8qaioeGfGNbCcpcfziUDntu-fvHcUShc1an1zEtkOSRH6043JBi-QR_tuhsyw2AZXYEsEQxC9fWOvz-76Q=m37'
			]
			/*
			,
			//10 ep
			[
				'film_id' => 10, 
				'film_episode_language' => 'vs',
				'film_episode' => , 
				'film_episode_quality' => '1080p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => '',
				'film_src_360p' => '',
				'film_src_480p' => '',
				'film_src_720p' => '',
				'film_src_1080p' => ''
			]
			*/
			/*
			,
			//
			[
				'film_id' => , 
				'film_episode_language' => 'vs',
				'film_episode' => 0, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => '',
				'film_src_360p' => '',
				'film_src_480p' => '',
				'film_src_720p' => '',
				'film_src_1080p' => ''
			]
			*//*
			,
			//
			[
				'film_id' => , 
				'film_episode_language' => 'vs',
				'film_episode' => 0, 
				'film_episode_quality' => '720p',
				'film_src_remote' => '',
				'film_src_name' => 'google photos',
				'film_src_full' => '',
				'film_src_360p' => '',
				'film_src_480p' => '',
				'film_src_720p' => '',
				'film_src_1080p' => ''
			]
			*/

		]);
	}

}
