<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */
namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\LocaleTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkReviewExpander extends FactFinderSdkAbstractExpander
{
    const ID_PRODUCT_ABSTRACT = 'IdProductAbstract';

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param array $productData
     *
     * @return array
     */
    public function expand(LocaleTransfer $localeTransfer, $productData)
    {
        $query = $this->queryContainer
            ->getReviews($productData[static::ID_PRODUCT_ABSTRACT], $localeTransfer);
        $abstractProduct = $query->find();

        if ($abstractProduct->count() === 0) {
            $productData[FactFinderSdkConstants::ITEM_RATING] = 0;
            return $productData;
        }

        $productData = $this->setRating($abstractProduct, $productData);

        return $productData;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $abstractProduct
     * @param array $productData
     *
     * @return array
     */
    protected function setRating($abstractProduct, $productData)
    {
        $reviews = $abstractProduct->getFirst()->getSpyProductReviews();

        if ($reviews->count() === 0) {
            return $productData;
        }
        $productRating = 0;

        foreach ($reviews as $review) {
            $productRating += $review->getRating();
        }
        $productRating = $productRating / $reviews->count();
        $productRating = number_format($productRating, 2, '.', '');

        $productData[FactFinderSdkConstants::ITEM_RATING] = $productRating;

        return $productData;
    }
}
