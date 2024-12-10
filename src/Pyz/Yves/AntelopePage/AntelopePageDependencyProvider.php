<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\AntelopePage;

use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepository;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class AntelopePageDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * Set constant for our module
     */
    const CLIENT_ANTELOPE = 'CLIENT_ANTELOPE';

    /**
     * Our custom function will be called
     *
     * @param Container $container
     * @return Container
     */
    public function provideDependencies(Container $container)
    {
        $container = $this->addPracticeClient($container);

        return $container;
    }

    /**
     * New function created for adding client class
     *
     * @param Container $container
     * @return Container
     * @throws \Spryker\Service\Container\Exception\FrozenServiceException
     */
    protected function addPracticeClient(Container $container)

    {
        $container->set(static::CLIENT_ANTELOPE, function (Container $container) {
            return $container->getLocator()->antelope()->client();

        });
        return $container;
    }

}
