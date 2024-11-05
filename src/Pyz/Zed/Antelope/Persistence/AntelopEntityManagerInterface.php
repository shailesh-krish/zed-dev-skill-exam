<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer);
    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer);
    public function deleteAntelope(AntelopeTransfer $antelopeTransfer);
}
