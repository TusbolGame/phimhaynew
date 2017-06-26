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
		
		// $this->call('FilmRelateDatabaseSeeder');
		// $this->call('FilmJobDatabaseSeeder');	
		// $this->call('FilmCountryDatabaseSeeder');
		// $this->call('FilmTypeDatabaseSeeder');
		// $this->call('UserDatabaseSeeder');
		$this->call('RoleDatabaseSeeder');
		
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
			['film_relate_name' => 'Lost - Mất tích'],
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
class FilmTypeDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('film_types')->insert([
			//1
			['type_name' => 'chiến trang', 'type_alias' => 'chien-tranh'],
			['type_name' => 'cổ trang', 'type_alias' => 'co-trang'],
			['type_name' => 'giả tưởng', 'type_alias' => 'gia-tuong'],
			['type_name' => 'hài hước', 'type_alias' => 'hai-huoc'],
			['type_name' => 'hành động', 'type_alias' => 'hanh-dong'],
			['type_name' => 'học đường', 'type_alias' => 'hoc-duong'],			
			['type_name' => 'hồi hộp gây cấn', 'type_alias' => 'hoi-hop-gay-can'],
			['type_name' => 'kinh dị', 'type_alias' => 'kinh-di'],
			['type_name' => 'phép thuật', 'type_alias' => 'phep-thuat'],
			['type_name' => 'phiêu lưu', 'type_alias' => 'phieu-luu'],
			['type_name' => 'siêu nhiên', 'type_alias' => 'sieu-nhien'],
			['type_name' => 'tài liệu', 'type_alias' => 'tai-lieu'],
			['type_name' => 'tâm lý', 'type_alias' => 'tam-ly'],
			['type_name' => 'thần thoại', 'type_alias' => 'than-thoai'],
			['type_name' => 'tình cảm', 'type_alias' => 'tinh-cam'],
			['type_name' => 'trinh thám', 'type_alias' => 'trinh-tham'],
			['type_name' => 'viễn tưởng', 'type_alias' => 'vien-tuong'],
			['type_name' => 'võ thuật', 'type_alias' => 'vo-thuat'],
			['type_name' => 'zombie', 'type_alias' => 'zombie']
			
			]);
	}

}
class UserDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
			//1
			[
				'username' => 'admin', 
				'password' => '$2y$10$z5y06rL5yyUbnM80lrxkGeeWWlL1O/1OEhwjFkChnnHsGS/1yEWAO', //123456
				'image' => 'icon-user-default.jpg',
				'email' => 'admin@localhost.com',
				'level' => 1,
				'actived' => 1,
				'blocked' => 0,
			]
			]);
	}

}
//role
class RoleDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		DB::table('roles')->insert([
			//1
			[
				'role_name' => 'Superadmin',
				'role_description' => 'All role'
			],
			[
				'role_name' => 'Admin',
				'role_description' => 'Is Admin role'
			]
			,
			[
				'role_name' => 'Member',
				'role_description' => 'Is Member role'
			]
		]);
		//user-role
		DB::table('user_roles')->insert([
			//1
			[
				'user_id' => 1,
				'role_id' => 1
			]
		]);
		//permission
		DB::table('permissions')->insert([
			//allow access admin page
			[
				'permission_name' => 'accessAdmin', 
				'permission_description' => ''
			],
			//role
			[
				'permission_name' => 'createRole',
				'permission_description' => ''
			],
			[
				'permission_name' => 'editRole',
				'permission_description' => ''
			],
			[
				'permission_name' => 'deleteRole',
				'permission_description' => ''
			],
			[
				'permission_name' => 'showRole',
				'permission_description' => ''
			],
			//user
			[
				'permission_name' => 'createUser',
				'permission_description' => ''
			],
			[
				'permission_name' => 'editUser',
				'permission_description' => ''
			],
			[
				'permission_name' => 'deleteUser',
				'permission_description' => ''
			],
			[
				'permission_name' => 'showUser',
				'permission_description' => ''
			],
			//film
			[
				'permission_name' => 'createFilm',
				'permission_description' => ''
			],
			[
				'permission_name' => 'editFilm',
				'permission_description' => ''
			],
			[
				'permission_name' => 'deleteFilm',
				'permission_description' => ''
			],
			[
				'permission_name' => 'showFilm',
				'permission_description' => ''
			],
			//slider
			[
				'permission_name' => 'createSlider',
				'permission_description' => ''
			],
			[
				'permission_name' => 'editSlider',
				'permission_description' => ''
			],
			[
				'permission_name' => 'deleteSlider',
				'permission_description' => ''
			],
			[
				'permission_name' => 'showSlider',
				'permission_description' => ''
			],
			//type
			[
				'permission_name' => 'createType',
				'permission_description' => ''
			],
			[
				'permission_name' => 'editType',
				'permission_description' => ''
			],
			[
				'permission_name' => 'deleteType',
				'permission_description' => ''
			],
			[
				'permission_name' => 'showType',
				'permission_description' => ''
			],
			//country
			[
				'permission_name' => 'createCountry',
				'permission_description' => ''
			],
			[
				'permission_name' => 'editCountry',
				'permission_description' => ''
			],
			[
				'permission_name' => 'deleteCountry',
				'permission_description' => ''
			],
			[
				'permission_name' => 'showCountry',
				'permission_description' => ''
			],
			//person
			[
				'permission_name' => 'createPerson',
				'permission_description' => ''
			],
			[
				'permission_name' => 'editPerson',
				'permission_description' => ''
			],
			[
				'permission_name' => 'deletePerson',
				'permission_description' => ''
			],
			[
				'permission_name' => 'showPerson',
				'permission_description' => ''
			],
			//job
			[
				'permission_name' => 'createJob',
				'permission_description' => ''
			],
			[
				'permission_name' => 'editJob',
				'permission_description' => ''
			],
			[
				'permission_name' => 'deleteJob',
				'permission_description' => ''
			],
			[
				'permission_name' => 'showJob',
				'permission_description' => ''
			],

		]);

		//permission role
		//superadmin -> all
		$data = DB::table('permissions')->where('id', '>=', 1)->get();
		foreach ($data as $key) {
			//insert
			DB::table('permission_roles')->insert([
				[
					'permission_id' => $key->id,
					'role_id' => 1
				]
			]);
		}
		//admin -> all but deny role
		foreach ($data as $key) {
			//check -> deny role
			$arr = ['createRole', 'editRole', 'showRole', 'deleteRole'];
			if(!in_array($key->permission_name, $arr)){
				//insert
				DB::table('permission_roles')->insert([
					[
						'permission_id' => $key->id,
						'role_id' => 2 //is id role admin
					]
				]);
			}
			
		}
	}

}

