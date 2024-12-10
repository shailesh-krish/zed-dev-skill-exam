<?php

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
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
     * @return array<AntelopeResponseTransfer>|null
     */
    public function getAntelopes(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): ?AntelopeResponseTransfer {

        $antelopeEntities = $this->getFactory()->createAntelopeQuery();
        $antelopeEntities->innerJoinWithPyzAntelopeLocation();
        $antelopeEntities->find();
        $locationTransfer = new AntelopeLocationTransfer();
        $locationCriteria = new AntelopeLocationCriteriaTransfer();
        if (!$antelopeEntities) {
            return null;
        }
        /** @var AntelopeResponseTransfer $antelopItem */
        $antelopItem = new AntelopeResponseTransfer();
        foreach ($antelopeEntities as $antelopeEntity) {
            $anvelope = (new AntelopeTransfer())->fromArray($antelopeEntity->toArray(),
                true);
//            $locationTransfer->fromArray($antelopeEntity->toArray(), true);

            $locationTransfer = $this->getAntelopeLocationById($anvelope->getIdLocation());
            $anvelope->setLocation($locationTransfer->getLocationName());
            $antelopItem->addItem($anvelope);
        }
        return $antelopItem;
    }

    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer {
        $antelopeEntities = $this->getFactory()->createAntelopeQuery();
        $antelopeEntities->joinWithPyzAntelopeLocation()
            ->joinWithPyzAntelopeType();
        $antelopeCollectionTransfer = new AntelopeCollectionTransfer();
        $paginationTransfer = $antelopeCriteriaTransfer->getPagination();
        $this->applySearch($antelopeEntities, $antelopeCriteriaTransfer);
        $this->applySorting($antelopeEntities, $antelopeCriteriaTransfer);
        if ($paginationTransfer) {
            $this->applyPagination($paginationTransfer, $antelopeEntities);
        }
        $antelopeCollectionTransfer->setPagination($paginationTransfer);

        $antelopeCollection = $antelopeEntities->find();

        return $this->getFactory()->createAntelopeMapper()
            ->mapAntelopeCollectionToAntelopeCollectionTransfer(
                $antelopeCollection,
                $antelopeCollectionTransfer,
        );
    }
    protected function applySorting(
        PyzAntelopeQuery $antelopeEntities,
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
    ): void {
        foreach ($antelopeCriteriaTransfer->getSortCollection() as $sortTransfer) {
            $columnName = $sortTransfer->getField();
            $order = $sortTransfer->getIsAscending() ? CriteriaAlias::ASC : CriteriaAlias::DESC;
            $antelopeEntities->orderBy($columnName, $order);
        }
    }
    /**
     * @return void
     */
    private function applySearch(
        PyzAntelopeQuery $antelopeEntities,
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
        ): void {
        $antelopeConditions = $antelopeCriteriaTransfer->getAntelopeConditions();
        if (!$antelopeConditions) {
            return;
        }
        if ($idAntelope = $antelopeConditions->getIdAntelope()) {
            $antelopeEntities->_or()->filterByIdantelope($idAntelope);
        }
        if ($name = $antelopeConditions->getName()) {
            $likePattern = "%$name%";
            $antelopeEntities->_or()->filterByName_Like($likePattern);
        }
        if ($antelopeIds = $antelopeConditions->getAntelopeIds()) {
            $antelopeEntities->_or()->filterByIdantelope_In($antelopeIds);
        }
        if ($idLocation = $antelopeConditions->getLocationId()) {
            $antelopeEntities->_or()->filterByLocationId($idLocation);
        }
        if ($idType = $antelopeConditions->getTypeId()) {
            $antelopeEntities->_or()->filterByTypeId($idType);
        }
    }

    /**
     * @return void
     */
    private function applyPagination(
        PaginationTransfer $paginationTransfer,
        PyzAntelopeQuery $antelopeEntities
    ): void {
        if ($paginationTransfer->getOffset() !== null && $paginationTransfer->getLimit() > 0) {
            $paginationTransfer->setNbResults($antelopeEntities->count());
            $antelopeEntities->setOffset(+$paginationTransfer->getOffset());
            $antelopeEntities->setLimit(+$paginationTransfer->getLimit());

            return;
        }
        if ($paginationTransfer->getPage() !== null && $paginationTransfer->getMaxPerPage()) {
            $pager = $antelopeEntities->paginate(
                $paginationTransfer->getPage(),
                $paginationTransfer->getMaxPerPage(),
                        );
            $paginationTransfer->setNbResults($pager->getNbResults())
                ->setFirstIndex($pager->getFirstIndex())
                ->setLastIndex($pager->getLastIndex())
                ->setNextPage($pager->getNextPage())
                ->setPreviousPage($pager->getPreviousPage())
                ->setFirstPage($pager->getFirstPage())
                ->setLastPage($pager->getLastPage());
        }
    }
}
