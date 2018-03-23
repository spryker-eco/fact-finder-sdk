<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use FACTFinder\Adapter\TagCloud as FactFinderTagCloudAdapter;
use Generated\Shared\Transfer\FactFinderSdkTagCloudResponseTransfer;

class TagCloudResponseConverter extends BaseConverter
{
    /**
     * @var \FACTFinder\Adapter\TagCloud
     */
    protected $tagCloudAdapter;

    /**
     * @param \FACTFinder\Adapter\TagCloud $tagCloudAdapter
     */
    public function __construct(FactFinderTagCloudAdapter $tagCloudAdapter)
    {
        $this->tagCloudAdapter = $tagCloudAdapter;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkTagCloudResponseTransfer
     */
    public function convert()
    {
        $responseTransfer = new FactFinderSdkTagCloudResponseTransfer();

        return $responseTransfer;
    }
}
