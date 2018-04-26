<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data;

use FACTFinder\Data\Record;
use Generated\Shared\Transfer\FactFinderSdkDataRecordTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\BaseConverter;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class RecordConverter extends BaseConverter
{
    /**
     * @var \FACTFinder\Data\Record
     */
    protected $record;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig
     */
    private $config;

    /**
     * RecordConverter constructor.
     *
     * @param \SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig $config
     * @param \FACTFinder\Data\Record|null $record
     */
    public function __construct(FactFinderSdkConfig $config, ?Record $record = null)
    {
        $this->record = $record;
        $this->config = $config;
    }

    /**
     * @param \FACTFinder\Data\Record $record
     *
     * @return void
     */
    public function setRecord(Record $record)
    {
        $this->record = $record;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkDataRecordTransfer
     */
    public function convert()
    {
        $factFinderDataRecordTransfer = new FactFinderSdkDataRecordTransfer();
        $factFinderDataRecordTransfer->setId($this->record->getID());
        $factFinderDataRecordTransfer->setSimilarity($this->record->getSimilarity());
        $factFinderDataRecordTransfer->setPosition($this->record->getPosition());
        $factFinderDataRecordTransfer->setOriginalPosition($this->record->getField(FactFinderSdkConstants::ITEM_ORIGINAL_POSITION));
        $factFinderDataRecordTransfer->setSeoPath($this->record->getSeoPath());
        $factFinderDataRecordTransfer->setKeywords($this->record->getKeywords());

        $this->convertFields($factFinderDataRecordTransfer);

        return $factFinderDataRecordTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkDataRecordTransfer $factFinderDataRecordTransfer
     *
     * @return void
     */
    protected function convertFields(FactFinderSdkDataRecordTransfer $factFinderDataRecordTransfer)
    {
        $fields = [];
        foreach ($this->config->getItemFields() as $itemFieldName) {
            $fields[$itemFieldName] = $this->record->getField($itemFieldName);
        }
        $factFinderDataRecordTransfer->setFields($fields);
    }
}
