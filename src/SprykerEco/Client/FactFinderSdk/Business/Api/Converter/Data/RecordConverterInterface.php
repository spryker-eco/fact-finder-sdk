<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data;

use FACTFinder\Data\Record;

interface RecordConverterInterface
{
    /**
     * @param \FACTFinder\Data\Record $record
     *
     * @return void
     */
    public function setRecord(Record $record);

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkDataRecordTransfer
     */
    public function convert();
}
