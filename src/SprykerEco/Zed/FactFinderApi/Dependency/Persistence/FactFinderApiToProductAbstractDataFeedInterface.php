<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi\Dependency\Persistence;

use Generated\Shared\Transfer\ProductAbstractDataFeedTransfer;

interface FactFinderApiToProductAbstractDataFeedInterface
{

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractDataFeedTransfer|null $productDataFeedTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryAbstractProductDataFeed(ProductAbstractDataFeedTransfer $productDataFeedTransfer = null);

}
