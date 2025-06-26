<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DatabaseConfiguration\Business;

use Generated\Shared\Transfer\DatabaseConfigurationCollectionResponseTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCollectionTransfer;
use Generated\Shared\Transfer\DatabaseConfigurationCriteriaTransfer;
use phpDocumentor\Reflection\Types\This;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerCommunity\Zed\DatabaseConfiguration\Persistence\DatabaseConfigurationRepository getRepository()
 * @method \SprykerCommunity\Zed\DatabaseConfiguration\Persistence\DatabaseConfigurationEntityManagerInterface getEntityManager()()
 */
class DatabaseConfigurationFacade extends AbstractFacade implements DatabaseConfigurationFacadeInterface
{
    public function getDatabaseConfigurationCollection(
        DatabaseConfigurationCriteriaTransfer $databaseConfigurationCriteriaTransfer,
    ): DatabaseConfigurationCollectionTransfer {
        return $this->getRepository()->getDatabaseConfigurationCollection($databaseConfigurationCriteriaTransfer);
    }

    public function updateDatabaseConfigurationCollection(
        DatabaseConfigurationCollectionTransfer $databaseConfigurationCollectionTransfer,
    ): DatabaseConfigurationCollectionResponseTransfer {
        return $this->getEntityManager()->updateDatabaseConfigurationCollection($databaseConfigurationCollectionTransfer);
    }
}
