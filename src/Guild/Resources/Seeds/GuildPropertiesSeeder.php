<?php

namespace Bitaac\Guild\Resources\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Bitaac\Guild\Models\BitGuild;
use Illuminate\Database\Eloquent\Model;

class GuildPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guilds = app('guild')->all();
        
        foreach ($guilds as $guild) {
            if ($guild->bitaac) {
                continue; 
            }

            $bitguild = new BitGuild;
            $bitguild->guild_id = $guild->id;
            $bitguild->save();
        }
    }
}