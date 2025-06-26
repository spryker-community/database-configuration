<?php

namespace SprykerCommunity\Client\DatabaseConfiguration;

use Generated\Shared\Transfer\DatabaseConfigurationTransfer;

interface DatabaseConfigurationClientInterface
{
    public function getDatabaseConfigurationByKey(DatabaseConfigurationTransfer $databaseConfigurationTransfer): DatabaseConfigurationTransfer;
}
