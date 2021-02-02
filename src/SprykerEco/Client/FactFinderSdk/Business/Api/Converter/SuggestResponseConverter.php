<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use FACTFinder\Adapter\Suggest as FactFinderSuggestAdapter;
use Generated\Shared\Transfer\FactFinderSdkSuggestResponseTransfer;

class SuggestResponseConverter extends BaseConverter implements ConverterInterface
{
    /**
     * @var \FACTFinder\Adapter\Suggest
     */
    protected $suggestAdapter;

    /**
     * @param \FACTFinder\Adapter\Suggest $suggestAdapter
     */
    public function __construct(FactFinderSuggestAdapter $suggestAdapter)
    {
        $this->suggestAdapter = $suggestAdapter;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkSuggestResponseTransfer
     */
    public function convert()
    {
        $responseTransfer = new FactFinderSdkSuggestResponseTransfer();

        $suggestions = $this->suggestAdapter->getSuggestions();

        foreach ($suggestions as $suggestion) {
            $responseTransfer->addSuggestion([
                'imageUrl' => $suggestion->getImageUrl(),
                'label' => $suggestion->getLabel(),
                'url' => $suggestion->getUrl(),
                'attributes' => $suggestion->getAttributes(),
                'type' => $suggestion->getType(),
                'hitCount' => $suggestion->getHitCount(),
            ]);
        }

        return $responseTransfer;
    }
}
