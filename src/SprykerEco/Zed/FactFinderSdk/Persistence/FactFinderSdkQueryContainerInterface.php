<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Persistence;

use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface FactFinderSdkQueryContainerInterface extends QueryContainerInterface
{
    /**
     * Specification:
     * - Finds product abstract entities filtered by locale and sorted by sku.
     *
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
    public function getExportDataQuery(LocaleTransfer $localeTransfer, StoreTransfer $storeTransfer, CurrencyTransfer $currencyTransfer);

    /**
     * Specification:
     * - Finds category entities filtered by locale and product abstract ID.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param int $idProductAbstract
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery
     */
    public function getCategoriesQuery(LocaleTransfer $localeTransfer, $idProductAbstract);

    /**
     * Specification:
     * - Finds category entity by category ID and locale.
     *
     * @api
     *
     * @param int $idCategory
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery
     */
    public function getCategoryQuery($idCategory, LocaleTransfer $localeTransfer);

    /**
     * Specification:
     * - Finds product review entities filtered by product abstract ID and locale.
     *
     * @api
     *
     * @param int $idProductAbstract
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function getReviewsQuery($idProductAbstract, LocaleTransfer $localeTransfer);

    /**
     * Specification:
     * - Finds price product concrete entities filtered by concrete product sku, locale and store.
     *
     * @api
     *
     * @param string $concreteProductSku
     * @param \Generated\Shared\Transfer\CurrencyTransfer $currencyTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery
     */
    public function getPricesQuery($concreteProductSku, CurrencyTransfer $currencyTransfer, StoreTransfer $storeTransfer);

    /**
     * Specification:
     * - Finds price product abstract entities filtered by concrete product sku, locale and store.
     *
     * @api
     *
     * @param string $concreteProductSku
     * @param \Generated\Shared\Transfer\CurrencyTransfer $currencyTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery
     */
    public function getProductAbstractPriceQuery($concreteProductSku, CurrencyTransfer $currencyTransfer, StoreTransfer $storeTransfer);
}
