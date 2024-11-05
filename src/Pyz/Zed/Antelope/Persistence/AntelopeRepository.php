<?php

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements
    AntelopeRepositoryInterface
{
    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): ?AntelopeTransfer {
        $antelopeEntity = $this->getFactory()->createAntelopeQuery()->filterByName(
            $antelopeCriteriaTransfer->getName(),
        )->findOne();
        if (!$antelopeEntity) {
            return null;
        }
        return (new AntelopeTransfer())->fromArray($antelopeEntity->toArray(),
            true);
    }
    public function getAntelopeByLocationId(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): ?AntelopeTransfer {
        if ($antelopeCriteriaTransfer->getIdLocation()) {
            $antelopeEntity = $this->getFactory()->createAntelopeQuery()->filterByPyzAntelopeLocation(
                $antelopeCriteriaTransfer->getIdLocation(),
            )->findOne();
        }
        if (!$antelopeEntity) {
            return null;
        }
        return (new AntelopeTransfer())->fromArray($antelopeEntity->toArray(),
            true);
    }

    public function getAntelopeLocationById(int $idLocation
    ): ?AntelopeLocationTransfer {
        $antelopeLocationEntity = $this->getFactory()
            ->createAntelopeLocationQuery()->findPk($idLocation);

        if (!$antelopeLocationEntity) {
            return null;
        }
        return (new AntelopeLocationTransfer())->fromArray($antelopeLocationEntity->toArray(),
            true);
    }

    public function getAntelopeLocation(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): ?AntelopeLocationTransfer {
        $antelopeLocationEntity = $this->getFactory()
            ->createAntelopeLocationQuery()->filterByLocationName($antelopeLocationCriteriaTransfer->getLocationName())->findOne();
        if (!$antelopeLocationEntity) {
            return null;
        }
        return (new AntelopeLocationTransfer())->fromArray($antelopeLocationEntity->toArray(),
            true);
    }

    /**
     * @param AntelopeCriteriaTransfer $antelopeCriteriaTransfer
     * @return array<AntelopeTransfer>|null
     */
    public function getAntelopes(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): ?array {
        $antelopeEntities = $this->getFactory()->createAntelopeQuery()->find();
        if (!$antelopeEntities) {
            return null;
        }
        $result = [];
        foreach ($antelopeEntities as $antelopeEntity) {
            $result[] = (new AntelopeTransfer())->fromArray($antelopeEntity->toArray(),
                true);
        }
        return $result;
    }
}
