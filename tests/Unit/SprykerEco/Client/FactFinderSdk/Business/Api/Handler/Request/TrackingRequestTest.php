<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use FACTFinder\Adapter\Tracking;
use Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector;
use SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\TrackingRequest;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinderSdk
 * @group FactFinderSdkTest
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
        $factFinderTrackingRequestTransfer = new FactFinderSdkTrackingRequestTransfer();
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
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector
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
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\TrackingRequest
     */
    protected function createTrackingRequest()
    {
        return new TrackingRequest(
            $this->createFactFinderConnectorMock(),
            new ConverterFactory($this->createConfigMock()),
            $this->createConfigMock()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig
     */
    protected function createConfigMock()
    {
        $configMock = $this->createMock(FactFinderSdkConfig::class);

        return $configMock;
    }
}
