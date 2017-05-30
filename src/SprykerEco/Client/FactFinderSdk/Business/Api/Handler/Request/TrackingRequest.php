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

class TrackingRequest extends AbstractRequest implements TrackingRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_SEARCH;

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkTrackingResponseTransfer
     */
    public function request(FactFinderSdkTrackingRequestTransfer $factFinderTrackingRequestTransfer)
    {
        $parameters = new Parameters();
        $parameters->setAll($this->getRequestData($factFinderTrackingRequestTransfer));

        if (empty($parameters['query'])) {
            $parameters['query'] = '*';
        }

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

}
