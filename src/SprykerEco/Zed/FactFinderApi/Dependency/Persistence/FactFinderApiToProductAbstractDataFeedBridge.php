<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi\Dependency\Persistence;

use Generated\Shared\Transfer\ProductAbstractDataFeedTransfer;

class FactFinderApiToProductAbstractDataFeedBridge implements FactFinderApiToProductAbstractDataFeedInterface
{

    /**
     * @var \Spryker\Zed\ProductAbstractDataFeed\Persistence\ProductAbstractDataFeedQueryContainerInterface
     */
    protected $productAbstractDataFeed;

    /**
     * FactFinderToProductAbstractDataFeedBridge constructor.
     *
     * @param \Spryker\Zed\ProductAbstractDataFeed\Persistence\ProductAbstractDataFeedQueryContainerInterface $productAbstractDataFeed
     */
    public function __construct($productAbstractDataFeed)
    {
        $this->productAbstractDataFeed = $productAbstractDataFeed;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractDataFeedTransfer|null $productDataFeedTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryAbstractProductDataFeed(ProductAbstractDataFeedTransfer $productDataFeedTransfer = null)
    {
        return $this->productAbstractDataFeed->queryAbstractProductDataFeed($productDataFeedTransfer);
    }

}
