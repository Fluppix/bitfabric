<?php

namespace Bitaac\Death\Models;

use Bitaac\Core\Database\Eloquent\Model;
use Bitaac\Contracts\Death as Contract;

class Death extends Model implements Contract
{
    /**
     * Table used by the model
     */
    protected $table = 'player_deaths';

    /**
     * Get the related player.
     *
     * @return HasOne
     */
    public function player()
    {
        return $this->hasOne('Bitaac\Contracts\Player', 'id', 'player_id');
    }
}
