<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\DatabaseConfiguration\Zed;

use Generated\Shared\Transfer\DatabaseConfigurationTransfer;

interface DatabaseConfigurationStubInterface
{
    public function getDatabaseConfiguration(DatabaseConfigurationTransfer $databaseConfigurationTransfer): DatabaseConfigurationTransfer;
}
