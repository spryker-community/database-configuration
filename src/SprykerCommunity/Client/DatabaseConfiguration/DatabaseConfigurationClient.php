<?php

namespace SprykerCommunity\Client\DatabaseConfiguration;

use Generated\Shared\Transfer\DatabaseConfigurationTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerCommunity\Client\DatabaseConfiguration\DatabaseConfigurationFactory getFactory()
 */
class DatabaseConfigurationClient extends AbstractClient implements DatabaseConfigurationClientInterface
{
    public function getDatabaseConfigurationByKey(DatabaseConfigurationTransfer $databaseConfigurationTransfer): DatabaseConfigurationTransfer
    {
        return $this->getFactory()->createZedStub()->getDatabaseConfiguration($databaseConfigurationTransfer);
    }
}
