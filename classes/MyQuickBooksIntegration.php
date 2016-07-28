<?php

require_once 'SettersGetters.php';
require_once 'iMyQuickBooksIntegration.php';

final class MyQuickBooksIntegration extends SettersGetters implements iMyQuickBooksIntegration
{
    // defining all the fields to preare a Quickbooks API call
    public function __construct($parameters)
    {
        if (isset($parameters['dsn']))                    $this->setDSN($parameters['dsn']);
        if (isset($parameters['encryption_key']))         $this->setEncryptionKey($parameters['encryption_key']);
        if (isset($parameters['oauth_consumer_key']))     $this->setOauthConsumerKey($parameters['oauth_consumer_key']);
        if (isset($parameters['oauth_consumer_secret']))  $this->setOauthConsumerSecret($parameters['oauth_consumer_secret']);
        if (isset($parameters['quickbooks_oauth_url']))   $this->setOauthUrl($parameters['quickbooks_oauth_url']);
        if (isset($parameters['quickbooks_success_url'])) $this->setSuccessUrl($parameters['quickbooks_success_url']);
        if (isset($parameters['username']))               $this->setUsername($parameters['username']);
        if (isset($parameters['tenant']))                 $this->setTenant($parameters['tenant']);

        // Initialize the database tables for storing OAuth information
        if (!QuickBooks_Utilities::initialized(DSN))
        {
            // Initialize creates the neccessary database schema for queueing up requests and logging
            QuickBooks_Utilities::initialize(DSN);
        }
    }

    // initializing a QuickBOoks API call that retrieves specific invoice information
    public function getInvoices($date = '', $offset = 1, $limit = 10)
    {

        // making sure all config variables are define to call the Quickbooks API and
        if ($this->checkRequiredFields())
        {
            // Set up the IPP instance
            $IPP = new QuickBooks_IPP($this->getDSN());

            $IntuitAnywhere = new QuickBooks_IPP_IntuitAnywhere(
                              $this->getDSN(),
                              $this->getEncryptionKey(),
                              $this->getOauthConsumerKey(),
                              $this->getOauthConsumerSecret(),
                              $this->getOauthUrl(),
                              $this->getSuccessUrl());

            // Are they connected to QuickBooks right now?
            if ($IntuitAnywhere->check($this->getUsername(), $this->getTenant()) &&
                $IntuitAnywhere->test($this->getUsername(), $this->getTenant()))
            {
                // Get our OAuth credentials from the database
                $creds = $IntuitAnywhere->load($this->getUsername(), $this->getTenant());

                // Tell the framework to load some data from the OAuth store
                $IPP->authMode(QuickBooks_IPP::AUTHMODE_OAUTH, $this->getUsername(), $creds);

                // This is our current realm
                $realm = $creds['qb_realm'];

                // Load the OAuth information from the database
                if ($Context = $IPP->context())
                {
                    // checks if the date parameter exist and is YYYY-MM-DD format
                    if (!empty($date) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date))
                    {
                        $date = " WHERE TxnDate = '".$date."'";
                    }
                    else
                    {
                        $date = '';
                    }

                    // Set the IPP version to v3
                    $IPP->version(QuickBooks_IPP_IDS::VERSION_3);

                    // making the main invoice request to Quickbooks API
                    $InvoiceService = new QuickBooks_IPP_Service_Invoice();
                    $list = $InvoiceService->query($Context, $realm, 'SELECT * FROM Invoice '.$date.'STARTPOSITION '.$offset.' MAXRESULTS '.$limit);

                    $data = array();
                    foreach ($list as $key => $Invoice)
                    {
                        // retrieving custom information
                        $CustomerRef     = $this::CustomRefCleanUp($Invoice->getCustomerRef());
                        $CustomerService = new QuickBooks_IPP_Service_Customer();
                        $customer        = $CustomerService->query($Context, $realm, "SELECT * FROM Customer WHERE Id = '".$CustomerRef."' STARTPOSITION 1 MAXRESULTS 1");

                        // allocating invoice data
                        $data[$key] = array
                        (
                            'id'       => $Invoice->getDocNumber(),
                            'date'     => $Invoice->getTxnDate(),
                            'customer' => $customer[0]->getFullyQualifiedName(),
                            'amount'   => $Invoice->getTotalAmt()
                        );
                    }

                    return $data;
                }
                else
                {
                    die ('Unable to load a context...');
                }
            }
            else
            {
                die ('You are not properly connected to Quickbooks API. Please connect using Oauth.');
            }
        }
        else
        {
            die ('All API fields are not properly configurated.');
        }

    }

    private function checkRequiredFields()
    {
        // checking if all the require fields are set
        if ($this->getDSN()      && $this->getEncryptionKey() && $this->getOauthConsumerKey() && $this->getOauthConsumerSecret() &&
            $this->getOauthUrl() && $this->getSuccessUrl()    && $this->getUsername()         && $this->getTenant())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    private static function CustomRefCleanUp($string)
    {
        if (is_string($string))
        {
            return intval(str_replace(array('{', '}', '-'), '', $string));
        }
        else
        {
            return $string;
        }
    }

}