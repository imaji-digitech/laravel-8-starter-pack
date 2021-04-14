<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\Tag;
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
        // \App\Models\User::factory(10)->create();
        Status::create(['title'=>'waiting']);
        Status::create(['title'=>'accept']);
        Status::create(['title'=>'decline']);

        Tag::create(['title'=>'tag-1']);
        Tag::create(['title'=>'tag-2']);
        Tag::create(['title'=>'tag-3']);
    }
}
