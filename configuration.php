<?php

// Your OAuth token (Intuit will give you this when you register an Intuit Anywhere app)
define('OAUTH_TOKEN',           '9b74bd1ab0f32b4b6cb93b6b2e5af5a3e9c6');
// Your OAuth consumer key and secret (Intuit will give you both of these when you register an Intuit app)
define('OAUTH_CONSUMER_KEY',    'qyprd4OFga81URvkibIIYWTFzc2aFX');
define('OAUTH_CONSUMER_SECRET', 'LOAjeDsW7ZiH19ZhUTin7GMBZWzeOJ3Bfbbk9ZjB');


// Your database connection credentials that will be used to store the OAuth credentials
define('DB_SERVER',             'localhost');
define('DB_DATABASE',           'example_app_ipp_v3'); // quickbooks_server
define('DB_USER',               'root');
define('DB_PASSWORD',           '');
// The complete database handler (MySQLi)
define('DSN',                   'mysqli://'.DB_USER.':'.DB_PASSWORD.'@'.DB_SERVER.'/'.DB_DATABASE);


// You should set this to an encryption key specific to your app
define('ENCRYPTION_KEY',        'bcde1234');
// Do not change this unless you really know what you're doing!!!  99% of apps will not require a change to this.
define('APP_USERNAME',          'DO_NOT_CHANGE_ME');
// The tenant that user is accessing within your own app
define('APP_TOKEN',             12345);


// This is the URL of your OAuth auth handler page
define('OAUTH_URL',             'http://intuit.dev/quickbooks-php/docs/partner_platform/example_app_ipp_v3/oauth.php');
// This is the URL to forward the user to after they have connected to IPP/IDS via OAuth
define('SUCCESS_URL',           'http://intuit.dev/quickbooks-php/docs/partner_platform/example_app_ipp_v3/success.php');
// This is the menu URL script
define('MENU_URL',              'http://intuit.dev/quickbooks-php/docs/partner_platform/example_app_ipp_v3/menu.php');