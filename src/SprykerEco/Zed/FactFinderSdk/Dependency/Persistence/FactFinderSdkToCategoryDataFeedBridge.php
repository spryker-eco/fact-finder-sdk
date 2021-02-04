<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Dependency\Persistence;

use Generated\Shared\Transfer\CategoryDataFeedTransfer;

/**
 * @SuppressWarnings(BridgeNameRule)
 */
class FactFinderSdkToCategoryDataFeedBridge implements FactFinderSdkToCategoryDataFeedInterface
{
    /**
     * @var \Spryker\Zed\CategoryDataFeed\Persistence\CategoryDataFeedQueryContainerInterface
     */
    protected $categoryDataFeedQueryContainer;

    /**
     * @param \Spryker\Zed\CategoryDataFeed\Persistence\CategoryDataFeedQueryContainerInterface $categoryDataFeedQueryContainer
     */
    public function __construct($categoryDataFeedQueryContainer)
    {
        $this->categoryDataFeedQueryContainer = $categoryDataFeedQueryContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryDataFeedTransfer $categoryDataFeedTransfer
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery
     */
    public function queryCategoryDataFeed(CategoryDataFeedTransfer $categoryDataFeedTransfer)
    {
        return $this->categoryDataFeedQueryContainer
            ->queryCategoryDataFeed($categoryDataFeedTransfer);
    }
}
