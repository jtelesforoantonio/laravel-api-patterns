<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Posts\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::factory(100)->create();
    }
}
