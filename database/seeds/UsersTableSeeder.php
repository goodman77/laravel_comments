<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create one random user
		 $id = DB::table('users')->insertGetId([
            'name' => str_random(10),
			'created_at' =>Carbon::now(),
			'updated_at' =>Carbon::now()
        ]);
		
		//create a post
		 $post_id = DB::table('posts')->insertGetId([
            'user_id' => $id,
			'title' => 'main comment',
			'body' =>' this is main comment post',
			'created_at' =>Carbon::now(),
			'updated_at' =>Carbon::now()
        ]);
		
		//create some comments
		$parent_id_a=DB::table('comments')->insertGetId([
            'user_id' => $id,
			'post_id' =>$post_id, 
			'parent_id' => 0,
			'comment' =>'First Comment',
			'created_at' =>Carbon::now(),
			'updated_at' =>Carbon::now()
        ]);
		$parent_id_b=DB::table('comments')->insertGetId([
            'user_id' => $id,
			'post_id' =>$post_id, 
			'parent_id' => 0,
			'comment' =>'Second Comment',
			'created_at' =>Carbon::now(),
			'updated_at' =>Carbon::now()
        ]);
		DB::table('comments')->insert([
            'user_id' => $id,
			'post_id' =>$post_id, 
			'parent_id' => $parent_id_b,
			'comment' =>'Second Comment',
			'created_at' =>Carbon::now(),
			'updated_at' =>Carbon::now()
        ]);

		
    }
}
