<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use FACTFinder\Adapter\Suggest;
use FACTFinder\Data\SuggestQuery;
use Generated\Shared\Transfer\FactFinderApiSuggestRequestTransfer;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinderApi\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinderApi\Business\Api\FactFinderConnector;
use SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\SuggestRequest;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinderApi
 * @group FactFinderApiTest
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
        $factFinderSuggestRequestTransfer = new FactFinderApiSuggestRequestTransfer();
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
                ]
            ]
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * @return SuggestRequest
     */
    protected function createSuggestRequest()
    {
        return new SuggestRequest(
            $this->createFactFinderConnectorMock(),
            new ConverterFactory()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|FactFinderConnector
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
