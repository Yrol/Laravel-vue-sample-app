<?php

use App\Model\Categories;
use App\Model\Likes;
use App\Model\Questions;
use App\Model\Replies;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();
        factory(Categories::class, 5)->create();
        factory(Questions::class, 10)->create();

        //in here, after we create a reply, get that reply "$reply" and add a like to it. The "likes" relationship/method is defined in "/app/Model/Replies.php" using "hasMany"
        factory(Replies::class, 50)->create()->each(function ($reply){
            return $reply->likes()->save(factory(Likes::class)->make());
        });
    }
}
