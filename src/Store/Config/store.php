<?php


return [

	/*
    |--------------------------------------------------------------------------
    | ...
    |--------------------------------------------------------------------------
    |
    |
    */
	
	'types' => [
		'item' => function($attributes) {
			// Deliver a single item to the player
			// $attributes->product, $attributes->player, $attributes->account .... etc
			return $attributes;
		},

		'item_package' => function($attributes) {
			// Deliver a package of items to the player
		},

		'name_change' => function($attributes) {
			// Grant the account a name change of any character
		}
	] 

];