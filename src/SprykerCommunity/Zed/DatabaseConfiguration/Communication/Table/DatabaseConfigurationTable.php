<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DatabaseConfiguration\Communication\Table;

use Orm\Zed\DatabaseConfiguration\Persistence\Map\SpycDatabaseConfigurationTableMap;
use Orm\Zed\DatabaseConfiguration\Persistence\SpycDatabaseConfigurationQuery;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use SprykerCommunity\Zed\DatabaseConfiguration\DatabaseConfigurationConfig;

class DatabaseConfigurationTable extends AbstractTable
{
    protected const COL_ACTIONS = 'actions';

    public function __construct(
        protected SpycDatabaseConfigurationQuery $databaseConfigurationQuery,
    ) {
    }

    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            SpycDatabaseConfigurationTableMap::COL_ID_CONFIGURATION => 'Id',
            SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_KEY => 'Key',
            SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_VALUE => 'Value',
            SpycDatabaseConfigurationTableMap::COL_CREATED_AT => 'Created at',
            SpycDatabaseConfigurationTableMap::COL_UPDATED_AT => 'Updated at',
            static::COL_ACTIONS => 'Action',
        ]);

        $config->setRawColumns([
            static::COL_ACTIONS,
            SpycDatabaseConfigurationTableMap::COL_ID_CONFIGURATION,
            SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_KEY,
            SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_VALUE,
            SpycDatabaseConfigurationTableMap::COL_CREATED_AT,
            SpycDatabaseConfigurationTableMap::COL_UPDATED_AT,
        ]);

        $config->setSortable([
            SpycDatabaseConfigurationTableMap::COL_ID_CONFIGURATION,
            SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_KEY,
            SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_VALUE,
            SpycDatabaseConfigurationTableMap::COL_CREATED_AT,
            SpycDatabaseConfigurationTableMap::COL_UPDATED_AT,
        ]);

        $config->setDefaultSortField(SpycDatabaseConfigurationTableMap::COL_ID_CONFIGURATION);

        $config->setSearchable([
            SpycDatabaseConfigurationTableMap::COL_ID_CONFIGURATION,
            SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_KEY,
            SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_VALUE,
        ]);

        return $config;
    }

    protected function prepareData(TableConfiguration $config): array
    {
        $queryResult = $this->runQuery($this->databaseConfigurationQuery, $config);

        $results = [];
        foreach ($queryResult as $resultItem) {
            $results[] = [
                SpycDatabaseConfigurationTableMap::COL_ID_CONFIGURATION =>
                    $resultItem[SpycDatabaseConfigurationTableMap::COL_ID_CONFIGURATION],
                SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_KEY =>
                    $resultItem[SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_KEY],
                SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_VALUE =>
                    $resultItem[SpycDatabaseConfigurationTableMap::COL_CONFIGURATION_VALUE],
                SpycDatabaseConfigurationTableMap::COL_CREATED_AT =>
                    $resultItem[SpycDatabaseConfigurationTableMap::COL_CREATED_AT],
                SpycDatabaseConfigurationTableMap::COL_UPDATED_AT =>
                    $resultItem[SpycDatabaseConfigurationTableMap::COL_UPDATED_AT],
                static::COL_ACTIONS => $this->buildLinks($resultItem),
            ];
        }

        return $results;
    }

    protected function buildLinks(array $item): string
    {
        return $this->generateEditButton(
            Url::generate(DatabaseConfigurationConfig::URL_DATABSE_CONFIGURATION_EDIT, [
                DatabaseConfigurationConfig::REQUEST_PARAM_ID =>
                    $item[SpycDatabaseConfigurationTableMap::COL_ID_CONFIGURATION],
            ])->build(),
            'Edit',
        );
    }
}
