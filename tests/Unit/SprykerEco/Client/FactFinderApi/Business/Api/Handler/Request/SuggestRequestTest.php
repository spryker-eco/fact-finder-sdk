<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request;

use Generated\Shared\Transfer\FactFinderApiSuggestRequestTransfer;
use SprykerEco\Client\FactFinderApi\Business\Api\Converter\ConverterFactory;
use SprykerEco\Client\FactFinderApi\Business\Api\Handler\Request\SuggestRequest;
use Unit\SprykerEco\Client\FactFinderApi\FactFinderApiMocks;

/**
 * @group Unit
 * @group SprykerEco
 * @group Client
 * @group FactFinderApi
 * @group FactFinderApiTest
 * @group SuggestRequestTest
 */
class SuggestRequestTest extends FactFinderApiMocks
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

}
