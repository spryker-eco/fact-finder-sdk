<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinder;

use Spryker\Client\Kernel\AbstractFactory;
use SprykerEco\Client\FactFinder\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinder\Business\Api\FactFinderConnector;
use SprykerEco\Client\FactFinder\Business\Api\Handler\Request\RecommendationRequest;
use SprykerEco\Client\FactFinder\Business\Api\Handler\Request\SearchRequest;
use SprykerEco\Client\FactFinder\Business\Api\Handler\Request\SuggestRequest;
use SprykerEco\Client\FactFinder\Business\Api\Handler\Request\TrackingRequest;

/**
 * @method \SprykerEco\Client\FactFinder\FactFinderConfig getConfig()
 */
class FactFinderFactory extends AbstractFactory
{

    /**
     * @return \SprykerEco\Client\FactFinder\Business\Api\Handler\Request\SearchRequestInterface
     */
    public function createSearchRequest()
    {
        return new SearchRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinder\Business\Api\Handler\Request\SuggestRequestInterface
     */
    public function createSuggestRequest()
    {
        return new SuggestRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinder\Business\Api\Handler\Request\TrackingRequestInterface
     */
    public function createTrackingRequest()
    {
        return new TrackingRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinder\Business\Api\Handler\Request\RecommendationRequestInterface
     */
    public function createRecommendationsRequest()
    {
        return new RecommendationRequest(
            $this->createFactFinderConnector(),
            $this->createConverterFactory()
        );
    }

    /**
     * @return \SprykerEco\Client\FactFinder\Business\Api\FactFinderConnector
     */
    public function createFactFinderConnector()
    {
        return new FactFinderConnector($this->getConfig());
    }

    /**
     * @return \SprykerEco\Client\FactFinder\Business\Api\Converter\ConverterFactory
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
        return $this->getProvidedDependency(FactFinderDependencyProvider::CLIENT_SESSION);
    }

}
