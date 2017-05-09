<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinder\Dependency\Persistence;

use Generated\Shared\Transfer\ProductAbstractDataFeedTransfer;

interface FactFinderToProductAbstractDataFeedInterface
{

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractDataFeedTransfer|null $productDataFeedTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryAbstractProductDataFeed(ProductAbstractDataFeedTransfer $productDataFeedTransfer = null);

}
