<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data;

use FACTFinder\Data\Filter;
use FACTFinder\Data\FilterGroup;
use FACTFinder\Data\SliderFilter;
use Generated\Shared\Transfer\FactFinderSdkDataFilterGroupTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataFilterTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\BaseConverter;

class FilterGroupConverter extends BaseConverter
{

    /**
     * @var \FACTFinder\Data\FilterGroup
     */
    protected $filterGroup;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverter
     */
    protected $itemConverter;

    /**
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverter $itemConverter
     */
    public function __construct(
        ItemConverter $itemConverter
    ) {
        $this->itemConverter = $itemConverter;
    }

    /**
     * @param \FACTFinder\Data\FilterGroup $filterGroup
     *
     * @return void
     */
    public function setFilterGroup(FilterGroup $filterGroup)
    {
        $this->filterGroup = $filterGroup;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkDataFilterGroupTransfer
     */
    public function convert()
    {
        $factFinderDataFilterGroupTransfer = new FactFinderSdkDataFilterGroupTransfer();

        /** @var \FACTFinder\Data\Filter $filter */
        foreach ($this->filterGroup as $filter) {
            $factFinderDataFilterGroupTransfer->addFilters(
                $this->convertFilter($filter)
            );
        }

        $factFinderDataFilterGroupTransfer->setName($this->filterGroup->getName());
        $factFinderDataFilterGroupTransfer->setDetailedLinkCount($this->filterGroup->getDetailedLinkCount());
        $factFinderDataFilterGroupTransfer->setUnit($this->filterGroup->getUnit());
        $factFinderDataFilterGroupTransfer->setIsRegularStyle($this->filterGroup->isRegularStyle());
        $factFinderDataFilterGroupTransfer->setIsSliderStyle($this->filterGroup->isSliderStyle());
        $factFinderDataFilterGroupTransfer->setIsTreeStyle($this->filterGroup->isTreeStyle());
        $factFinderDataFilterGroupTransfer->setIsMultiSelectStyle($this->filterGroup->isMultiSelectStyle());
        $factFinderDataFilterGroupTransfer->setHasPreviewImages($this->filterGroup->hasPreviewImages());
        $factFinderDataFilterGroupTransfer->setHasSelectedItems($this->filterGroup->hasSelectedItems());
        $factFinderDataFilterGroupTransfer->setIsSingleHideUnselectedType($this->filterGroup->isSingleHideUnselectedType());
        $factFinderDataFilterGroupTransfer->setIsSingleShowUnselectedType($this->filterGroup->isSingleShowUnselectedType());
        $factFinderDataFilterGroupTransfer->setIsMultiSelectOrType($this->filterGroup->isMultiSelectOrType());
        $factFinderDataFilterGroupTransfer->setIsMultiSelectAndType($this->filterGroup->isMultiSelectAndType());
        $factFinderDataFilterGroupTransfer->setIsTextType($this->filterGroup->isTextType());
        $factFinderDataFilterGroupTransfer->setIsNumberType($this->filterGroup->isNumberType());

        return $factFinderDataFilterGroupTransfer;
    }

    /**
     * @param \FACTFinder\Data\Filter $filter
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataFilterTransfer
     */
    protected function convertFilter(Filter $filter)
    {
        $factFinderDataFilterTransfer = new FactFinderSdkDataFilterTransfer();

        $this->itemConverter->setItem($filter);
        $factFinderDataFilterTransfer->setItem(
            $this->itemConverter->convert()
        );
        $factFinderDataFilterTransfer->setFieldName($filter->getFieldName());
        $factFinderDataFilterTransfer->setMatchCount($filter->getMatchCount());
        $factFinderDataFilterTransfer->setClusterLevel($filter->getClusterLevel());
        $factFinderDataFilterTransfer->setPreviewImage($filter->getPreviewImage());
        $factFinderDataFilterTransfer->setHasPreviewImage($filter->hasPreviewImage());

        if ($filter instanceof SliderFilter) {
            $factFinderDataFilterTransfer->setAbsoluteMinimum($filter->getAbsoluteMinimum());
            $factFinderDataFilterTransfer->setAbsoluteMaximum($filter->getAbsoluteMaximum());
            $factFinderDataFilterTransfer->setSelectedMinimum($filter->getSelectedMinimum());
            $factFinderDataFilterTransfer->setSelectedMaximum($filter->getSelectedMaximum());
        }

        return $factFinderDataFilterTransfer;
    }

}
