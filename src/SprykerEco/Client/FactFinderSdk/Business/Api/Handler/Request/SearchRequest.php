<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use FACTFinder\Util\Parameters;
use Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\ApiConstants;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

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
        $requestParameters = $this->convertCategoryParameters($requestParameters);
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

    /**
     * @param \FACTFinder\Util\Parameters $parameters
     *
     * @return \FACTFinder\Util\Parameters
     */
    protected function convertCategoryParameters(Parameters $parameters)
    {
        $parametersArray = $parameters->getArray();

        foreach ($parametersArray as $key => $parameter) {
            if (strpos($key, FactFinderSdkConstants::REQUEST_CATEGORY_PATH_ROOT_NAME) !== false) {
                unset($parametersArray[$key]);
                $newKey = str_replace('_', ' ', $key);
                $parametersArray[$newKey] = $parameter;
            }
        }

        $parameters->clear();
        $parameters->setAll($parametersArray);

        return $parameters;
    }

}
