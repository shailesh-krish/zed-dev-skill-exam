<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeGui\Communication\Table;

use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Orm\Zed\AntelopeLocation\Persistence\Map\PyzAntelopeLocationTableMap;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeTable extends AbstractTable
{
    public const COL_ID_ANTELOPE = 'id_antelope';
    public const COL_NAME = 'name';
    public const COL_COLOR = 'color';
    public const COL_LOCATION_NAME = 'location_name';

    public function __construct(protected PyzAntelopeQuery $antelopeQuery)
    {
    }

    /**
     * @param TableConfiguration $config
     *
     * @return TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            PyzAntelopeTableMap::COL_ID_ANTELOPE => 'Antelope ID',
            PyzAntelopeTableMap::COL_NAME => 'Name',
            PyzAntelopeTableMap::COL_COLOR => 'Color',
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME => 'Location',
        ]);

        $config->setSortable([
            PyzAntelopeTableMap::COL_ID_ANTELOPE,
            PyzAntelopeTableMap::COL_NAME,
            PyzAntelopeTableMap::COL_COLOR,
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME
        ]);

        $config->setSearchable([
            PyzAntelopeTableMap::COL_NAME,
            PyzAntelopeTableMap::COL_COLOR,
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME
        ]);

        return $config;
    }

    /**
     * @param TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config): array
    {
        $query = $this->antelopeQuery->joinWithPyzAntelopeLocation();

        $antelopeEntityCollection = $this->runQuery(
            $query,
            $config,
            true
        );

        if (!$antelopeEntityCollection->count()) {
            return [];
        }

        return $this->mapReturns($antelopeEntityCollection);
    }

    /**
     * @param ObjectCollection<PyzAntelope> $antelopeEntityCollection
     *
     * @return array<int,mixed>
     */
    protected function mapReturns(ObjectCollection $antelopeEntityCollection
    ): array {
        $returns = [];

        foreach ($antelopeEntityCollection as $antelopeEntity) {
            $location = $antelopeEntity->getPyzAntelopeLocation();
            $data[PyzAntelopeTableMap::COL_ID_ANTELOPE] = $antelopeEntity->getIdAntelope();
            $data[PyzAntelopeTableMap::COL_NAME] = $antelopeEntity->getName();
            $data[PyzAntelopeTableMap::COL_COLOR] = $antelopeEntity->getColor();
            $data[PyzAntelopeLocationTableMap::COL_LOCATION_NAME] = $location->getLocationName();
            $returns[] = $data;
        }

        return $returns;
    }
}
