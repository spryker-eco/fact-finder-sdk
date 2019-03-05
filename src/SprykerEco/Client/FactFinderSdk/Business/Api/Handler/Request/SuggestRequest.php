<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use Exception;
use FACTFinder\Util\Parameters;
use Generated\Shared\Transfer\FactFinderSdkSuggestRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkSuggestResponseTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\ApiConstants;

class SuggestRequest extends AbstractRequest implements SuggestRequestInterface
{
    public const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_SUGGEST;

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkSuggestResponseTransfer
     */
    public function request(FactFinderSdkSuggestRequestTransfer $factFinderSuggestRequestTransfer)
    {
        $requestParameters = new Parameters();
        $requestParameters->setAll($factFinderSuggestRequestTransfer->toArray());
        $this->factFinderConnector->setRequestParameters($requestParameters);

        $suggestAdapter = $this->factFinderConnector->createSuggestAdapter();

        try {
            $responseTransfer = $this->converterFactory
                ->createSuggestResponseConverter($suggestAdapter)
                ->convert();
        } catch (Exception $exception) {
            $responseTransfer = new FactFinderSdkSuggestResponseTransfer();
        }

        return $responseTransfer;
    }
}
