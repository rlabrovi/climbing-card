<?php

use ClimbingCard\Services\Route;

Route::setNamespace('ClimbingCard\Http');

Route::adminPage(
	__(
		'Climbing Card',
		'climbingcard'
	),
	'climbingcard',
	'Admin\JournalsController@index',
	['position' => 40]
);

Route::adminSubPage(
	__('Settings',  'climbingcard'),
	'climbingcard',
	'settings',
	'Admin\SettingsController@index',
	['position' => 60]
);
