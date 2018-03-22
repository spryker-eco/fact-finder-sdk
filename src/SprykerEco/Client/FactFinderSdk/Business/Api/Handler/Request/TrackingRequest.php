<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use FACTFinder\Util\Parameters;
use Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkTrackingResponseTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\ApiConstants;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig;

class TrackingRequest extends AbstractRequest implements TrackingRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_SEARCH;

    /**
     * @var FactFinderSdkConfig
     */
    protected $config;

    /**
     * TrackingRequest constructor.
     * @param FactFinderConnector $factFinderConnector
     * @param ConverterFactory $converterFactory
     */
    public function __construct(FactFinderConnector $factFinderConnector, ConverterFactory $converterFactory, FactFinderSdkConfig $config)
    {
        parent::__construct($factFinderConnector, $converterFactory);
        $this->config = $config;
    }


    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkTrackingResponseTransfer
     */
    public function request(FactFinderSdkTrackingRequestTransfer $factFinderTrackingRequestTransfer)
    {
        $parameters = new Parameters();
        $parameters->setAll($this->getRequestData($factFinderTrackingRequestTransfer));

        $parameters = $this->fillDefaultValues($parameters);
        $this->factFinderConnector->setRequestParameters($parameters);

        $trackingAdapter = $this->factFinderConnector->createTrackingAdapter();

        try {
            $result = $trackingAdapter->applyTracking();
        } catch (\Exception $exception) {
            $result = false;
        }

        $responseTransfer = new FactFinderSdkTrackingResponseTransfer();
        $responseTransfer->setResult($result);

        return $responseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return array
     */
    protected function getRequestData(FactFinderSdkTrackingRequestTransfer $factFinderTrackingRequestTransfer)
    {
        $data = $factFinderTrackingRequestTransfer->toArray();

        foreach ($data as $key => $value) {
            $newKey = str_replace('_', '', ucwords($key, '_'));
            $newKey = lcfirst($newKey);

            if ($newKey !== $key) {
                $data[$newKey] = $value;
                unset($data[$key]);
            }
        }

        return $data;
    }

    /**
     * @param $parameters
     * @return mixed
     */
    protected function fillDefaultValues($parameters)
    {
        $defaultValues = [
            'query' => '*',
            'channel' => $this->config->getFactFinderConfiguration()['channel'],
        ];

        foreach ($defaultValues as $key => $value) {
            if (empty($parameters[$key])) {
                $parameters[$key] = $value;
            }
        }

        return $parameters;
    }

}
