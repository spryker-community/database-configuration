<?php

namespace SprykerCommunity\Zed\DatabaseConfiguration\Persistence;

use Generated\Shared\Transfer\ApiKeyCollectionTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCollectionTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCriteriaTransfer;
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
            $databaseConfigurationQuery = $this->applyApiKeyConditions($apiKeyQuery, $apiKeyCriteriaTransfer->getApiKeyConditionsOrFail());
        }

        $apiKeysCollection = $apiKeyQuery->find();

        $apiKeyCollectionTransfer = new ApiKeyCollectionTransfer();

        if ($apiKeysCollection->getData() === []) {
            return $apiKeyCollectionTransfer;
        }

        return $this->getFactory()
            ->createApiKeyMapper()
            ->mapApiKeyEntityCollectionToApiKeyCollectionTransfer($apiKeysCollection, $apiKeyCollectionTransfer);
    }
}
