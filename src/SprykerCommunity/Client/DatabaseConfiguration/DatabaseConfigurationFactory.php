<?php

declare(strict_types = 1);

namespace SprykerCommunity\Client\DatabaseConfiguration;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use SprykerCommunity\Client\DatabaseConfiguration\Zed\DatabaseConfigurationStub;

class DatabaseConfigurationFactory extends AbstractFactory
{
    public function createZedStub(): DatabaseConfigurationStub
    {
        return new DatabaseConfigurationStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(DatabaseConfigurationDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
