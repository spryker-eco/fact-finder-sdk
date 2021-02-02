<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderSdk;

use FACTFinder\Adapter\Suggest;
use FACTFinder\Data\SuggestQuery;
use PHPUnit_Framework_TestCase;
use SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector;

class FactFinderSdkMocks extends PHPUnit_Framework_TestCase
{
    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnector
     */
    protected function createFactFinderConnectorMock(): FactFinderConnector
    {
        $connector = $this->getMockBuilder(FactFinderConnector::class)
            ->disableOriginalConstructor()
            ->getMock();
        $connector->method('createSuggestAdapter')
            ->willReturn($this->createSuggestAdapterMock());

        return $connector;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\FACTFinder\Adapter\Suggest
     */
    protected function createSuggestAdapterMock(): Suggest
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
