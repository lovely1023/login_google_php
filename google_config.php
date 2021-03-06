<?php
// Database configuration
// define('DB_HOST', 'MySQL_Database_Host');
// define('DB_USERNAME', 'MySQL_Database_Username');
// define('DB_PASSWORD', 'MySQL_Database_Password');
// define('DB_NAME', 'MySQL_Database_Name');
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'MySQL_Database_Username');
define('DB_PASSWORD', 'MySQL_Database_Password');
define('DB_NAME', 'MySQL_Database_Name');
define('DB_USER_TBL', 'users');

// Google API configuration
// define('GOOGLE_CLIENT_ID', 'Insert_Google_Client_ID');
// define('GOOGLE_CLIENT_SECRET', 'Insert_Google_Client_Secret');
// define('GOOGLE_REDIRECT_URL', 'Callback_URL');
define('GOOGLE_CLIENT_ID', '211289407873-ltj7oaov2phn4a4sooickopivrvmrge7.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'dcQlNWEbsPi2vo88kODmnLZL');
//define('GOOGLE_REDIRECT_URL', 'http://localhost/PHP-Login-With-Google-master');
define('GOOGLE_REDIRECT_URL', 'http://localhost/ouslet/login.php');
//define('GOOGLE_REDIRECT_URL', 'http://localhost/ouslet/login_google');
//define('GOOGLE_REDIRECT_URL', 'http://localhost/ouslet');

// Start session
if (!session_id()) {
    session_start();
}

// Include Google API client library
require_once 'google-api-php-client/Google_Client.php';
require_once 'google-api-php-client/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to www.carry0987.com');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);