<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiTagCloudRequestTransfer;
use SprykerEco\Client\FactFinderApi\Business\Api\ApiConstants;

class TagCloudRequest extends AbstractRequest implements TagCloudRequestInterface
{

    const TRANSACTION_TYPE = ApiConstants::TRANSACTION_TYPE_TAG_CLOUD;

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiTagCloudRequestTransfer $factFinderTagCloudRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiTagCloudResponseTransfer
     */
    public function request(FactFinderApiTagCloudRequestTransfer $factFinderTagCloudRequestTransfer)
    {
        $tagCloudAdapter = $this->factFinderConnector->createTagCloudAdapter();

        // convert to FFSearchResponseTransfer
        $responseTransfer = $this->converterFactory
            ->createTagCloudResponseConverter($tagCloudAdapter)
            ->convert();

        return $responseTransfer;
    }

}
