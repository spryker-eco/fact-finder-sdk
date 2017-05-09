<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinder\Persistence;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface FactFinderQueryContainerInterface extends QueryContainerInterface
{

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function getExportDataQuery(LocaleTransfer $localeTransfer);

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param int $rootCategoryNodeId
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery
     */
    public function getParentCategoryQuery(LocaleTransfer $localeTransfer, $rootCategoryNodeId);

}
