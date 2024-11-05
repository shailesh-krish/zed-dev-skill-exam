<?php

namespace Pyz\Zed\Antelope\Business;


use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

/**
 * @method  \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 */
interface AntelopeFacadeInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer;

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer;

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeResponseTransfer;

    public function getAntelopeLocationById(
        int $idLocation
    ): ?AntelopeLocationTransfer;

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): ?AntelopeLocationTransfer;

    public function getAntelopes(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): ?array;
}
