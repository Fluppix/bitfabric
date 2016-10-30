<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Max amount of words the player can have in their name
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'name-maxwords' => 2,

    /*
    |--------------------------------------------------------------------------
    | New character data
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'create-data' => [

        /*
        |--------------------------------------------------------------------------
        | Level
        |--------------------------------------------------------------------------
        |
        | ...
        |
        */

        'level' => 8,

        /*
        |--------------------------------------------------------------------------
        | Experience
        |--------------------------------------------------------------------------
        |
        | ...
        |
        */

        'experience' => 4200,

        /*
        |--------------------------------------------------------------------------
        | Maglevel
        |--------------------------------------------------------------------------
        |
        | ...
        |
        */

        'maglevel' => 0,

        /*
        |--------------------------------------------------------------------------
        | Health
        |--------------------------------------------------------------------------
        |
        | ...
        |
        */

        'health' => function ($player) {
            list($gain, $gains) = [5, config('bitaac.server.gains.health')];

            if (isset($gains[$player->vocation])) {
                $gain = $gains[$player->vocation];
            }

            return formulae('health', $player, $gain);
        },

        /*
        |--------------------------------------------------------------------------
        | Mana
        |--------------------------------------------------------------------------
        |
        | ...
        |
        */

        'mana' => function ($player) {
            list($gain, $gains) = [5, config('bitaac.server.gains.mana')];

            if (isset($gains[$player->vocation])) {
                $gain = $gains[$player->vocation];
            }

            return formulae('mana', $player, $gain);
        },

        /*
        |--------------------------------------------------------------------------
        | Capacity
        |--------------------------------------------------------------------------
        |
        | ...
        |
        */

        'capacity' => function ($player) {
            list($gain, $gains) = [10, config('bitaac.server.gains.capacity')];

            if (isset($gains[$player->vocation])) {
                $gain = $gains[$player->vocation];
            }

            return formulae('capacity', $player, $gain);
        },

    ],

    /*
    |--------------------------------------------------------------------------
    | Vocations available upon character creation
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'create-vocations' => [
        1, 2, 3, 4,
    ],

    /*
    |--------------------------------------------------------------------------
    | Towns available upon character creation
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'create-towns' => [
        1, 2, 3, 4,
    ],

    /*
    |--------------------------------------------------------------------------
    | Genders available upon character creation
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'create-genders' => [
        1, 0,
    ],

    /*
    |--------------------------------------------------------------------------
    | Blocked character name keywords
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'create-blocked-keywords' => [
        'gm',
    ],

];
