<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface getQueryContainer()
 * @method \SprykerEco\Zed\FactFinderSdk\Business\FactFinderSdkFacadeInterface getFacade()
 * @method \SprykerEco\Zed\FactFinderSdk\Communication\FactFinderSdkCommunicationFactory getFactory()
 */
class NavigationController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function factFinderAdminPanelAction(Request $request)
    {
        $factFinderProductionConfiguration = $this->getFactory()->getConfig()->getFactFinderProductionConfiguration();

        return $this->redirectResponse(
            $factFinderProductionConfiguration[FactFinderSdkConstants::ADMIN_PANEL_URL]
        );
    }
}
