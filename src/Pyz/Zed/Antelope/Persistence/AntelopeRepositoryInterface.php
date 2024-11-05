<?php

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;


use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
interface AntelopeRepositoryInterface
{
    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): ?AntelopeTransfer;
    public function getAntelopeByLocationId(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): ?AntelopeTransfer;
    public function getAntelopeLocationById(int $idLocation
    ): ?AntelopeLocationTransfer;
    public function getAntelopeLocation(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer): ?AntelopeLocationTransfer;
}
