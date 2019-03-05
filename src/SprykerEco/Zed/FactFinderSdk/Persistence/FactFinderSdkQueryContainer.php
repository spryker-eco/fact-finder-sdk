<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Persistence;

use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductAbstractDataFeedTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\Category\Persistence\Map\SpyCategoryAttributeTableMap;
use Orm\Zed\Category\Persistence\Map\SpyCategoryTableMap;
use Orm\Zed\PriceProduct\Persistence\Map\SpyPriceProductStoreTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
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
    public const STOCK_QUANTITY_CONDITION = 'STOCK_QUANTITY_CONDITION';
    public const STOCK_NEVER_OUTOFSTOCK_CONDITION = 'STOCK_NEVER_OUTOFSTOCK_CONDITION';

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param \Generated\Shared\Transfer\CurrencyTransfer $currencyTransfer
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function getExportDataQuery(LocaleTransfer $localeTransfer, StoreTransfer $storeTransfer, CurrencyTransfer $currencyTransfer)
    {
        $productAbstractDataFeedTransfer = new ProductAbstractDataFeedTransfer();
        $productAbstractDataFeedTransfer->setJoinProduct(true);
        $productAbstractDataFeedTransfer->setJoinImage(true);

        $productAbstractDataFeedTransfer->setIdLocale($localeTransfer->getIdLocale());

        $productsAbstractQuery = $this->getFactory()
            ->getProductAbstractDataFeedQueryContainer()
            ->queryAbstractProductDataFeed($productAbstractDataFeedTransfer);

        $productsAbstractQuery
            ->useSpyUrlQuery()
                ->filterByFkLocale($localeTransfer->getIdLocale())
            ->endUse();

        $productsAbstractQuery = $this->addColumns($productsAbstractQuery);

        $productsAbstractQuery->orderBySku();

        return $productsAbstractQuery;
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param int $idProductAbstract
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery
     */
    public function getCategoriesQuery(LocaleTransfer $localeTransfer, $idProductAbstract)
    {
        $categoryQuery = $this->getFactory()
            ->createCategoryQuery();
        $categoryQuery->joinWithSpyProductCategory(Criteria::LEFT_JOIN)
            ->joinWithAttribute(Criteria::INNER_JOIN)
            ->where(SpyProductCategoryTableMap::COL_FK_PRODUCT_ABSTRACT . ' = ?', $idProductAbstract)
            ->where(SpyCategoryAttributeTableMap::COL_FK_LOCALE . ' = ?', $localeTransfer->getIdLocale())
            ->withColumn(SpyCategoryAttributeTableMap::COL_NAME, 'name');

        return $categoryQuery;
    }

    /**
     * @api
     *
     * @param int $idCategory
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery
     */
    public function getCategoryQuery($idCategory, LocaleTransfer $localeTransfer)
    {
        $categoryQuery = $this->getFactory()
            ->createCategoryQuery();
        $categoryQuery->joinWithAttribute(Criteria::INNER_JOIN);

        $categoryQuery->where(SpyCategoryTableMap::COL_ID_CATEGORY . ' = ?', $idCategory);
        $categoryQuery->where(SpyCategoryAttributeTableMap::COL_FK_LOCALE . ' = ?', $localeTransfer->getIdLocale());
        $categoryQuery->withColumn(SpyCategoryAttributeTableMap::COL_NAME, 'name');

        return $categoryQuery;
    }

    /**
     * @api
     *
     * @param string $concreteProductSku
     * @param \Generated\Shared\Transfer\CurrencyTransfer $currencyTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery
     */
    public function getPricesQuery($concreteProductSku, CurrencyTransfer $currencyTransfer, StoreTransfer $storeTransfer)
    {
        $priceProductQuery = $this->getFactory()
            ->createPriceProductQuery();

        $priceProductQuery
            ->useProductQuery()
                ->filterBySku($concreteProductSku)
            ->endUse()
            ->usePriceProductStoreQuery()
                ->filterByFkCurrency($currencyTransfer->getIdCurrency())
                ->filterByFkStore($storeTransfer->getIdStore())
            ->endUse();

        $priceProductQuery->withColumn(SpyPriceProductStoreTableMap::COL_GROSS_PRICE, FactFinderSdkConstants::ITEM_PRICE);

        return $priceProductQuery;
    }

    /**
     * @api
     *
     * @param string $concreteProductSku
     * @param \Generated\Shared\Transfer\CurrencyTransfer $currencyTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery
     */
    public function getProductAbstractPriceQuery($concreteProductSku, CurrencyTransfer $currencyTransfer, StoreTransfer $storeTransfer)
    {
        $priceProductQuery = $this->getFactory()
            ->createPriceProductQuery();

        $priceProductQuery
            ->useSpyProductAbstractQuery()
                ->useSpyProductQuery()
                    ->filterBySku($concreteProductSku)
                ->endUse()
            ->endUse()
            ->usePriceProductStoreQuery()
                ->filterByFkCurrency($currencyTransfer->getIdCurrency())
                ->filterByFkStore($storeTransfer->getIdStore())
            ->endUse();

        $priceProductQuery->withColumn(SpyPriceProductStoreTableMap::COL_GROSS_PRICE, FactFinderSdkConstants::ITEM_PRICE);

        return $priceProductQuery;
    }

    /**
     * @api
     *
     * @param int $idProductAbstract
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function getReviewsQuery($idProductAbstract, LocaleTransfer $localeTransfer)
    {
        $productAbstractDataFeedTransfer = new ProductAbstractDataFeedTransfer();
        $productAbstractDataFeedTransfer->setIdLocale($localeTransfer->getIdLocale());

        $query = $this->getFactory()
            ->getProductAbstractDataFeedQueryContainer()
            ->queryAbstractProductDataFeed($productAbstractDataFeedTransfer);

        $query
            ->leftJoinWithSpyProductReview()
            ->useSpyProductReviewQuery()
                ->filterByFkProductAbstract($idProductAbstract)
            ->endUse();

        return $query;
    }

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstractQuery $productsAbstractQuery
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    protected function addColumns(SpyProductAbstractQuery $productsAbstractQuery)
    {
        $productsAbstractQuery->select([
            SpyProductTableMap::COL_SKU,
            SpyProductLocalizedAttributesTableMap::COL_NAME,
            SpyStockProductTableMap::COL_QUANTITY,
            SpyProductImageTableMap::COL_EXTERNAL_URL_SMALL,
            SpyProductLocalizedAttributesTableMap::COL_DESCRIPTION,
            SpyUrlTableMap::COL_URL,
            SpyProductAbstractTableMap::COL_SKU,
            SpyProductTableMap::COL_ATTRIBUTES,
            SpyProductAbstractTableMap::COL_ATTRIBUTES,
        ]);

        $productsAbstractQuery->withColumn(SpyProductTableMap::COL_SKU, FactFinderSdkConstants::ITEM_PRODUCT_NUMBER);
        $productsAbstractQuery->withColumn(SpyProductLocalizedAttributesTableMap::COL_NAME, FactFinderSdkConstants::ITEM_NAME);
        $productsAbstractQuery->withColumn(SpyStockProductTableMap::COL_QUANTITY, FactFinderSdkConstants::ITEM_STOCK);
        $productsAbstractQuery->withColumn(SpyProductImageTableMap::COL_EXTERNAL_URL_SMALL, FactFinderSdkConstants::ITEM_IMAGE_URL);
        $productsAbstractQuery->withColumn(SpyProductLocalizedAttributesTableMap::COL_DESCRIPTION, FactFinderSdkConstants::ITEM_DESCRIPTION);
        $productsAbstractQuery->withColumn(SpyUrlTableMap::COL_URL, FactFinderSdkConstants::ITEM_PRODUCT_URL);
        $productsAbstractQuery->withColumn(SpyProductAbstractTableMap::COL_SKU, FactFinderSdkConstants::ITEM_MASTER_ID);
        $productsAbstractQuery->withColumn(SpyProductTableMap::COL_ATTRIBUTES, FactFinderSdkConstants::ITEM_CONCRETE_PRODUCT_ATTRIBUTES);
        $productsAbstractQuery->withColumn(SpyProductAbstractTableMap::COL_ATTRIBUTES, FactFinderSdkConstants::ITEM_ABSTRACT_PRODUCT_ATTRIBUTES);
        $productsAbstractQuery->withColumn(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, FactFinderSdkConstants::ITEM_ID_ABSTRACT_PRODUCT);
        $productsAbstractQuery->withColumn(SpyProductTableMap::COL_CREATED_AT, FactFinderSdkConstants::ITEM_CREATED_AT);
        $productsAbstractQuery->withColumn(SpyProductAbstractTableMap::COL_NEW_FROM, FactFinderSdkConstants::ITEM_NEW_FROM);
        $productsAbstractQuery->withColumn(SpyProductAbstractTableMap::COL_NEW_TO, FactFinderSdkConstants::ITEM_NEW_TO);

        return $productsAbstractQuery;
    }
}
