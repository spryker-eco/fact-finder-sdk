<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Business\Exporter;

use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\Product\Persistence\Base\SpyProductAbstractQuery;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;
use SprykerEco\Zed\FactFinderSdk\Business\Writer\AbstractFileWriter;
use SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToCurrencyInterface;
use SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToStoreInterface;
use SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig;
use SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface;

class FactFinderSdkProductExporter implements FactFinderSdkProductExporterInterface
{
    const VIRTUAL_COLUMN_NAME = 'name';

    /**
     * @var \SprykerEco\Zed\FactFinderSdk\Business\Writer\AbstractFileWriter
     */
    protected $fileWriter;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransfer;

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var int
     */
    protected $queryLimit;

    /**
     * @var string
     */
    protected $fileNamePrefix;

    /**
     * @var string
     */
    protected $fileNameDelimiter;

    /**
     * @var string
     */
    protected $fileExtension;

    /**
     * @var \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainer
     */
    protected $factFinderQueryContainer;

    /**
     * @var \SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig
     */
    protected $factFinderConfig;

    /**
     * @var \Spryker\Zed\Currency\Business\CurrencyFacadeInterface
     */
    protected $currencyFacade;

    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \SprykerEco\Zed\FactFinderSdk\Business\Writer\AbstractFileWriter $fileWriter
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param \SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig $factFinderConfig
     * @param \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface $factFinderQueryContainer
     * @param \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToCurrencyInterface $currencyFacade
     * @param \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToStoreInterface $storeFacade
     */
    public function __construct(
        AbstractFileWriter $fileWriter,
        LocaleTransfer $localeTransfer,
        FactFinderSdkConfig $factFinderConfig,
        FactFinderSdkQueryContainerInterface $factFinderQueryContainer,
        FactFinderSdkToCurrencyInterface $currencyFacade,
        FactFinderSdkToStoreInterface $storeFacade
    ) {

        $this->fileWriter = $fileWriter;
        $this->localeTransfer = $localeTransfer;
        $this->queryLimit = $factFinderConfig->getExportQueryLimit();
        $this->fileNamePrefix = $factFinderConfig->getExportFileNamePrefix();
        $this->fileNameDelimiter = $factFinderConfig->getExportFileNameDelimiter();
        $this->fileExtension = $factFinderConfig->getExportFileExtension();
        $this->factFinderQueryContainer = $factFinderQueryContainer;
        $this->factFinderConfig = $factFinderConfig;
        $this->currencyFacade = $currencyFacade;
        $this->storeFacade = $storeFacade;
    }

    /**
     * @return void
     */
    public function export()
    {
        $currency = $this->currencyFacade->getDefaultCurrencyForCurrentStore();
        $store = $this->storeFacade->getCurrentStore();

        $query = $this->factFinderQueryContainer
            ->getExportDataQuery($this->localeTransfer, $store, $currency);

        if (!$this->productsExists($query)) {
            return;
        }
        $filePath = $this->getFilePath($this->localeTransfer, $store, $currency);

        $this->exportToCsv($filePath, $query);
    }

    /**
     * @param string $filePath
     * @param \Orm\Zed\Product\Persistence\Base\SpyProductAbstractQuery $query
     *
     * @return void
     */
    protected function exportToCsv($filePath, SpyProductAbstractQuery $query)
    {
        $offset = 0;
        $this->saveFileHeader($filePath);

        do {
            $result = $query->limit($this->queryLimit)
                ->offset($offset)
                ->find()
                ->toArray(FactFinderSdkConstants::ITEM_PRODUCT_NUMBER);
            $offset += $this->queryLimit;

            $prepared = $this->prepareDataForExport($result, $this->localeTransfer);

            $this->fileWriter
                ->write($filePath, $prepared, true);
        } while (!empty($result));
    }

