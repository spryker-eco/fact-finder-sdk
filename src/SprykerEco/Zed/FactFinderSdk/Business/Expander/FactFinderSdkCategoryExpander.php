<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Business\Expander;

use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class FactFinderSdkCategoryExpander extends FactFinderSdkAbstractExpander
{
    public const VIRTUAL_COLUMN_NAME = 'name';

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param \Generated\Shared\Transfer\CurrencyTransfer $currencyTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param array $productData
     *
     * @return array
     */
    public function expand(LocaleTransfer $localeTransfer, CurrencyTransfer $currencyTransfer, StoreTransfer $storeTransfer, $productData)
    {
        $categoryPathArray = $this->getCategoryPathArray($localeTransfer, $productData[FactFinderSdkConstants::ITEM_ID_ABSTRACT_PRODUCT]);
        $productData = $this->addCategoryPath($productData, $categoryPathArray);

        return $productData;
    }

    /**
     * @param array $data
     * @param array $categoriesPathArray
     *
     * @return array
     */
    protected function addCategoryPath($data, $categoriesPathArray)
    {
        if (empty($data[FactFinderSdkConstants::ITEM_CATEGORY_PATH])) {
            $data[FactFinderSdkConstants::ITEM_CATEGORY_PATH] = '';
        }

        foreach ($categoriesPathArray as $key => $pathArray) {
            $pathArray = array_map(function ($value) {
                return urlencode($value);
            }, $pathArray);
            $data[FactFinderSdkConstants::ITEM_CATEGORY_PATH] .= implode('/', $pathArray) . '|';
        }

        return $data;
    }

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param int $idProductAbstract
     *
     * @return array
     */
    protected function getCategoryPathArray(LocaleTransfer $localeTransfer, $idProductAbstract)
    {
        $pathArray = [];

        $query = $this->queryContainer
            ->getCategoriesQuery($localeTransfer, $idProductAbstract);
        $categories = $query->find();

        if (!$categories) {
            return $pathArray;
        }

        foreach ($categories as $category) {
            $pathArray[] = $this->getCategoryPath($localeTransfer, $category);
        }

        return $pathArray;
    }

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param \Orm\Zed\Category\Persistence\SpyCategory $category
     * @param array $path
     *
     * @return string
     */
    protected function getCategoryPath(LocaleTransfer $localeTransfer, $category, $path = [])
    {
        /** @var \Orm\Zed\Category\Persistence\SpyCategoryNode $node */
        $node = $category->getNodes()
            ->getFirst();

        if ($node->getFkParentCategoryNode()) {
            $parentCategory = $this->queryContainer
                ->getCategoryQuery($node->getParentCategoryNode()->getFkCategory(), $localeTransfer)
                ->find()
                ->getFirst();
            $path = array_merge($path, $this->getCategoryPath($localeTransfer, $parentCategory, $path));
        }

        if ($category->isSearchable()) {
            $path[] = $category->getVirtualColumn(static::VIRTUAL_COLUMN_NAME);
        }

        return $path;
    }
}
