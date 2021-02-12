<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Client\FactFinderSdk\Business\Api\Converter;

use FACTFinder\Adapter\Tracking;
use Generated\Shared\Transfer\FactFinderSdkTrackingResponseTransfer;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\TrackingResponseConverter;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinderSdk
 * @group FactFinderSdkTest
 * @group TrackingResponseConverterTest
 */
class TrackingResponseConverterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     */
    public function testConvertShouldReturnCorrectData(): void
    {
        $trackingResponseConverter = new TrackingResponseConverter($this->createTrackingAdapterMock());

        $expectedTransferObject = $this->getExpectedTransferObject();
        $resultTransferObject = $trackingResponseConverter->convert();

        $this->assertEquals($expectedTransferObject, $resultTransferObject);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\FACTFinder\Adapter\Tracking
     */
    protected function createTrackingAdapterMock(): Tracking
    {
        $trackingAdapterMock = $this->getMockBuilder(Tracking::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $trackingAdapterMock;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkTrackingResponseTransfer
     */
    protected function getExpectedTransferObject(): FactFinderSdkTrackingResponseTransfer
    {
        return new FactFinderSdkTrackingResponseTransfer();
    }
}
