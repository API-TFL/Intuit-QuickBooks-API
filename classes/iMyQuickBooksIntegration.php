<?php

/* displays only available public methods */

interface iMyQuickBooksIntegration
{
    public function getInvoices($date = '', $offset = 1, $limit = 10);
}