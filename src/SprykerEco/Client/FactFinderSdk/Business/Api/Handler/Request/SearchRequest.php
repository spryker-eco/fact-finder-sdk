<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\ApiConstants;

class SearchRequest extends AbstractRequest implements SearchRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_SEARCH;

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer
     */
    public function request(FactFinderSdkSearchRequestTransfer $factFinderSearchRequestTransfer)
    {
        $requestParameters = $this->factFinderConnector
            ->createRequestParametersFromSearchRequestTransfer($factFinderSearchRequestTransfer);
        $this->factFinderConnector->setRequestParameters($requestParameters);

        $searchAdapter = $this->factFinderConnector->createSearchAdapter();

        try {
            $responseTransfer = $this->converterFactory
                ->createSearchResponseConverter($searchAdapter)
                ->convert();
        } catch (\Exception $e) {
            $responseTransfer = new FactFinderSdkSearchResponseTransfer();
        }

        return $responseTransfer;
    }

}
