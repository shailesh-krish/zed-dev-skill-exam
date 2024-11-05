<?php

namespace Pyz\Zed\Antelope\Business\Writer;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;


class AntelopeWriter
{
    protected $entityManager;
    public function __construct(
        AntelopeEntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        return $this->entityManager->createAntelope($antelopeTransfer);
    }
}
