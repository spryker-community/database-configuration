<?php

namespace SprykerCommunity\Zed\DatabaseConfiguration\Persistence;

use Generated\Shared\Transfer\DatabaseConfigurationCollectionResponseTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCollectionTransfer;
use Generated\Shared\Transfer\ErrorTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \SprykerCommunity\Zed\DatabaseConfiguration\Persistence\DatabaseConfigurationPersistenceFactory getFactory()
 */
class DatabaseConfigurationEntityManager extends AbstractEntityManager implements DatabaseConfigurationEntityManagerInterface
{

    public function updateDatabaseConfigurationCollection(DatabaseConfigurationCollectionTransfer $databaseConfigurationCollectionTransfer,): DatabaseConfigurationCollectionResponseTransfer
    {
        $databaseConfigurationQuery = $this->getFactory()->createDatabaseConfigurationQuery();
        $databaseConfigurationCollectionResponseTransfer = new DatabaseConfigurationCollectionResponseTransfer();

        foreach ($databaseConfigurationCollectionTransfer->getDatabaseConfigurations() as $databaseConfiguration) {
            $databaseConfigurationEntity = $databaseConfigurationQuery->findOneByIdConfiguration($databaseConfiguration->getIdDatabaseConfiguration());

            if (!$databaseConfigurationEntity)
            {
                $errorTransfer = (new ErrorTransfer())
                    ->setMessage('Database configuration not found');
                $databaseConfigurationCollectionResponseTransfer->addError($errorTransfer);

                continue;
            }

            $databaseConfigurationEntity->setConfigurationValue($databaseConfiguration->getConfigurationValue());
            $databaseConfigurationEntity->save();

            $databaseConfigurationCollectionResponseTransfer->addDatabaseConfiguration($databaseConfiguration);

            return $databaseConfigurationCollectionResponseTransfer;
        }
    }
}
