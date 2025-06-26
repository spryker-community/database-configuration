<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DatabaseConfiguration\Persistence;

use Generated\Shared\Transfer\DatabaseConfigurationCollectionTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationConditionsTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCriteriaTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationTransfer;
use Orm\Zed\DatabaseConfiguration\Persistence\Base\SpycDatabaseConfigurationQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerCommunity\Zed\DatabaseConfiguration\Persistence\DatabaseConfigurationPersistenceFactory getFactory()
 */
class DatabaseConfigurationRepository extends AbstractRepository implements DatabaseConfigurationRepositoryInterface
{
    public function getDatabaseConfigurationCollection(
        DatabaseConfigurationCriteriaTransfer $databaseConfigurationCriteriaTransfer,
    ): DatabaseConfigurationCollectionTransfer {
        $databaseConfigurationQuery = $this->getFactory()->createDatabaseConfigurationQuery();

        if ($databaseConfigurationCriteriaTransfer->getDatabaseConfigurationConditions() !== null) {
            $databaseConfigurationQuery = $this->applyApiKeyConditions($databaseConfigurationQuery, $databaseConfigurationCriteriaTransfer->getDatabaseConfigurationConditions());
        }

        $databaseConfigurationsCollection = $databaseConfigurationQuery->find();

        $databaseConfigurationCollectionTransfer = new DatabaseConfigurationCollectionTransfer();

        if ($databaseConfigurationsCollection->getData() === []) {
            return $databaseConfigurationCollectionTransfer;
        }

        foreach ($databaseConfigurationsCollection as $item) {
            $databaseConfigurationTransfer = (new DatabaseConfigurationTransfer())->fromArray($item->toArray(), true);

            $databaseConfigurationCollectionTransfer->addDatabaseConfiguration($databaseConfigurationTransfer);
        }

        return $databaseConfigurationCollectionTransfer;
    }

    public function getDatabaseConfigurationByKey(DatabaseConfigurationTransfer $databaseConfigurationTransfer): DatabaseConfigurationTransfer
    {
        $databaseConfigurationQuery = $this->getFactory()->createDatabaseConfigurationQuery();
        $databaseConfigurationEntity = $databaseConfigurationQuery->findOneByConfigurationKey($databaseConfigurationTransfer->getConfigurationKey());

        if ($databaseConfigurationEntity) {
            $databaseConfigurationTransfer->fromArray($databaseConfigurationEntity->toArray(), true);
        }

        return $databaseConfigurationTransfer;
    }

    protected function applyApiKeyConditions(
        SpycDatabaseConfigurationQuery $databaseConfigurationQuery,
        DatabaseConfigurationConditionsTransfer $databaseConfigurationConditionsTransfer,
    ): SpycDatabaseConfigurationQuery {
        if ($databaseConfigurationConditionsTransfer->getDatabaseConfigurationIds() !== []) {
            $databaseConfigurationQuery = $databaseConfigurationQuery->filterByIdConfiguration_In(
                $databaseConfigurationConditionsTransfer->getDatabaseConfigurationIds(),
            );
        }

        return $databaseConfigurationQuery;
    }
}
