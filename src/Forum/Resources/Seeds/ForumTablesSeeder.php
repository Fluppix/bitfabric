<?php

namespace Bitaac\Forum\Resources\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ForumTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('__bitaac_forum_boards')->insert([
            'title'       => 'Latest News',
            'description' => 'Here you\'ll find all of our latest announcements.',
            'news'        => 1,
        ]);
    }
}