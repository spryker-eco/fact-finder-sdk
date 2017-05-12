<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Converter\Data;

use FACTFinder\Data\Item;
use Generated\Shared\Transfer\FactFinderApiDataItemTransfer;
use SprykerEco\Client\FactFinderApi\Business\Api\Converter\BaseConverter;

class ItemConverter extends BaseConverter
{

    /**
     * @var \FACTFinder\Data\Item
     */
    protected $item;

    /**
     * @param \FACTFinder\Data\Item $item
     *
     * @return void
     */
    public function setItem(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderApiDataItemTransfer
     */
    public function convert()
    {
        $factFinderDataItemTransfer = new FactFinderApiDataItemTransfer();
        $factFinderDataItemTransfer->setLabel($this->item->getLabel());
        $factFinderDataItemTransfer->setUrl($this->item->getUrl());
        $factFinderDataItemTransfer->setSelected($this->item->isSelected());

        return $factFinderDataItemTransfer;
    }

}
