<?php

declare(strict_types = 1);

namespace Pyz\Zed\AntelopeLocationGui;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use Pyz\Shared\AntelopeLocationGui\AntelopeLocationGuiConstants;

class AntelopeLocationGuiConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getExampleQueueChunkSize(): int
    {
        return $this->get(AntelopeLocationGuiConstants::EXAMPLE_QUEUE_CHUNK_SIZE, 500);
    }
}
