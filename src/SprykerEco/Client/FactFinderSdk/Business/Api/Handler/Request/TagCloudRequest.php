<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderSdkTagCloudRequestTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\ApiConstants;

class TagCloudRequest extends AbstractRequest implements TagCloudRequestInterface
{
    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_TAG_CLOUD;

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkTagCloudRequestTransfer $factFinderTagCloudRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkTagCloudResponseTransfer
     */
    public function request(FactFinderSdkTagCloudRequestTransfer $factFinderTagCloudRequestTransfer)
    {
        $tagCloudAdapter = $this->factFinderConnector->createTagCloudAdapter();

        // convert to FFSearchResponseTransfer
        $responseTransfer = $this->converterFactory
            ->createTagCloudResponseConverter($tagCloudAdapter)
            ->convert();

        return $responseTransfer;
    }
}
