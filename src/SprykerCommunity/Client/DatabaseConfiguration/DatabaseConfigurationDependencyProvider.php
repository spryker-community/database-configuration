<?php

namespace SprykerCommunity\Client\DatabaseConfiguration;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class DatabaseConfigurationDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ZED_REQUEST = 'zed request client';

    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = $this->addZedRequestClient($container);

        return $container;
    }

    protected function addZedRequestClient(Container $container): Container
    {
        $container->set(static::CLIENT_ZED_REQUEST, function (Container $container) {
            return $container->getLocator()->zedRequest()->client();
        });

        return $container;
    }
}
