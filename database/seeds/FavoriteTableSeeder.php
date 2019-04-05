<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('favorites')->delete();

        $users = User::pluck('id')->all();
        $numberOfUsers = count($users);

        foreach (Post::isPublished()->get() as  $post) {
            for ($i=0; $i < rand(1,$numberOfUsers); $i++) {
                $user = $users[$i];
                $post->favorites()->attach($user);
            }
        }
    }
}