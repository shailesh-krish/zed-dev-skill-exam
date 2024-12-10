<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\AntelopePage;

use Spryker\Yves\Kernel\AbstractFactory;
use Pyz\Client\Antelope\AntelopeClientInterface;

/**
 * @method \Pyz\Yves\AntelopePage\AntelopePageConfig getConfig()
 */
class AntelopePageFactory extends AbstractFactory
{
    /**
     * Get dependency from provider
     *
     * @return mixed
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getAntelopeClient()
    {
        return $this->getProvidedDependency(AntelopePageDependencyProvider::CLIENT_ANTELOPE);
    }

}
