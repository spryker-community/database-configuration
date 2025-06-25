<?php

namespace SprykerCommunity\Zed\DatabaseConfiguration;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class DatabaseConfigurationConfig extends AbstractBundleConfig
{
    public const URL_DATABSE_CONFIGURATION_BASE = '/database-configuration';

    public const URL_DATABSE_CONFIGURATION_LIST = '/database-configuration/list';

    public const URL_DATABSE_CONFIGURATION_EDIT = self::URL_DATABSE_CONFIGURATION_BASE . '/edit';

    public const REQUEST_PARAM_ID = 'id';
}
