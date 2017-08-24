<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Communication\Controller;

use Spryker\Shared\Config\Config;
use Spryker\Yves\Kernel\Controller\AbstractController;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;
use Symfony\Component\HttpFoundation\Request;

class NavigationController extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function factFinderAdminPanelAction(Request $request)
    {
        $configKey = FactFinderSdkConstants::ENVIRONMENT . FactFinderSdkConstants::ENVIRONMENT_PRODUCTION;
        return $this->redirectResponseExternal(
            Config::get($configKey)[FactFinderSdkConstants::ADMIN_PANEL_URL]
        );
    }

}
