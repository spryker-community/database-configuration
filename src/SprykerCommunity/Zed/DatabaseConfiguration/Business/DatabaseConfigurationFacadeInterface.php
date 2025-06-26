<?php

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DatabaseConfiguration\Business;

use Generated\Shared\Transfer\DatabaseConfigurationCollectionResponseTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCollectionTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCriteriaTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationTransfer;

interface DatabaseConfigurationFacadeInterface
{
    public function getDatabaseConfigurationCollection(
        DatabaseConfigurationCriteriaTransfer $databaseConfigurationCriteriaTransfer,
    ): DatabaseConfigurationCollectionTransfer;

    public function updateDatabaseConfigurationCollection(
        DatabaseConfigurationCollectionTransfer $databaseConfigurationCollectionTransfer,
    ): DatabaseConfigurationCollectionResponseTransfer;

    public function getDatabaseConfigurationByKey(DatabaseConfigurationTransfer $databaseConfigurationTransfer): DatabaseConfigurationTransfer;
}
