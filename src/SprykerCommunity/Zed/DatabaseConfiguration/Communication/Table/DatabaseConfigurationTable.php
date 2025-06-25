<?php

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DatabaseConfiguration\Communication\Table;

use Orm\Zed\DatabaseConfiguration\Persistence\Map\SpycDatabaseConfigurationTableMap;
use Orm\Zed\DatabaseConfiguration\Persistence\SpycDatabaseConfigurationQuery;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class DatabaseConfigurationTable extends AbstractTable
{
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
        ]);

        $config->setRawColumns([
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
            ];
        }

        return $results;
    }
}
