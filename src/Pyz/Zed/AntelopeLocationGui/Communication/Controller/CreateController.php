<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

/**
 * @method \Pyz\Zed\AntelopeLocationGui\Communication\AntelopeLocationGuiCommunicationFactory getFactory()
 */
class CreateController extends AbstractController
{
    protected const URL_ANTELOPE_LOCATION_OVERVIEW = '/antelope-location-gui/index';
    protected const MESSAGE_SUCCESS = 'Antelope location created successfully.';
    protected const MESSAGE_ERROR = 'There was an error creating the antelope location. Please check your input and try again.';
    protected const MESSAGE_EXCEPTION_ERROR = 'An unexpected error occurred.';

    public function indexAction(Request $request): array|RedirectResponse
    {
        $form = $this->getFactory()
            ->createAntelopeLocationForm(new AntelopeLocationTransfer())
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->handleFormSubmission($form);
        }

        return $this->viewResponse([
            'form' => $form->createView(),
            'backUrl' => $this->getAntelopeOverviewUrl(),
        ]);
    }

    protected function handleFormSubmission(FormInterface $form
    ): RedirectResponse {
        try {
            $antelopeLocationTransfer = $form->getData();
            $this->getFactory()->getAntelopeFacade()->createAntelopeLocation($antelopeLocationTransfer);
            $this->addSuccessMessage(self::MESSAGE_SUCCESS);
        } catch (Throwable $exception) {
            $this->addErrorMessage(self::MESSAGE_EXCEPTION_ERROR);
        }

        return $this->redirectResponse(self::URL_ANTELOPE_LOCATION_OVERVIEW);
    }


    protected function getAntelopeOverviewUrl(): string
    {
        return (string)Url::generate(self::URL_ANTELOPE_LOCATION_OVERVIEW);
    }
}
