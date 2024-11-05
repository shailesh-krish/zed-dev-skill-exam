<?php

namespace Pyz\Zed\Antelope\Communication\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface getFacade()
 */
class IndexController extends AbstractController
{
    /**
     * @return array<string, mixed>
     */
    public function addAction(Request $request): array
    {
        $antelopeLocationResponse = new AntelopeLocationResponseTransfer();
        $antelopLocationTransfer = new AntelopeLocationTransfer();
        $antelopeLocationCriteria = new AntelopeLocationCriteriaTransfer();
        $antelopLocationTransfer->setLocationName('New York');
        $antelopeLocationResponse = $this->getFacade()
            ->getAntelopeLocation($antelopeLocationCriteria->setLocationName($antelopLocationTransfer->getLocationName()));
        if (!$antelopeLocationResponse) {
           $antelopeLocationResponse =  $this->getFacade()->createAntelopeLocation($antelopLocationTransfer);
        }
        $antelopeTransfer = new AntelopeTransfer();
        $antelopeTransfer->setIdLocation($antelopeLocationResponse->getIdAntelopeLocation());
        $antelopeTransfer->setColor('Red');
        $name = $request->get('name') ?: 'One';
        $antelopeTransfer->setName($name);

        $antelopeResponseTransfer = $this->getFacade()
            ->getAntelope((new AntelopeCriteriaTransfer())->setName($antelopeTransfer->getName()));

        if (!$antelopeResponseTransfer->getAntelope()) {
            $antelopeTransfer = $this->getFacade()
                ->createAntelope($antelopeTransfer);
        }

        return $this->viewResponse([
            'antelope' => $antelopeTransfer,
        ]);
    }

    public function indexAction(Request $request): array
    {
        $antelopes = $this->getFacade()
            ->getAntelopes((new AntelopeCriteriaTransfer()));


        return $this->viewResponse([
            'antelopes' => $antelopes,
        ]);
    }

}
