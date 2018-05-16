<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data;

use FACTFinder\Data\Paging;
use Generated\Shared\Transfer\FactFinderSdkDataPageTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataPagingTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\BaseConverter;

class PagingConverter extends BaseConverter implements PagingConverterInterface
{
    /**
     * @var \FACTFinder\Data\Paging
     */
    protected $paging;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverterInterface
     */
    protected $itemConverter;

    /**
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverterInterface $itemConverter
     */
    public function __construct(
        ItemConverterInterface $itemConverter
    ) {
        $this->itemConverter = $itemConverter;
    }

    /**
     * @param \FACTFinder\Data\Paging $paging
     *
     * @return void
     */
    public function setPaging(Paging $paging = null)
    {
        $this->paging = $paging;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkDataPagingTransfer
     */
    public function convert()
    {
        $factFinderDataPagingTransfer = new FactFinderSdkDataPagingTransfer();

        if ($this->paging === null) {
            return $factFinderDataPagingTransfer;
        }

        $factFinderDataPagingTransfer->setPageCount($this->paging->getPageCount());
        $factFinderDataPagingTransfer->setFirstPage($this->convertPage($this->paging->getFirstPage()));
        $factFinderDataPagingTransfer->setLastPage($this->convertPage($this->paging->getLastPage()));
        $factFinderDataPagingTransfer->setPreviousPage($this->convertPage($this->paging->getPreviousPage()));
        $factFinderDataPagingTransfer->setCurrentPage($this->convertPage($this->paging->getCurrentPage()));
        $factFinderDataPagingTransfer->setNextPage($this->convertPage($this->paging->getNextPage()));

        $this->addPagesArray($factFinderDataPagingTransfer);

        return $factFinderDataPagingTransfer;
    }

    /**
     * @param \FACTFinder\Data\Page|null $page
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataPageTransfer
     */
    protected function convertPage($page)
    {
        $factFinderDataPageTransfer = new FactFinderSdkDataPageTransfer();
        if ($page === null) {
            return $factFinderDataPageTransfer;
        }

        $factFinderDataPageTransfer->setPageNumber($page->getPageNumber());
        $this->itemConverter->setItem($page);
        $factFinderDataPageTransfer->setItem(
            $this->itemConverter->convert()
        );

        return $factFinderDataPageTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkDataPagingTransfer $factFinderDataPagingTransfer
     *
     * @return void
     */
    protected function addPagesArray(FactFinderSdkDataPagingTransfer $factFinderDataPagingTransfer)
    {
        foreach ($this->paging->getArrayCopy() as $item) {
            $factFinderDataPagingTransfer->addPages($this->convertPage($item));
        }
    }
}
