<?php

abstract class SettersGetters
{

    private $dsn;
    private $encryption_key;
    private $oauth_consumer_key;
    private $oauth_consumer_secret;
    private $oauth_url;
    private $success_url;
    private $username;
    private $tenant;

    protected function setDSN($dsn)
    {
        $this->dsn = $dsn;
    }

    protected function getDSN()
    {
        return !empty($this->dsn) ? $this->dsn : false;
    }

    protected function setEncryptionKey($encryption_key)
    {
        $this->encryption_key = $encryption_key;
    }

    protected function getEncryptionKey()
    {
        return !empty($this->encryption_key) ? $this->encryption_key : false;
    }

    protected function setOauthConsumerKey($oauth_consumer_key)
    {
        $this->oauth_consumer_key = $oauth_consumer_key;
    }

    protected function getOauthConsumerKey()
    {
        return !empty($this->oauth_consumer_key) ? $this->oauth_consumer_key : false;
    }

    protected function setOauthConsumerSecret($oauth_consumer_secret)
    {
        $this->oauth_consumer_secret = $oauth_consumer_secret;
    }

    protected function getOauthConsumerSecret()
    {
        return !empty($this->oauth_consumer_secret) ? $this->oauth_consumer_secret : false;
    }

    protected function setOauthUrl($quickbooks_oauth_url)
    {
        $this->oauth_url = $quickbooks_oauth_url;
    }

    protected function getOauthUrl()
    {
        return !empty($this->oauth_url) ? $this->oauth_url : false;
    }

    protected function setSuccessUrl($quickbooks_success_url)
    {
        $this->success_url = $quickbooks_success_url;
    }

    protected function getSuccessUrl()
    {
        return !empty($this->success_url) ? $this->success_url : false;
    }

    protected function setUsername($username)
    {
        $this->username = $username;
    }

    protected function getUsername()
    {
        return !empty($this->username) ? $this->username : false;
    }

    protected function setTenant($tenant)
    {
        $this->tenant = $tenant;
    }

    protected function getTenant()
    {
        return !empty($this->tenant) ? $this->tenant : false;
    }
}