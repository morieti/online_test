<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
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
        User::factory(10)->create();
        Post::factory(50)->create()->each(function (Post $model) {
            $media = $model
                ->addMediaFromUrl('https://picsum.photos/1000/500')
                ->toMediaCollection();
            $model->thumbnail = $media->getUrl(Post::MEDIA_CONVERSION_NAME);
            $model->save();
        });
    }
}
