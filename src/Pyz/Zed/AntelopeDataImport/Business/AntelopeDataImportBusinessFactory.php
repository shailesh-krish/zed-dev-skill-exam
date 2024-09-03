<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business;


use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeDataImport\Business\DataImportStep\AntelopeLocationWriterStep;
use Pyz\Zed\AntelopeDataImport\Business\DataImportStep\AntelopeWriterStep;
use Pyz\Zed\AntelopeDataImport\Business\Service\LocationService;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

class AntelopeDataImportBusinessFactory extends DataImportBusinessFactory
{
    public function createAntelopeDataImport(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null
    ): DataImporterInterface {
        $dataImporter = $this->getCsvDataImporterFromConfig($dataImporterConfigurationTransfer);
        $dataSetStepBroker = $this->createDataSetStepBroker();
        $dataSetStepBroker->addStep($this->createAntelopeLocationWriterStep());
        $dataSetStepBroker->addStep($this->createAntelopeWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    private function createAntelopeLocationWriterStep(
    ): AntelopeLocationWriterStep
    {
        return new AntelopeLocationWriterStep($this->getLocationService(),
        );
    }

    /**
     * @return LocationService
     */
    public function getLocationService(): LocationService
    {
        return new LocationService($this->getPropelConnection());
    }

    public function createAntelopeWriterStep(): AntelopeWriterStep
    {
        return new AntelopeWriterStep();
    }
}
