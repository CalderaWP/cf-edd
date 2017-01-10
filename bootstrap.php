<?php
add_action( 'plugins_loaded', function(){
	include_once __DIR__ . '/vendor/autoload.php';

	//Setup EDD SL intergration
	\calderawp\cfeddfields\setup::add_hooks();

	//Setup auto-population
	( new \calderawp\cfeddfields\fields\populate\query() )->add_hooks();
	add_action( 'caldera_forms_admin_init', function(){
		new \calderawp\cfeddfields\fields\populate\admin();
	});


}, 2 );