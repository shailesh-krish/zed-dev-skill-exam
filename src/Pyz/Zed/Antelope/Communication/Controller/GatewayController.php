<?php

namespace Pyz\Zed\Antelope\Communication\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    public function getAntelopeAction(AntelopeCriteriaTransfer $antelopeCriteria
    ): AntelopeResponseTransfer {
        return $this->getFacade()
            ->getAntelope($antelopeCriteria);
    }

    public function getAntelopesAction(
        AntelopeCriteriaTransfer $antelopeCriteria
    ): ?AntelopeResponseTransfer {
        return $this->getFacade()
            ->getAntelopes($antelopeCriteria);
    }

}
