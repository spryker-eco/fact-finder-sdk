<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi;

use Spryker\Client\Kernel\AbstractFactory;
use SprykerEco\Client\FactFinderApi\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinderApi\Business\Api\FactFinderConnector;
use SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\RecommendationRequest;
use SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\SearchRequest;
use SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\SuggestRequest;
use SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\TrackingRequest;

/**
 * @method \SprykerEco\Client\FactFinderApi\FactFinderApiConfig getConfig()
 */
class FactFinderApiFactory extends AbstractFactory
{

    /**
     * @return \SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\SearchRequestInterface
     */
    public function createSearchRequest()
    {
        return new SearchRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\SuggestRequestInterface
     */
    public function createSuggestRequest()
    {
        return new SuggestRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\TrackingRequestInterface
     */
    public function createTrackingRequest()
    {
        return new TrackingRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\RecommendationRequestInterface
     */
    public function createRecommendationsRequest()
    {
        return new RecommendationRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinderApi\Business\Api\FactFinderConnector
     */
    public function createFactFinderConnector()
    {
        return new FactFinderConnector($this->getConfig());
    }

    /**
     * @return \SprykerEco\Client\FactFinderApi\Business\Api\Converter\ConverterFactory
     */
    protected function createConverterFactory()
    {
        return new ConverterFactory();
    }

    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    public function getSession()
    {
        return $this->getProvidedDependency(FactFinderApiDependencyProvider::CLIENT_SESSION);
    }

}
