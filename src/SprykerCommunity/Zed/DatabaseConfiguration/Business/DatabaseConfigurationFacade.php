<?php

namespace SprykerCommunity\Zed\DatabaseConfiguration\Business;

use Generated\Shared\Transfer\DatabaseConfigurationCollectionTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCriteriaTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerCommunity\Zed\DatabaseConfiguration\Persistence\DatabaseConfigurationRepository getRepository()
 */
class DatabaseConfigurationFacade extends AbstractFacade implements DatabaseConfigurationFacadeInterface
{
    public function getDatabaseConfigurationCollection(DatabaseConfigurationCriteriaTransfer $databaseConfigurationCriteriaTransfer): DatabaseConfigurationCollectionTransfer
    {
        return $this->getRepository()->getDatabaseConfigurationCollection($databaseConfigurationCriteriaTransfer);
    }
}
