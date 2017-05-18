<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use FACTFinder\Adapter\Tracking;
use Generated\Shared\Transfer\FactFinderApiTrackingRequestTransfer;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinderApi\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinderApi\Business\Api\FactFinderConnector;
use SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\TrackingRequest;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinderApi
 * @group FactFinderApiTest
 * @group TrackingRequestTest
 */
class TrackingRequestTest extends PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testRequest()
    {
        $trackingRequest = $this->createTrackingRequest();
        $factFinderTrackingRequestTransfer = new FactFinderApiTrackingRequestTransfer();
        $factFinderTrackingRequestTransfer->setQuery('ProductName');
        $factFinderTrackingRequestTransfer->setSid('SessioId');

        $result = $trackingRequest->request($factFinderTrackingRequestTransfer)
            ->toArray();

        $expected = [
            'result' => true,
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\FACTFinder\Adapter\Tracking
     */
    protected function createTrackingAdapterMock()
    {
        $trackingAdapterMock = $this->getMockBuilder(Tracking::class)
            ->disableOriginalConstructor()
            ->getMock();
        $trackingAdapterMock->method('applyTracking')
            ->willReturn(true);

        return $trackingAdapterMock;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Client\FactFinderApi\Business\Api\FactFinderConnector
     */
    protected function createFactFinderConnectorMock()
    {
        $connector = $this->getMockBuilder(FactFinderConnector::class)
            ->disableOriginalConstructor()
            ->getMock();
        $connector->method('createTrackingAdapter')
            ->willReturn($this->createTrackingAdapterMock());

        return $connector;
    }

    /**
     * @return \SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\TrackingRequest
     */
    protected function createTrackingRequest()
    {
        return new TrackingRequest(
            $this->createFactFinderConnectorMock(),
            new ConverterFactory()
        );
    }

}
