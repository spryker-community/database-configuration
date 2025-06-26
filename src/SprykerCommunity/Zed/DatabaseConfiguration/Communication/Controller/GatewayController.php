<?php

namespace SprykerCommunity\Zed\DatabaseConfiguration\Communication\Controller;

use Generated\Shared\Transfer\DatabaseConfigurationTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \SprykerCommunity\Zed\DatabaseConfiguration\Business\DatabaseConfigurationFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    public function getDatabaseConfigurationAction(DatabaseConfigurationTransfer $databaseConfigurationTransfer): DatabaseConfigurationTransfer
    {
        return $this->getFacade()->getDatabaseConfigurationByKey($databaseConfigurationKey);
    }
}
