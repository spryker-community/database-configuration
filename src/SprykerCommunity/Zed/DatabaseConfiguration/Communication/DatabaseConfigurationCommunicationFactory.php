<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DatabaseConfiguration\Communication;

use Orm\Zed\DatabaseConfiguration\Persistence\SpycDatabaseConfigurationQuery;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerCommunity\Zed\DatabaseConfiguration\Business\DatabaseConfigurationFacadeInterface;
use SprykerCommunity\Zed\DatabaseConfiguration\Communication\Form\DataProvider\EditDatabaseConfigurationFormDataProvider;
use SprykerCommunity\Zed\DatabaseConfiguration\Communication\Form\EditDatabaseConfigurationForm;
use SprykerCommunity\Zed\DatabaseConfiguration\Communication\Table\DatabaseConfigurationTable;
use SprykerCommunity\Zed\DatabaseConfiguration\DatabaseConfigurationDependencyProvider;
use Symfony\Component\Form\FormInterface;

/**
 * @method \SprykerCommunity\Zed\DatabaseConfiguration\Business\DatabaseConfigurationFacadeInterface getFacade()
 */
class DatabaseConfigurationCommunicationFactory extends AbstractCommunicationFactory
{
    public function createDatabseConfigurationTable(): DatabaseConfigurationTable
    {
        return new DatabaseConfigurationTable(
            $this->getDatabaseConfigurationPropelQuery(),
        );
    }

    public function createEditDatabaseConfigurationFormDataProvider(): EditDatabaseConfigurationFormDataProvider
    {
        return new EditDatabaseConfigurationFormDataProvider(
            $this->getFacade(),
        );
    }

    public function getEditDatabaseConfigurationForm(array $databaseConfigurationData): FormInterface
    {
        return $this->getFormFactory()->create(EditDatabaseConfigurationForm::class, $databaseConfigurationData);
    }

    public function getDatabaseConfigurationPropelQuery(): SpycDatabaseConfigurationQuery
    {
        return $this->getProvidedDependency(DatabaseConfigurationDependencyProvider::PROPEL_QUERY_DATABASE_CONFIGURATION);
    }

    public function getDatabaseConfigurationFacade(): DatabaseConfigurationFacadeInterface
    {
        return $this->getFacade();
    }

    protected function getFormFactory()
    {
        $container = $this->createContainerWithProvidedDependencies();

        return $container->get(static::FORM_FACTORY);
    }
}
