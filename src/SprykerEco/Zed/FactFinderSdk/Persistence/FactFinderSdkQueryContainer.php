<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Persistence;

use Generated\Shared\Transfer\CategoryDataFeedTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductAbstractDataFeedTransfer;
use Orm\Zed\Category\Persistence\Map\SpyCategoryAttributeTableMap;
use Orm\Zed\Category\Persistence\Map\SpyCategoryNodeTableMap;
use Orm\Zed\Category\Persistence\Map\SpyCategoryTableMap;
use Orm\Zed\Price\Persistence\Map\SpyPriceProductTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductLocalizedAttributesTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\ProductCategory\Persistence\Map\SpyProductCategoryTableMap;
use Orm\Zed\ProductImage\Persistence\Map\SpyProductImageTableMap;
use Orm\Zed\Stock\Persistence\Map\SpyStockProductTableMap;
use Orm\Zed\Url\Persistence\Map\SpyUrlTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

/**
 * @method \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkPersistenceFactory getFactory()
 */
class FactFinderSdkQueryContainer extends AbstractQueryContainer implements FactFinderSdkQueryContainerInterface
{

    const STOCK_QUANTITY_CONDITION = 'STOCK_QUANTITY_CONDITION';
    const STOCK_NEVER_OUTOFSTOCK_CONDITION = 'STOCK_NEVER_OUTOFSTOCK_CONDITION';

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function getExportDataQuery(LocaleTransfer $localeTransfer)
    {
        $productAbstractDataFeedTransfer = new ProductAbstractDataFeedTransfer();
        $productAbstractDataFeedTransfer->setJoinProduct(true);
        $productAbstractDataFeedTransfer->setJoinCategory(true);
        $productAbstractDataFeedTransfer->setJoinImage(true);
        $productAbstractDataFeedTransfer->setJoinPrice(true);

        $productAbstractDataFeedTransfer->setIdLocale($localeTransfer->getIdLocale());

        $productsAbstractQuery = $this->getFactory()
            ->getProductAbstractDataFeedQueryContainer()
            ->queryAbstractProductDataFeed($productAbstractDataFeedTransfer);

        $productsAbstractQuery
            ->useSpyUrlQuery()
                ->filterByFkLocale($localeTransfer->getIdLocale())
            ->endUse();

        $productsAbstractQuery = $this->addColumns($productsAbstractQuery);
//        $productsAbstractQuery = $this->addInStockConditions($productsAbstractQuery);

        return $productsAbstractQuery;
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param int $categoryId
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery
     */
    public function getParentCategoryQuery(LocaleTransfer $localeTransfer, $categoryId)
    {
        $categoryDataFeedTransfer = new CategoryDataFeedTransfer();
        $categoryDataFeedTransfer->setIdLocale($localeTransfer->getIdLocale());

        $categoryQuery = $this->getFactory()
            ->getCategoryDataFeedQueryContainer()
            ->queryCategoryDataFeed($categoryDataFeedTransfer);

        $categoryQuery->where(SpyCategoryTableMap::COL_ID_CATEGORY . ' = ?', $categoryId);

        return $categoryQuery;
    }

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstractQuery $productsAbstractQuery
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    protected function addColumns(SpyProductAbstractQuery $productsAbstractQuery)
    {
        $productsAbstractQuery->withColumn(SpyProductTableMap::COL_SKU, FactFinderSdkConstants::ITEM_PRODUCT_NUMBER);
        $productsAbstractQuery->withColumn(SpyProductLocalizedAttributesTableMap::COL_NAME, FactFinderSdkConstants::ITEM_NAME);
        $productsAbstractQuery->withColumn(SpyPriceProductTableMap::COL_PRICE, FactFinderSdkConstants::ITEM_PRICE);
        $productsAbstractQuery->withColumn(SpyStockProductTableMap::COL_QUANTITY, FactFinderSdkConstants::ITEM_STOCK);
        $productsAbstractQuery->withColumn(SpyCategoryAttributeTableMap::COL_NAME, FactFinderSdkConstants::ITEM_CATEGORY);
        $productsAbstractQuery->withColumn(SpyProductImageTableMap::COL_EXTERNAL_URL_LARGE, FactFinderSdkConstants::ITEM_IMAGE_URL);
        $productsAbstractQuery->withColumn(SpyProductLocalizedAttributesTableMap::COL_DESCRIPTION, FactFinderSdkConstants::ITEM_DESCRIPTION);
        $productsAbstractQuery->withColumn(SpyProductCategoryTableMap::COL_FK_CATEGORY, FactFinderSdkConstants::ITEM_CATEGORY_ID);
        $productsAbstractQuery->withColumn(SpyCategoryNodeTableMap::COL_FK_PARENT_CATEGORY_NODE, FactFinderSdkConstants::ITEM_PARENT_CATEGORY_NODE_ID);
        $productsAbstractQuery->withColumn(SpyUrlTableMap::COL_URL, FactFinderSdkConstants::ITEM_PRODUCT_URL);
        $productsAbstractQuery->withColumn(SpyProductTableMap::COL_SKU, FactFinderSdkConstants::ITEM_MASTER_ID);

        return $productsAbstractQuery;
    }

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstractQuery $productsAbstractQuery
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    protected function addInStockConditions(SpyProductAbstractQuery $productsAbstractQuery)
    {
        $productsAbstractQuery->condition(
            self::STOCK_QUANTITY_CONDITION,
            SpyStockProductTableMap::COL_QUANTITY . ' > 0 '
        );
        $productsAbstractQuery->condition(
            self::STOCK_NEVER_OUTOFSTOCK_CONDITION,
            SpyStockProductTableMap::COL_IS_NEVER_OUT_OF_STOCK . ' = true'
        );
        $productsAbstractQuery->where([
            self::STOCK_QUANTITY_CONDITION,
            self::STOCK_NEVER_OUTOFSTOCK_CONDITION,
        ], Criteria::LOGICAL_OR);

        return $productsAbstractQuery;
    }

}
