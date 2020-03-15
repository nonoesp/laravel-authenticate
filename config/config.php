<?php

return [
	
    /*
    |--------------------------------------------------------------------------
    | Authentication routes
    |--------------------------------------------------------------------------
    |
    | This values determine the routes where the user will sign in, out, and
	| the route where the administration is at when there is no destination.
	| Also, what middlewares to be used in all routes.
	*/
	
	'entrance' => 'login',

	'exit' => 'logout',

	'destination' => 'admin',

	'middlewares' => ['web'],
	
];