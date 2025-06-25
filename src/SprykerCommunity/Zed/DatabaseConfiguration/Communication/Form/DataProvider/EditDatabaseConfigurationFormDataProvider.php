<?php

namespace SprykerCommunity\Zed\DatabaseConfiguration\Communication\Form\DataProvider;

use Generated\Shared\Transfer\DatabaseConfigurationConditionsTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCriteriaTransfer;
use SprykerCommunity\Zed\DatabaseConfiguration\Business\DatabaseConfigurationFacadeInterface;

class EditDatabaseConfigurationFormDataProvider
{
    public function __construct(
        protected DatabaseConfigurationFacadeInterface $databaseConfigurationFacade,
    ) {
    }

    /**
     * @param int $iDatabaseConfiguration
     *
     * @return array<int>|null
     */
    public function getData(int $iDatabaseConfiguration): ?array
    {
        $databaseConfigurationCriteriaTransfer = (new DatabaseConfigurationCriteriaTransfer())
            ->setDatabaseConfigurationConditions(
                (new DatabaseConfigurationConditionsTransfer())
                    ->addIdDatabaseConfiguration($iDatabaseConfiguration),
            );

        $databaseConfigurationCollectionTransfer = $this->databaseConfigurationFacade->getDatabaseConfigurationCollection($databaseConfigurationCriteriaTransfer);

        if ($databaseConfigurationCollectionTransfer->getDatabaseConfigurations()->count() === 0) {
            return null;
        }

        return $databaseConfigurationCollectionTransfer->getDatabaseConfigurations()->offsetGet(0)?->toArray();
    }
}
