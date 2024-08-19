<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method \Pyz\Zed\AntelopeLocationGui\Communication\AntelopeLocationGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{

    public function indexAction(): array
    {
        $table = $this->getFactory()->createAntelopeLocationTable();

        return $this->viewResponse([
            'antelopeLocationTable' => $table->render(),
        ]);
    }

    /**
     * Provides the JSON data for the AntelopeLocation table.
     *
     * @return JsonResponse
     */
    public function tableAction(): JsonResponse
    {
        $table = $this->getFactory()->createAntelopeLocationTable();

        return $this->jsonResponse(
            $table->fetchData()
        );
    }


}
