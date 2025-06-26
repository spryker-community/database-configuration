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
        $databaseConfigurationTable = $this->getFactory()->createDatabseConfigurationTable();

        return $this->viewResponse([
            'databaseConfigurationTable' => $databaseConfigurationTable->render(),
        ]);
    }

    public function tableAction(): JsonResponse
    {
        $databaseConfigurationTable = $this->getFactory()->createDatabseConfigurationTable();

        return $this->jsonResponse(
            $databaseConfigurationTable->fetchData(),
        );
    }
}
