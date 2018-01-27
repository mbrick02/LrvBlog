<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // factory(App\User::class, 50)->create() //->each(function($u) { $u->posts()->save(factory(App\Post::class)->make());});
        // 1/27/18 Note: above is based on laravel.com my Post factory is based on:
    	// 			https://laracasts.com/series/laravel-from-scratch-2017/episodes/22
    	// ?? run seeders separately: $this->call([ UsersTableSeeder::class, PostsTableSeeder::class,...]);
    }
}
