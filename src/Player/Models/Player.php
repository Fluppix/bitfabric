<?php

namespace Bitaac\Player\Models;

use DB;
use Bitaac\Core\Database\Eloquent\Model;
use Bitaac\Contracts\Player as Contract;

class Player extends Model implements Contract
{
    /**
     * Table used by the model
     */
    protected $table = 'players';

    /**
     * Tell the model to not use timestamps
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Determine if the player is hidden
     *
     * @return BitPlayer
     */
    public function isHidden()
    {
        return (int) $this->bitaac->hidden;
    }

    /**
     * Get the BitPlayer associated with the current player.
     *
     * @return BitPlayer
     */
    public function bitaac()
    {
        return $this->hasOne('Bitaac\Player\Models\BitPlayer', 'player_id');
    }

    /**
     * Return the related account.
     *
     * @return Account
     */
    public function account()
    {
        return $this->hasOne('Bitaac\Contracts\Account', 'id', 'account_id');
    }

    /**
     * Determine if player is pending deletion.
     *
     * @return boolean
     */
    public function hasPendingDeletion()
    {
        return $this->bitaac->deletion_time > time();
    }

    /**
     * Get total forum posts made by player.
     *
     * @return integer
     */
    public function posts()
    {
        return $this->hasMany('Bitaac\Forum\Models\ForumPost', 'player_id')->count();
    }

    /**
     * Get a absolute link to the player.
     *
     * @return string
     */
    public function link()
    {
        return url_e('/character/:name', [
            'name' => $this->name
        ]);
    }

    /**
     * Changing an Eloquent model's "route key".
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Get the player deaths.
     *
     * @return \Bitaac\Death\Death
     */
    public function deaths()
    {
        return $this->hasMany('Bitaac\Contracts\Death')->orderBy('time', 'desc');
    }

    /**
     * Create a new character.
     *
     * @param array $attributes
     * @return void
     */
    public function make(array $attributes = [])
    {
        $name = trim(strtolower($attributes['name']));

        $character             = new $this;
        $character->name       = ucwords($name);
        $character->account_id = auth()->id();
        $character->sex        = (int) $attributes['gender'];
        $character->vocation   = (int) $attributes['vocation'];
        $character->town_id    = (int) $attributes['town'];
        $character->conditions = '';
        $character->group_id   = 1;

        $character->looktype   = $character->sex ? 128 : 136;
        $character->lookhead   = 78;
        $character->lookbody   = 69;
        $character->looklegs   = 58;
        $character->lookfeet   = 76;

        if ($level = value_args(config('bitaac.character.create-data.level'), $character)) {
            $character->level = $level;
        }

        if ($maglevel = value_args(config('bitaac.character.create-data.maglevel'), $character)) {
            $character->maglevel = $maglevel;
        }

        if ($health = value_args(config('bitaac.character.create-data.health'), $character)) {
            $character->health    = $health;
            $character->healthmax = $health;
        }

        if ($mana = value_args(config('bitaac.character.create-data.mana'), $character)) {
            $character->mana    = $mana;
            $character->manamax = $mana;
        }

        if ($capacity = value_args(config('bitaac.character.create-data.capacity'), $character)) {
            $character->cap = $capacity;
        }

        $character->save();
    }

    /**
     * Get the online status associated with the current player.
     *
     * @return boolean
     */
    public function playerOnline()
    {
        return $this->hasOne('Bitaac\Contracts\Online');
    }

    /**
     * Create a scope for all online characters.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeGetOnlineList($query)
    {
        return $query->has('playerOnline')->get();
    }

    /**
     * Determine if player is online or not.
     *
     * @return boolean
     */
    public function isOnline()
    {
        return (boolean) $this->playerOnline;
    }

    /**
     * Get the online record.
     *
     * @return integer
     */
    public function getOnlineRecord()
    {
        return \DB::table('server_config')->where('config', 'players_record')->first()->value;
    }

    /**
     * Get player guild invitees.
     *
     * @return HasMany
     */
    public function guildInvitees()
    {
        return $this->hasMany('Bitaac\Contracts\GuildInvite', 'player_id');
    }

    /**
     * Get player guild.
     *
     * @return HasOne
     */
    public function guild()
    {
        return $this->hasOne('Bitaac\Contracts\GuildMember', 'player_id');
    }
}
