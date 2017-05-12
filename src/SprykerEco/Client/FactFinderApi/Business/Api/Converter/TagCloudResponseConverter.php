<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Converter;

use FACTFinder\Adapter\TagCloud as FactFinderTagCloudAdapter;
use Generated\Shared\Transfer\FactFinderApiTagCloudResponseTransfer;

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
     * @return \Generated\Shared\Transfer\FactFinderApiTagCloudResponseTransfer
     */
    public function convert()
    {
        $responseTransfer = new FactFinderApiTagCloudResponseTransfer();

        return $responseTransfer;
    }

}
