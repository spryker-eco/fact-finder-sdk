<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data;

use FACTFinder\Data\Item;
use Generated\Shared\Transfer\FactFinderSdkDataItemTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\BaseConverter;

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
     * @return \Generated\Shared\Transfer\FactFinderSdkDataItemTransfer
     */
    public function convert()
    {
        $factFinderDataItemTransfer = new FactFinderSdkDataItemTransfer();
        $factFinderDataItemTransfer->setLabel($this->item->getLabel());
        $factFinderDataItemTransfer->setUrl($this->item->getUrl());
        $factFinderDataItemTransfer->setSelected($this->item->isSelected());

        return $factFinderDataItemTransfer;
    }
}
