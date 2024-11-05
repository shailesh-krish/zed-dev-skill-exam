<?php

namespace Pyz\Zed\Antelope\Business\Writer;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

class AntelopeLocationWriter
{
    protected $entityManager;
    public function __construct(AntelopeEntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer
    ): ?AntelopeLocationTransfer {
        return $this->entityManager->createAntelopeLocation($antelopeLocationTransfer);
    }
}
