<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk;

use Spryker\Client\Kernel\AbstractFactory;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector;
use SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\ProductCampaignRequest;
use SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\RecommendationRequest;
use SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\SearchRequest;
use SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\ShoppingCartCampaignRequest;
use SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\SuggestRequest;
use SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\TrackingRequest;

/**
 * @method \SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig getConfig()
 */
class FactFinderSdkFactory extends AbstractFactory
{

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\SearchRequestInterface
     */
    public function createSearchRequest()
    {
        return new SearchRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\SuggestRequestInterface
     */
    public function createSuggestRequest()
    {
        return new SuggestRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\TrackingRequestInterface
     */
    public function createTrackingRequest()
    {
        return new TrackingRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\RecommendationRequestInterface
     */
    public function createRecommendationsRequest()
    {
        return new RecommendationRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\ProductCampaignRequest
     */
    public function createProductCampaignRequest()
    {
        return new ProductCampaignRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\ShoppingCartCampaignRequest
     */
    public function createShoppingCartCampaignRequest()
    {
        return new ShoppingCartCampaignRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector
     */
    public function createFactFinderConnector()
    {
        return new FactFinderConnector($this->getConfig());
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory
     */
    protected function createConverterFactory()
    {
        return new ConverterFactory($this->getConfig());
    }

    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getSession()
    {
        return $this->getProvidedDependency(FactFinderSdkDependencyProvider::CLIENT_SESSION);
    }

}
