<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use FACTFinder\Util\Parameters;
use Generated\Shared\Transfer\FactFinderApiTrackingRequestTransfer;
use Generated\Shared\Transfer\FactFinderApiTrackingResponseTransfer;
use SprykerEco\Client\FactFinderApi\Business\Api\ApiConstants;

class TrackingRequest extends AbstractRequest implements TrackingRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_SEARCH;

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiTrackingResponseTransfer
     */
    public function request(FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer)
    {
        $parameters = new Parameters();
        $parameters->setAll($this->getRequestData($factFinderTrackingRequestTransfer));

        $this->factFinderConnector->setRequestParameters($parameters);

        $trackingAdapter = $this->factFinderConnector->createTrackingAdapter();
        $result = $trackingAdapter->applyTracking();

        $responseTransfer = new FactFinderApiTrackingResponseTransfer();
        $responseTransfer->setResult($result);

        return $responseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return array
     */
    protected function getRequestData(FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer)
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
