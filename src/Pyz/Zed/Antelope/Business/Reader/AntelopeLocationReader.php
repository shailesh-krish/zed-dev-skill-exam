<?php

namespace Pyz\Zed\Antelope\Business\Reader;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeLocationReader
{
    protected $trainingRepository;
    public function __construct(
        AntelopeRepositoryInterface $trainingRepository
    ) {
        $this->trainingRepository = $trainingRepository;
    }

    public function getAntelopeLocationById(
        int $idLocation
    ): ?AntelopeLocationTransfer {
        return $this->trainingRepository->getAntelopeLocationById($idLocation);
    }

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): ?AntelopeLocationTransfer {
        return $this->trainingRepository->getAntelopeLocation($antelopeLocationCriteriaTransfer);
    }

}
