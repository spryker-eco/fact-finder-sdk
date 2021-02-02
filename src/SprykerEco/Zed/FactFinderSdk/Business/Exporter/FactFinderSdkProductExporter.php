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
use SprykerEco\Zed\FactFinderSdk\Business\Writer\FileWriterInterface;
use SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToCurrencyInterface;
use SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToStoreInterface;
use SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig;
use SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface;

class FactFinderSdkProductExporter implements FactFinderSdkProductExporterInterface
{
    public const VIRTUAL_COLUMN_NAME = 'name';

    /**
     * @var \SprykerEco\Zed\FactFinderSdk\Business\Writer\FileWriterInterface
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
     * @var \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface
     */
    protected $factFinderQueryContainer;

    /**
     * @var \SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig
     */
    protected $factFinderConfig;

    /**
     * @var \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToCurrencyInterface
     */
    protected $currencyFacade;

    /**
     * @var \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToStoreInterface
     */
    protected $storeFacade;

    /**
     * @var array
     */
    private $expanders;

    /**
     * @param \SprykerEco\Zed\FactFinderSdk\Business\Writer\FileWriterInterface $fileWriter
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param \SprykerEco\Zed\FactFinderSdk\FactFinderSdkConfig $factFinderConfig
     * @param \SprykerEco\Zed\FactFinderSdk\Persistence\FactFinderSdkQueryContainerInterface $factFinderQueryContainer
     * @param \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToCurrencyInterface $currencyFacade
     * @param \SprykerEco\Zed\FactFinderSdk\Dependency\Facade\FactFinderSdkToStoreInterface $storeFacade
     * @param \SprykerEco\Zed\FactFinderSdk\Business\Expander\FactFinderSdkExpanderInterface[] $expanders
     */
    public function __construct(
        FileWriterInterface $fileWriter,
        LocaleTransfer $localeTransfer,
        FactFinderSdkConfig $factFinderConfig,
        FactFinderSdkQueryContainerInterface $factFinderQueryContainer,
        FactFinderSdkToCurrencyInterface $currencyFacade,
        FactFinderSdkToStoreInterface $storeFacade,
        $expanders
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
        $this->expanders = $expanders;
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

        $this->exportToCsv($filePath, $query, $currency, $store);
    }

    /**
     * @param string $filePath
     * @param \Orm\Zed\Product\Persistence\Base\SpyProductAbstractQuery $query
     * @param \Generated\Shared\Transfer\CurrencyTransfer $currencyTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return void
     */
    protected function exportToCsv($filePath, SpyProductAbstractQuery $query, CurrencyTransfer $currencyTransfer, StoreTransfer $storeTransfer)
    {
        $offset = 0;
        $this->saveFileHeader($filePath);

        do {
            $result = $query->limit($this->queryLimit)
                ->offset($offset)
                ->find()->toArray(FactFinderSdkConstants::ITEM_PRODUCT_NUMBER);
            $offset += $this->queryLimit;

            foreach ($result as &$product) {
                $product = $this->expandData($currencyTransfer, $storeTransfer, $product);
            }

            $this->fileWriter
                ->write($filePath, $result, true);
        } while (!empty($result));
    }

    /**
     * @param \Generated\Shared\Transfer\CurrencyTransfer $currencyTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param array $product
     *
     * @return array
     */
    protected function expandData(CurrencyTransfer $currencyTransfer, StoreTransfer $storeTransfer, $product)
    {
        foreach ($this->expanders as $expander) {
            $product = $expander->expand($this->localeTransfer, $currencyTransfer, $storeTransfer, $product);
        }

        return $this->prepareData($product);
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
     * @param string $filePath
     *
     * @return void
     */
    protected function saveFileHeader($filePath)
    {
        $header = $this->getFileHeader();
        $this->fileWriter->write($filePath, [$header]);
    }

    /**
     * @param array $product
     *
     * @return array
     */
    protected function prepareData($product)
    {
        $headers = $this->getFileHeader();

        $product = array_filter($product, function ($key) use ($headers) {
            return in_array($key, $headers);
        }, ARRAY_FILTER_USE_KEY);

        $product = array_merge(array_flip($headers), $product);

        return $product;
    }
}
