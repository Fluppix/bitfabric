<?php

if (! function_exists('gender')) {
    /**
     * Convert gender ID to human-readable format
     *
     * @return string
     */
     function gender($id) {
         return config("bitaac.server.genders.${id}");
     }
}

if (! function_exists('vocation')) {
    /**
     * Convert vocation ID to human-readable format
     *
     * @param integer|string  $id
     * @param boolean  $reverse
     * @return string
     */
     function vocation($id, $reverse = false) {
         if (! $reverse) {
             return config("bitaac.server.vocations.${id}");
         }

         $id = str_replace('-', ' ', $id);

         $collection = collect(config('bitaac.server.vocations'));

         return key($collection->filter(function($value, $key) use($id) {
             if (strtolower($value) == urldecode($id)) {
                 return $key;
             }
         })->all());
     }
}

if (! function_exists('town')) {
    /**
     * Convert town ID to humad-readable format
     *
     * @return string
     */
     function town($id) {
         return config("bitaac.server.towns.${id}");
     }
}

if ( ! function_exists('value_args'))
{
	/**
	 * Return the default value of the given value.
	 *
	 * @param  mixed $value
	 * @param  array $args []
	 * @return mixed
	 */
	function value_args($value, $args = array())
	{
		if ( ! ($value instanceof Closure))
		{
			return $value;
		}

		if ( ! is_array($args))
		{
			$args = [$args];
		}

		return call_user_func_array($value, $args);
	}
}

if ( ! function_exists('formulae'))
{
	/**
	 * Create a function to calculate common formulas.
	 *
	 * @param  string $formula
	 * @param  \Player $player
	 * @param  array $args false
	 * @return mixed
	 */
	function formulae($formula, \Bitaac\Contracts\Player $player, $value = false)
	{
		switch (strtolower($formula))
		{
			case 'maglevel':
				return array($value, 0);
			case 'health':
				return 145 + ($player->level >= 8 ? (($player->level - 8) * $value) + (5 * 8) : (5 * $player->level));
			case 'mana':
				return ($player->level >= 8 ? (($player->level - 8) * $value) + (5 * 8) : (5 * $player->level));
			case 'capacity':
				return 390 + ($player->level >= 8 ? (($player->level - 8) * $value) + (10 * 8) : (10 * $player->level));
		}
	}
}

if ( ! function_exists('url_e'))
{
	/**
	 * Convert a value to a more URL-friendly version.
	 *
	 * @param  string $value
	 * @param  array $arguments []
	 * @return string
	 */
	function url_e($value, array $arguments = array())
	{
		foreach ($arguments as $key => $argument)
		{
			$value = preg_replace('/\:'.preg_quote($key, '/').'/i', strtolower(urlencode(e($argument))), $value);
		}

		return str_replace('+', '-', url($value));
	}
}

if ( ! function_exists('ago'))
{
	/**
	 * Format a unix timestamp in a 'time ago' format,
	 * e.g. 15 minutes ago or 7 days ago.
	 *
	 * @param  integer $time
	 * @return string
	 */
	function ago($time)
	{
        $config = array(
    		array('second',	 'seconds'),
    		array('minute',	 'minutes'),
    		array('hour',	 'hours'),
    		array('day',	 'days'),
    		array('week',	 'weeks'),
    		array('month',	 'months'),
    		array('year',	 'years'),
    		array('decade',	 'decades'),
    	);

		list($periods, $lengths, $now) = array($config, [60, 60, 24, 7, 4.35, 12, 10], time());
		$difference = $now - $time;
		for ($j = 0; $difference >= $lengths[$j] and $j < count($lengths) - 1; $j++)
		{
			$difference /= $lengths[$j];
		}
		$difference = round($difference);
		$period = $difference == 1 ? $periods[$j][0] : $periods[$j][1];
		if ($difference == 0)
		{
			return 'Just now';
		}

        return "${difference} ${period} ago";
	}
}

if ( ! function_exists('player'))
{
	/**
	 * Initialize a new player object by player id
	 *
	 * @param  integer $player_id
	 * @return \Bitaac\Player\Player
	 */
	function player($player_id)
	{
        $player = app('player')->where('id', $player_id);

        return ($player->exists()) ? $player->first() : false ;
	}
}

if ( ! function_exists('str_e'))
{
	/**
	 * Convert a value to a more friendly version.
	 *
	 * @param  string $value
	 * @param  array $arguments []
	 * @return string
	 */
	function str_e($value, array $arguments = [], $lower = true) 
	{
		foreach ($arguments as $key => $argument)
		{
			$value = preg_replace(
                '/\:'.preg_quote($key, '/').'/i', 
                ($lower) ? strtolower($argument) : $argument, $value
            );
		}

		return $value;
	}
}

if ( ! function_exists('player_value'))
{
	/**
	 * Determine if $value is a player name, then we will return 
	 * a link to its view, or we will just return the value.
	 *
	 * @param  mixed $value
	 * @return mixed
	 */
	function player_value($value) 
	{
		$player = app('player')->where('name', $value);

		return ($player->exists()) ? "<a href='{$player->first()->link()}'>{$value}</a>" : $value ;
	}
}

if ( ! function_exists('lines'))
{
    /**
     * Force a maximum amount of lines in a string.
     *
     * @param  string $string
     * @param  integer $lines 10
     * @return string
     */
    function lines($string, $lines = 10)
    {
        $i = 0;
        return preg_replace_callback('/\\r\\n/i', function($value) use(&$i, $lines)
        {
            if ((++$i) > $lines)
            {
                return null;
            }
            return head($value);    
        }, $string);
    }
}
