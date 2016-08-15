# Intuit-QuickBooks-API

This a small library and code example for retrieving QuickBooks invoice data.

## Code Examples

```php
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

echo '<pre>';
print_r($invoices);
```

## Installation / Integration:

1. Run the SQL file 'example_app_ipp_v3.sql' to create the necessary data table and columns .
2. Change the API credentials in 'configuration.php'. Note; make sure that 'intuit.dev' within OAUTH_URL, SUCCESS_URL, & MENU_URL match your enviorment!
3. Visit 'oauth.php' from the browser to log in.
4. Visit 'process.php' from the browser to review invoice data.

## License

Intuit-QuickBooks-API is licensed under the [MIT License](http://opensource.org/licenses/MIT).

Copyright 2015-2016 [Travis van der Font](http://travisfont.com)
