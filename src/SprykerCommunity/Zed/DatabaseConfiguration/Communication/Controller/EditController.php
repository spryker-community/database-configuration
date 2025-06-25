<?php

namespace SprykerCommunity\Zed\DatabaseConfiguration\Communication\Controller;

use Generated\Shared\Transfer\ApiKeyCollectionRequestTransfer;
use Generated\Shared\Transfer\ApiKeyTransfer;
use Spryker\Zed\ApiKeyGui\ApiKeyGuiConfig;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use SprykerCommunity\Zed\DatabaseConfiguration\DatabaseConfigurationConfig;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerCommunity\Zed\DatabaseConfiguration\Communication\DatabaseConfigurationCommunicationFactory getFactory()
 */
class EditController extends AbstractController
{
    /**
     * @var string
     */
    protected const REQUEST_ID_DATABASE_CONFIGURATION = 'id';

    /**
     * @var string
     */
    protected const ID_DATABASE_CONFIGURATION = 'id_database_configuration';

    /**
     * @var string
     */
    protected const KEY_FORM = 'form';

    /**
     * @var string
     */
    protected const MESSAGE_ERROR_DATABASE_CONFIGURATION_DOES_NOT_EXIST = 'Database configuration with ID `%d` does not exist.';

    /**
     * @var string
     */
    protected const MESSAGE_ID_PLACEHOLDER = '%d';

    /**
     * @var string
     */
    protected const MESSAGE_KEY_PLACEHOLDER = '%s';

    /**
     * @var string
     */
    protected const MESSAGE_DATABASE_CONFIGURATION_UPDATED = 'Database configuration updated successfully. ';

    /**
     * @var string
     */
    protected const FIELD_NAME = 'name';

    /**
     * @var string
     */
    protected const FIELD_VALID_TO = 'valid_to';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array<mixed>
     */
    public function indexAction(Request $request)
    {
        $idDatabaseConfiguration = $request->get(static::REQUEST_ID_DATABASE_CONFIGURATION);

        $databaseConfigurationData = $this->getFactory()->createEditDatabaseConfigurationFormDataProvider()
            ->getData($idDatabaseConfiguration);

        if ($databaseConfigurationData === null) {
            $this->addErrorMessage(static::MESSAGE_ERROR_DATABASE_CONFIGURATION_DOES_NOT_EXIST, [
                static::MESSAGE_ID_PLACEHOLDER => $idDatabaseConfiguration,
            ]);

            return $this->redirectResponse(DatabaseConfigurationConfig::URL_DATABSE_CONFIGURATION_LIST);
        }

        $editDatabaseConfigurationForm = $this->getFactory()
            ->getEditDatabaseConfigurationForm($databaseConfigurationData)
            ->handleRequest($request);

        if ($editDatabaseConfigurationForm->isSubmitted() && $editDatabaseConfigurationForm->isValid()) {
            return $this->updateApiKey($editDatabaseConfigurationForm);
        }

        return $this->viewResponse([
            static::KEY_FORM => $editDatabaseConfigurationForm->createView(),
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $editApiKeyForm
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array<mixed>
     */
    protected function updateApiKey(FormInterface $editApiKeyForm)
    {
        $key = $editApiKeyForm->getData()[static::FIELD_IS_KEY_NEEDS_REGENERATION] ?
            $this->getFactory()->createApiKeyGenerator()->generate() :
            null;

        $apiKeyCollectionRequestTransfer = (new ApiKeyCollectionRequestTransfer())
            ->setIsTransactional(true)
            ->addApiKey(
                (new ApiKeyTransfer())
                    ->setIdApiKey($editApiKeyForm->getData()[static::ID_API_KEY])
                    ->setName($editApiKeyForm->getData()[static::FIELD_NAME])
                    ->setValidTo($editApiKeyForm->getData()[static::FIELD_VALID_TO])
                    ->setKey($key),
            );

        $apiKeyCollectionResponseTransfer = $this->getFactory()
            ->getApiKeyFacade()
            ->updateApiKeyCollection($apiKeyCollectionRequestTransfer);

        if ($apiKeyCollectionResponseTransfer->getErrors()->count() === 0) {
            $successMessage = static::MESSAGE_API_KEY_UPDATED;
            $successMessageParameters = [];

            $apiKeyTransfer = $apiKeyCollectionResponseTransfer->getApiKeys()->offsetGet(0);

            if ($apiKeyTransfer->getKey() !== null) {
                $successMessage .= static::API_KEY_WARNING_MESSAGE;
                $successMessageParameters = [
                    static::MESSAGE_KEY_PLACEHOLDER => $apiKeyTransfer->getKeyOrFail(),
                ];
            }

            $this->addSuccessMessage($successMessage, $successMessageParameters);

            return $this->redirectResponse(ApiKeyGuiConfig::URL_API_KEY_LIST);
        }

        foreach ($apiKeyCollectionResponseTransfer->getErrors() as $errorTransfer) {
            $this->addErrorMessage($errorTransfer->getMessageOrFail(), $errorTransfer->getParameters());
        }

        return $this->viewResponse([
            static::KEY_FORM => $editApiKeyForm->createView(),
        ]);
    }
}
