<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\AntelopePage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class AntelopePageRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    /**
     * @var string
     */
    protected const ROUTE_ANTELOPE_INDEX = 'antelopes';

    /**
     * Specification:
     * - Adds Routes to the RouteCollection.
     *
     * @api
     *
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        return $this->addAntelopeIndexRoute($routeCollection);
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addAntelopeIndexRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('antelopes/list', 'AntelopePage', 'Antelope', 'indexAction');
        $routeCollection->add(static::ROUTE_ANTELOPE_INDEX, $route);

        return $routeCollection;
    }
}
