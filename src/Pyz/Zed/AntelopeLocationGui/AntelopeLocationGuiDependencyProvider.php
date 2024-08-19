<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui;

use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Pyz\Zed\AntelopeLocationGui\AntelopeLocationGuiConfig getConfig()
 */
class AntelopeLocationGuiDependencyProvider extends
    AbstractBundleDependencyProvider
{
    public const QUERY_ANTELOPE_LOCATION = 'QUERY_ANTELOPE_LOCATION';
    public const FACADE_ANTELOPE = 'FACADE_ANTELOPE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container
    ): Container {
        $container = $this->addAntelopeLocationQuery($container);
        $container = $this->addAntelopeLocationFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAntelopeLocationQuery(Container $container): Container
    {
        $container->set(static::QUERY_ANTELOPE_LOCATION,
            $container->factory(function () {
                return PyzAntelopeLocationQuery::create();
            }));

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAntelopeLocationFacade(Container $container
    ): Container {
        $container->set(static::FACADE_ANTELOPE, function (
            Container $container
        ) {
            return $container->getLocator()->antelope()->facade();
        });

        return $container;
    }
}
