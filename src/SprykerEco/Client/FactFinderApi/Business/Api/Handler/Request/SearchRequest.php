<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer;
use SprykerEco\Client\FactFinderApi\Business\Api\ApiConstants;

class SearchRequest extends AbstractRequest implements SearchRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_SEARCH;

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSearchResponseTransfer
     */
    public function request(FactFinderApiSearchRequestTransfer $factFinderSearchRequestTransfer)
    {
        $requestParameters = $this->factFinderConnector->createRequestParametersFromRequestParser();
        $this->factFinderConnector->setRequestParameters($requestParameters);

        $searchAdapter = $this->factFinderConnector->createSearchAdapter();

        $responseTransfer = $this->converterFactory
            ->createSearchResponseConverter($searchAdapter)
            ->convert();

        return $responseTransfer;
    }

}
