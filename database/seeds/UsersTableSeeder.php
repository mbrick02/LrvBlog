<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 2 posts (and users) a month old, 5 current post, 15 users
        factory(Post::class, 2)->create([
            'created_at' => \Carbon\Carbon::now()->subMonth()
        ]);
        factory(Post::class, 2)->create();
        factory(User::class, 15)->create();
        
    }
}
