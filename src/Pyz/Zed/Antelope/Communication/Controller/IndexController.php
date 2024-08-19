<?php

namespace Pyz\Zed\Antelope\Communication\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
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
        $antelopeTransfer = new AntelopeTransfer();
        $antelopeTransfer->setIdAntelopeLocation(1);
        $antelopeTransfer->setColor('Red');
        $name = $request->get('name') ?: 'Oskar';
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
}