    /**
     * @param \Orm\Zed\Product\Persistence\Base\SpyProductAbstractQuery $query
     *
     * @return bool
     */
    protected function productsExists(SpyProductAbstractQuery $query)
    {
        $productsCount = $query->limit($this->queryLimit)
            ->count();
        return $productsCount > 0;
    }

    /**
     * @return array
     */
    protected function getFileHeader()
    {
        return $this->factFinderConfig->getItemFields();
    }

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param \Generated\Shared\Transfer\CurrencyTransfer $currencyTransfer
     *
     * @return string
     */
    protected function getFilePath(LocaleTransfer $localeTransfer, StoreTransfer $storeTransfer, CurrencyTransfer $currencyTransfer)
    {
        $directory = $this->factFinderConfig
            ->getCsvDirectory();
        $fileNameParts = [
            $directory,
            $this->fileNamePrefix,
            $this->fileNameDelimiter,
            $localeTransfer->getLocaleName(),
            $this->fileNameDelimiter,
            $storeTransfer->getName(),
            $this->fileNameDelimiter,
            $currencyTransfer->getName(),
            $this->fileExtension,
        ];

        return implode('', $fileNameParts);
    }

    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return array
     */
    protected function prepareDataForExport($data, LocaleTransfer $localeTransfer)
    {
        $headers = $this->getFileHeader();
        $dataForExport = [];

        foreach ($data as $row) {
            $prepared = [];
            $categoriesPathArray = $this->getCategoryPathArray($localeTransfer, $row['IdProductAbstract']);
            $row = $this->addProductUrl($row);
            $row = $this->addCategoryPath($row, $categoriesPathArray);
            $row = $this->convertPrice($row);
            $row = $this->encodeDescription($row);

            foreach ($headers as $headerName) {
                if (isset($row[$headerName])) {
                    $prepared[$headerName] = $row[$headerName];
                }
            }

            $dataForExport[] = $prepared;
        }

        return $dataForExport;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function addProductUrl($data)
    {
        $productUrl = $this->factFinderConfig
                ->getYvesHost() . $data[FactFinderSdkConstants::ITEM_PRODUCT_URL];
        $data[FactFinderSdkConstants::ITEM_PRODUCT_URL] = $productUrl;

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function encodeDescription($data)
    {
        $data[FactFinderSdkConstants::ITEM_DESCRIPTION] = quotemeta($data[FactFinderSdkConstants::ITEM_DESCRIPTION]);

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function convertPrice($data)
    {
        $data[FactFinderSdkConstants::ITEM_PRICE] = number_format($data[FactFinderSdkConstants::ITEM_PRICE] / 100, 2, '.', '');

        return $data;
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

        $query = $this->factFinderQueryContainer
            ->getCategories($localeTransfer, $idProductAbstract);
        $categories = $query->find();

        if (!$categories) {
            return $pathArray;
        }

        foreach ($categories as $category) {
            $pathArray[] = $this->getCategoryPath($category);
        }

        return $pathArray;
    }

    /**
     * @param \Orm\Zed\Category\Persistence\SpyCategory $category
     * @param array $path
     *
     * @return string
     */
    protected function getCategoryPath($category, $path = [])
    {
        /** @var \Orm\Zed\Category\Persistence\SpyCategoryNode $node */
        $node = $category->getNodes()
            ->getFirst();

        if ($node->getFkParentCategoryNode()) {
            $parentCategory = $this->factFinderQueryContainer
                ->getCategory($node->getParentCategoryNode()->getFkCategory(), $this->localeTransfer)
                ->find()
                ->getFirst();
            $path = array_merge($path, $this->getCategoryPath($parentCategory, $path));
        }

        if ($category->isSearchable()) {
            $path[] = $category->getVirtualColumn(static::VIRTUAL_COLUMN_NAME);
        }

        return $path;
    }

    /**
     * @param string $filePath
     *
     * @return void
     */
    protected function saveFileHeader($filePath)
    {
        $header = $this->getFileHeader();
        $this->fileWriter->write($filePath, [$header]);
    }
}
