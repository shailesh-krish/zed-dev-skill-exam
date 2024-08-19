<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication\Table;

use Orm\Zed\AntelopeLocation\Persistence\Map\PyzAntelopeLocationTableMap;
use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeLocationTable extends AbstractTable
{

    public function __construct(
        protected PyzAntelopeLocationQuery $antelopeLocationQuery
    ) {
    }

    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            PyzAntelopeLocationTableMap::COL_ID_ANTELOPE_LOCATION => 'ID',
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME => 'Name',
        ]);

        $config->setSortable([
            PyzAntelopeLocationTableMap::COL_ID_ANTELOPE_LOCATION,
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME,
        ]);

        $config->setSearchable([
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME,
        ]);

        return $config;
    }

    /**
     * @param TableConfiguration $config
     * @return array<int,array>
     */
    protected function prepareData(TableConfiguration $config): array
    {
        $locationEntities = $this->runQuery($this->antelopeLocationQuery,
            $config, true);

        $locationData = [];
        foreach ($locationEntities as $locationEntity) {
            $locationData[] = [
                PyzAntelopeLocationTableMap::COL_ID_ANTELOPE_LOCATION => $locationEntity->getIdAntelopeLocation(),
                PyzAntelopeLocationTableMap::COL_LOCATION_NAME => $locationEntity->getLocationName(),
            ];
        }

        return $locationData;
    }
}
