<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(
            function (User $user) {
                $posts = Post::factory(5)->create(['user_id' => $user->id]);
                $user->posts()->saveMany($posts);
            }
        );
    }
}
