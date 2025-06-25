<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\DatabaseConfiguration\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method \SprykerCommunity\Zed\DatabaseConfiguration\Communication\DatabaseConfigurationCommunicationFactory getFactory()
 */
class ListController extends AbstractController
{
    public function indexAction(): array
    {
        $databseConfigurationTable = $this->getFactory()->createDatabseConfigurationTable();

        return $this->viewResponse([
            'databaseConfigurationTable' => $databseConfigurationTable->render(),
        ]);
    }

    public function tableAction(): JsonResponse
    {
        $databseConfigurationTable = $this->getFactory()->createDatabseConfigurationTable();

        return $this->jsonResponse(
            $databseConfigurationTable->fetchData(),
        );
    }
}
