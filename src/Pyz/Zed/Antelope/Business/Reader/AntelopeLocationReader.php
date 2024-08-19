<?php

namespace Pyz\Zed\Antelope\Business\Reader;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeLocationReader
{
    public function __construct(
        protected AntelopeRepositoryInterface $trainingRepository
    ) {
    }

    public function getAntelopeLocationById(
        int $idLocation
    ): ?AntelopeLocationTransfer {
        return $this->trainingRepository->getAntelopeLocationById($idLocation);
    }
}
