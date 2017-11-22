<?php
if (@$_SESSION ['debug']) {
	error_reporting ( E_ALL );
} else {
	error_reporting ( 0 );
}
ini_set('display_errors', 0);
session_start();
// SYSTEM
define ( '_projectName', 'Studio NOA' );
define ( '_projectLogo', 'logo_default.png' );
define ( '_projectIsoLogo', 'dominit_logosolo_180.png' );
set_time_limit (180);

// DB

define ( '_hostname_conn', 'localhost' );
define ( '_prefix_conn', '' );
define ( '_database_conn', 'sateserv_satefac' );
define ( '_username_conn', 'sateserv_satefac' );
define ( '_password_conn', 'sateserv_satefac123' );
define ( '_port_conn', '' );

$conn = mysqli_connect ( _hostname_conn, _username_conn, _password_conn, _database_conn, _port_conn ) or die ( "Error " . mysqli_error ( $conn ) );
mysqli_query ( $conn, 'SET CHARACTER SET utf8' );


if(!isset($_SESSION['orden'])){
	$_SESSION['orden'] = array();
}
?>