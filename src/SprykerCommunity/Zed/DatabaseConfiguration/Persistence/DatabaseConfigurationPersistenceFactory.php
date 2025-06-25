<?php

namespace SprykerCommunity\Zed\DatabaseConfiguration\Persistence;

use Orm\Zed\DatabaseConfiguration\Persistence\Base\SpycDatabaseConfigurationQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class DatabaseConfigurationPersistenceFactory extends AbstractPersistenceFactory
{
    public function createDatabaseConfigurationQuery(): SpycDatabaseConfigurationQuery
    {
        return SpycDatabaseConfigurationQuery::create();
    }
}
