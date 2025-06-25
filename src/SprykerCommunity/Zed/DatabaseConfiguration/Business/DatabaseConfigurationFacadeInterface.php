<?php

namespace SprykerCommunity\Zed\DatabaseConfiguration\Business;

use Generated\Shared\Transfer\DatabaseConfigurationCollectionTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCriteriaTransfer;

interface DatabaseConfigurationFacadeInterface
{
    public function getDatabaseConfigurationCollection(DatabaseConfigurationCriteriaTransfer $databaseConfigurationCriteriaTransfer): DatabaseConfigurationCollectionTransfer;
}
