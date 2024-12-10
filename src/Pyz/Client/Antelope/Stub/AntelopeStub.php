<?php

namespace Pyz\Client\Antelope\Stub;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeItemTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class AntelopeStub
{
    public function __construct(
        protected ZedRequestClientInterface $zedRequestClient
    ) {
    }

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeResponseTransfer {
        /**
         * @var AntelopeResponseTransfer $antelopeTransfer
         */
        return $this->zedRequestClient->call('/antelope/gateway/get-antelope',
            $antelopeCriteriaTransfer);
    }
    public function getAntelopes(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): ?AntelopeResponseTransfer {
        return $this->zedRequestClient->call('/antelope/gateway/get-antelopes',
            $antelopeCriteriaTransfer);
    }
}
