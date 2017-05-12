<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use FACTFinder\Util\Parameters;
use Generated\Shared\Transfer\FactFinderApiSuggestRequestTransfer;
use SprykerEco\Client\FactFinderApi\Business\Api\ApiConstants;

class SuggestRequest extends AbstractRequest implements SuggestRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_SUGGEST;

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSuggestResponseTransfer
     */
    public function request(FactFinderApiSuggestRequestTransfer $factFinderSuggestRequestTransfer)
    {
        $requestParameters = new Parameters();
        $requestParameters->setAll($factFinderSuggestRequestTransfer->toArray());
        $this->factFinderConnector->setRequestParameters($requestParameters);

        $suggestAdapter = $this->factFinderConnector->createSuggestAdapter();

        $responseTransfer = $this->converterFactory
            ->createSuggestResponseConverter($suggestAdapter)
            ->convert();

        return $responseTransfer;
    }

}
