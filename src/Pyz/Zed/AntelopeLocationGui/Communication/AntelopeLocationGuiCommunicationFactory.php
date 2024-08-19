<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;
use Pyz\Zed\AntelopeLocationGui\AntelopeLocationGuiDependencyProvider;
use Pyz\Zed\AntelopeLocationGui\Communication\Form\AntelopeLocationForm;
use Pyz\Zed\AntelopeLocationGui\Communication\Table\AntelopeLocationTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Form\FormInterface;

/**
 * @method \Pyz\Zed\AntelopeLocationGui\AntelopeLocationGuiConfig getConfig()
 */
class AntelopeLocationGuiCommunicationFactory extends
    AbstractCommunicationFactory
{
    /**
     * @return \Pyz\Zed\AntelopeLocationGui\Communication\Table\AntelopeLocationTable
     */
    public function createAntelopeLocationTable(): AntelopeLocationTable
    {
        return new AntelopeLocationTable(
            $this->getAntelopeLocationQuery()
        );
    }

    /**
     * @return PyzAntelopeLocationQuery
     */
    public function getAntelopeLocationQuery(): PyzAntelopeLocationQuery
    {
        return $this->getProvidedDependency(AntelopeLocationGuiDependencyProvider::QUERY_ANTELOPE_LOCATION);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createAntelopeLocationForm(
        AntelopeLocationTransfer $antelopeTransfer,
        array $options = []
    ): FormInterface {
        return $this->getFormFactory()->create(
            AntelopeLocationForm::class,
            $antelopeTransfer,
            $options
        );
    }

    /**
     * @return AntelopeLocationFacadeInterface
     */
    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeLocationGuiDependencyProvider::FACADE_ANTELOPE);
    }
}
