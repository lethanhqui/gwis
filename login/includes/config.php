<?php
ob_start();
session_start();

//set timezone
//date_default_timezone_set('Europe/London');

//database credentials
define('DBHOST','localhost');
define('DBUSER','gwis_important');
define('DBPASS','gwis_important');
define('DBNAME','gwis_important');
define('DB_CHARSET', 'utf8');

//application address
define('DIR','http://gwisbinhdinh.com/login');
define('SITEEMAIL','support@gwisbinhdinh.com');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME.';charset=' . DB_CHARSET, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
include('classes/global.php');
include('classes/phpmailer/mail.php');
$user = new User($db);
$global = new Globals($db);
?>
