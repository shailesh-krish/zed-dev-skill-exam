<?php

namespace Pyz\Zed\Antelope\Business\Reader;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeItemTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeReader
{
    public function __construct(
        protected AntelopeRepositoryInterface $AntelopeRepository
    ) {
    }

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeResponseTransfer {
        $antelopeTransfer = $this->AntelopeRepository->getAntelope($antelopeCriteriaTransfer);
        $antelopeResponseTransfer = new AntelopeResponseTransfer();
        $antelopeResponseTransfer->setIsSuccessFul(false);
        if ($antelopeTransfer) {
            $antelopeResponseTransfer->setAntelope($antelopeTransfer);
            $antelopeResponseTransfer->setIsSuccessFul(true);
        }
        return $antelopeResponseTransfer;
    }

    public function getAntelopes(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): ?AntelopeResponseTransfer {
        return $this->AntelopeRepository->getAntelopes($antelopeCriteriaTransfer);
    }
}
