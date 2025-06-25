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
        $apiKeyTable = $this->getFactory()->createDatabseConfigurationTable();

        return $this->viewResponse([
            'databaseConfigurationTable' => $apiKeyTable->render(),
        ]);
    }

    public function tableAction(): JsonResponse
    {
        $apiKeyTable = $this->getFactory()->createDatabseConfigurationTable();

        return $this->jsonResponse(
            $apiKeyTable->fetchData(),
        );
    }
}
