<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request;

use FACTFinder\Adapter\Suggest;
use FACTFinder\Data\SuggestQuery;
use Generated\Shared\Transfer\FactFinderSdkSuggestRequestTransfer;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector;
use SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\SuggestRequest;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkConfig;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinderSdk
 * @group FactFinderSdkTest
 * @group SuggestRequestTest
 */
class SuggestRequestTest extends PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testRequest()
    {
        $suggestRequest = $this->createSuggestRequest();
        $factFinderSuggestRequestTransfer = new FactFinderSdkSuggestRequestTransfer();
        $factFinderSuggestRequestTransfer->setQuery('ProductName');

        $result = $suggestRequest->request($factFinderSuggestRequestTransfer)
            ->toArray();

        $expected = [
            'suggestions' => [
                [
                    'imageUrl' => 'http://localhost/img',
                    'label' => 'ProductName',
                    'url' => 'http://localhost',
                    'attributes' => [],
                    'type' => 'product',
                    'hitCount' => 0,
                ],
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\Business\Api\Handler\Request\SuggestRequest
     */
    protected function createSuggestRequest()
    {
        return new SuggestRequest(
            $this->createFactFinderConnectorMock(),
            new ConverterFactory($this->createConfigMock())
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

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector
     */
    protected function createFactFinderConnectorMock()
    {
        $connector = $this->getMockBuilder(FactFinderConnector::class)
            ->disableOriginalConstructor()
            ->getMock();
        $connector->method('createSuggestAdapter')
            ->willReturn($this->createSuggestAdapterMock());

        return $connector;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\FACTFinder\Adapter\Suggest
     */
    protected function createSuggestAdapterMock()
    {
        $suggestAdapterMock = $this->getMockBuilder(Suggest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $suggestAdapterMock->method('getSuggestions')
            ->willReturn([
                $this->getSuggestQuery(),
            ]);

        return $suggestAdapterMock;
    }

    /**
     * @return \FACTFinder\Data\SuggestQuery
     */
    protected function getSuggestQuery()
    {
        return new SuggestQuery(
            'ProductName',
            'http://localhost',
            '0',
            'product',
            'http://localhost/img',
            []
        );
    }

}
