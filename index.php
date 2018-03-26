<?php
require 'conf.php';
require 'cryp.php';
require 'vendor/autoload.php';
list($conn, $user, $password) = $DB_SETUP;
Flight::set('flight.log_errors', true);


Flight::route('/api/e/', function(){
    $id = Flight::request()->data->id;
    $e_id = encrypt($id);
    Flight::json(['id'=> $e_id]);
});


Flight::route('/', function(){
    global $baseurl;
    Flight::render('index', array('urlbase' => $baseurl));
});


Flight::start();

?>
