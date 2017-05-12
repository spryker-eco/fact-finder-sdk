<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderApi\Business\Api\Converter;

use FACTFinder\Adapter\Tracking;
use Generated\Shared\Transfer\FactFinderApiTrackingResponseTransfer;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinderApi\Business\Api\Converter\TrackingResponseConverter;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinderApi
 * @group FactFinderApiTest
 * @group TrackingResponseConverterTest
 */
class TrackingResponseConverterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testConvert()
    {
        $trackingResponseConverter = new TrackingResponseConverter($this->createTrackingAdapterMock());

        $expectedTransferObject = $this->getExpectedTransferObject();
        $resultTransferObject = $trackingResponseConverter->convert();

        $this->assertEquals($expectedTransferObject, $resultTransferObject);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\FACTFinder\Adapter\Tracking
     */
    protected function createTrackingAdapterMock()
    {
        $trackingAdapterMock = $this->getMockBuilder(Tracking::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $trackingAdapterMock;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderApiTrackingResponseTransfer
     */
    protected function getExpectedTransferObject()
    {
        return new FactFinderApiTrackingResponseTransfer();
    }

}
