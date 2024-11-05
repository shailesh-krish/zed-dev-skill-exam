<?php

namespace Pyz\Zed\Antelope\Business;

use Pyz\Zed\Antelope\Business\Writer\AntelopeLocationWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class TrainingBusinessFactory extends AbstractBusinessFactory
{
    public function createAntelopeWriter()
    {
        return new AntelopeLocationWriter($this->getEntityManager());
    }
}
