<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi\Dependency\Persistence;

use Generated\Shared\Transfer\CategoryDataFeedTransfer;

class FactFinderApiToCategoryDataFeedBridge implements FactFinderApiToCategoryDataFeedInterface
{

    /**
     * @var \Spryker\Zed\CategoryDataFeed\Persistence\CategoryDataFeedQueryContainerInterface
     */
    protected $categoryDataFeedQueryContainer;

    /**
     * FactFinderToCategoryDataFeedBridge constructor.
     *
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
