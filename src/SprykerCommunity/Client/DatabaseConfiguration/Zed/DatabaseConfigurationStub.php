<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\DatabaseConfiguration\Zed;

use Generated\Shared\Transfer\DatabaseConfigurationTransfer;
use Spryker\Client\ZedRequest\Stub\ZedRequestStub;

class DatabaseConfigurationStub extends ZedRequestStub implements DatabaseConfigurationStubInterface
{
    public function getDatabaseConfiguration(DatabaseConfigurationTransfer $databaseConfigurationTransfer): DatabaseConfigurationTransfer
    {
        return $this->zedStub->call('/database-configuration/gateway/get-database-configuration', $databaseConfigurationTransfer);
    }
}
