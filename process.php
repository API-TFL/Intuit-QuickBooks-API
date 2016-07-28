<?php

require_once 'configuration.php'; // Configuration constants
require_once 'classes/MyQuickBooksIntegration.php'; // Custom MyQuickBooksIntegration class

// Require the library code
require_once 'quickbooks-php/QuickBooks.php';

$parameters = array
(
    'dsn'                    => DSN,
    'encryption_key'         => ENCRYPTION_KEY,
    'oauth_consumer_key'     => OAUTH_CONSUMER_KEY,
    'oauth_consumer_secret'  => OAUTH_CONSUMER_SECRET,
    'quickbooks_oauth_url'   => OAUTH_URL,
    'quickbooks_success_url' => SUCCESS_URL,
    'username'               => APP_USERNAME,
    'tenant'                 => APP_TOKEN
);

$qb = new MyQuickBooksIntegration($parameters);
$invoices = $qb->getInvoices('2015-01-22');
//$invoices = $qb->getInvoices(); // no date can also be called
//$invoices = $qb->getInvoices('', 1, 25); // second example with no date (retrieves the last 25 records)

echo '<pre>';
print_r($invoices);