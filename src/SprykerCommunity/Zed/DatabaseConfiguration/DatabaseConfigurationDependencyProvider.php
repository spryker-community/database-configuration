<?php

namespace SprykerCommunity\Zed\DatabaseConfiguration;

use Orm\Zed\DatabaseConfiguration\Persistence\SpycDatabaseConfigurationQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class DatabaseConfigurationDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PROPEL_QUERY_DATABASE_CONFIGURATION = 'PROPEL_QUERY_DATABASE_CONFIGURATION';

    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addDatabaseConfigurationPropelQuery($container);

        return $container;
    }

    protected function addDatabaseConfigurationPropelQuery(Container $container): Container
    {
        $container->set(static::PROPEL_QUERY_DATABASE_CONFIGURATION, $container->factory(function () {
            return SpycDatabaseConfigurationQuery::create();
        }));

        return $container;
    }
}
