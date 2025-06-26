<?php

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DatabaseConfiguration\Persistence;

use Generated\Shared\Transfer\DatabaseConfigurationCollectionResponseTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCollectionTransfer;

interface DatabaseConfigurationEntityManagerInterface
{
    public function updateDatabaseConfigurationCollection(
        DatabaseConfigurationCollectionTransfer $databaseConfigurationCollectionTransfer,
    ): DatabaseConfigurationCollectionResponseTransfer;
}
