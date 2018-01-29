<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
  use DatabaseTransactions;  // rollback transactions after test

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // Given I have 2 recs in db that are posts,
        // and each one is posted a month apart.
        $first = factory(Post::class)->create();

        $second = factory(Post::class)->create([
          'created_at' => \Carbon\Carbon::now()->subMonth()
        ]);


        // When I fetch the archives.
        $posts = Post::archives();

        // Then the response should be in the proper format.
        $this->assertEquals([
          [
            "year" => $first->created_at->format('Y'),
            "month" => $first->created_at->format('F'), // month
            "published" => 3
          ],
          [
            "year" => $second->created_at->format('Y'),
            "month" => $second->created_at->format('F'), // month
            "published" => 3
          ]
        ]);
    }
}
