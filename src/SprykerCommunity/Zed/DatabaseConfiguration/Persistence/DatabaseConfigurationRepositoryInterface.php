<?php

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DatabaseConfiguration\Persistence;

use Generated\Shared\Transfer\DatabaseConfigurationCollectionTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCriteriaTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationTransfer;

interface DatabaseConfigurationRepositoryInterface
{
    public function getDatabaseConfigurationCollection(
        DatabaseConfigurationCriteriaTransfer $databaseConfigurationCriteriaTransfer,
    ): DatabaseConfigurationCollectionTransfer;

    public function getDatabaseConfigurationByKey(DatabaseConfigurationTransfer $databaseConfigurationTransfer): DatabaseConfigurationTransfer;
}
