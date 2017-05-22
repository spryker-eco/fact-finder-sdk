<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use FACTFinder\Adapter\Suggest;
use FACTFinder\Data\SuggestQuery;
use Generated\Shared\Transfer\FactFinderSdkSuggestResponseTransfer;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\SuggestResponseConverter;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinderSdk
 * @group FactFinderSdkTest
 * @group SuggestResponseConverterTest
 */
class SuggestResponseConverterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testConvert()
    {
        $suggestResponseConverter = new SuggestResponseConverter($this->createSuggestAdapterMock());
        $resultFactFinderSdkSuggestResponseTransfer = $suggestResponseConverter->convert();

        $expectedSuggestion = $this->getExpectedTransferObject()
            ->getSuggestions();
        $resultSuggestions = $resultFactFinderSdkSuggestResponseTransfer->getSuggestions();

        $this->assertEquals($expectedSuggestion, $resultSuggestions);
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

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkSuggestResponseTransfer
     */
    protected function getExpectedTransferObject()
    {
        $factFinderSuggestResponseTransfer = new FactFinderSdkSuggestResponseTransfer();
        $factFinderSuggestResponseTransfer->setSuggestions([
            [
                'imageUrl' => 'http://localhost/img',
                'label' => 'ProductName',
                'url' => 'http://localhost',
                'attributes' => [],
                'type' => 'product',
                'hitCount' => 0,
            ],
        ]);

        return $factFinderSuggestResponseTransfer;
    }

}
