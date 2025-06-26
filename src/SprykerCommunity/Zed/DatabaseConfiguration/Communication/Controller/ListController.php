<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\DatabaseConfiguration\Communication\Controller;

use Generated\Shared\Transfer\DatabaseConfigurationTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method \SprykerCommunity\Zed\DatabaseConfiguration\Communication\DatabaseConfigurationCommunicationFactory getFactory()
 */
class ListController extends AbstractController
{
    public function indexAction(): array
    {
        $promotionDatabaseConfigurationTransfer = (new DatabaseConfigurationTransfer())->setConfigurationKey('SHOW_COMMERCE_QUEST_LOGO');
        $promotionConfig = $this->getFactory()->getDatabaseConfigurationFacade()->getDatabaseConfigurationByKey($promotionDatabaseConfigurationTransfer);

        $databaseConfigurationTable = $this->getFactory()->createDatabseConfigurationTable();

        return $this->viewResponse([
            'databaseConfigurationTable' => $databaseConfigurationTable->render(),
            'promotionConfig' => filter_var($promotionConfig->getConfigurationValue(), FILTER_VALIDATE_BOOLEAN),
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
