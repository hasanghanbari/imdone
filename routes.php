<?php
$router = new AltoRouter();
$router->setBasePath('/imdone');

// VIEW ROUTER
$router->map( 'GET', '/', 				function() {require __DIR__ . '/views/home.php';});
$router->map( 'GET', '/login', 			function() {require __DIR__ . '/views/login.php';});
// $router->map( 'GET', '/register', 		function() {require __DIR__ . '/views/register.php';});
$router->map( 'GET', '/class/create', 	function() {require __DIR__ . '/views/create_class.php';});

// CONTROLLER ROUTER
$router->map( 'POST', '/action/admins/register'	, function() { AdminsController::register(); } );
$router->map( 'POST', '/action/admins/login'	, function() { AdminsController::login(); } );

$router->map( 'POST', '/action/class/create'	, function() { ClassController::create(); } );
$router->map( 'GET' , '/class/list'				, function() { ClassController::list(); } );
$router->map( 'GET' , '/[i:id]'					, function($id) { ClassController::info($id); });

$router->map( 'POST', '/users/register'			, function() { UsersController::register(); } );
$router->map( 'GET' , '/users/list/[i:id]'		, function($id) { UsersController::list($id); } );
$router->map( 'POST', '/users/undone'			, function() { UsersController::resetDone(); } );
$router->map( 'POST', '/users/done/[i:id]'		, function($id) { UsersController::Done($id); } );

$router->map( 'GET', '/logout'			, function() { 
	// Logout Code
	setcookie("admin", "", time() - (86400 * 7));
	header('Location: '. GetUrl() .'login');
 } );

// match current request url
$match = $router->match();

// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

?>