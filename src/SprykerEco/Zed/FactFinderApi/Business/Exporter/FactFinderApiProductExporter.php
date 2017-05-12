<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderApi\Business\Exporter;

use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\Product\Persistence\Base\SpyProductAbstractQuery;
use SprykerEco\Shared\FactFinderApi\FactFinderApiConstants;
use SprykerEco\Zed\FactFinderApi\Business\Writer\AbstractFileWriter;
use SprykerEco\Zed\FactFinderApi\Dependency\Facade\FactFinderApiToMoneyInterface;
use SprykerEco\Zed\FactFinderApi\FactFinderApiConfig;
use SprykerEco\Zed\FactFinderApi\Persistence\FactFinderApiQueryContainerInterface;

class FactFinderApiProductExporter implements FactFinderApiProductExporterInterface
{

    /**
     * @var \SprykerEco\Zed\FactFinderApi\Business\Writer\AbstractFileWriter
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
     * @var \SprykerEco\Zed\FactFinderApi\Persistence\FactFinderApiQueryContainer
     */
    protected $factFinderQueryContainer;

    /**
     * @var \SprykerEco\Zed\FactFinderApi\FactFinderApiConfig
     */
    protected $factFinderConfig;

    /**
     * @var \SprykerEco\Zed\FactFinderApi\Dependency\Facade\FactFinderApiToMoneyInterface
     */
    private $money;

    /**
     * FactFinderProductExporterPlugin constructor.
     *
     * @param \SprykerEco\Zed\FactFinderApi\Business\Writer\AbstractFileWriter $fileWriter
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param \SprykerEco\Zed\FactFinderApi\FactFinderApiConfig $factFinderConfig
     * @param \SprykerEco\Zed\FactFinderApi\Persistence\FactFinderApiQueryContainerInterface $factFinderQueryContainer
     * @param \SprykerEco\Zed\FactFinderApi\Dependency\Facade\FactFinderApiToMoneyInterface $money
     */
    public function __construct(
        AbstractFileWriter $fileWriter,
        LocaleTransfer $localeTransfer,
        FactFinderApiConfig $factFinderConfig,
        FactFinderApiQueryContainerInterface $factFinderQueryContainer,
        FactFinderApiToMoneyInterface $money
    ) {

        $this->fileWriter = $fileWriter;
        $this->localeTransfer = $localeTransfer;
        $this->queryLimit = $factFinderConfig->getExportQueryLimit();
        $this->fileNamePrefix = $factFinderConfig->getExportFileNamePrefix();
        $this->fileNameDelimiter = $factFinderConfig->getExportFileNameDelimiter();
        $this->fileExtension = $factFinderConfig->getExportFileExtension();
        $this->factFinderQueryContainer = $factFinderQueryContainer;
        $this->factFinderConfig = $factFinderConfig;
        $this->money = $money;
    }

    /**
     * @return void
     */
    public function export()
    {
        $query = $this->factFinderQueryContainer
            ->getExportDataQuery($this->localeTransfer);

        if (!$this->productsExists($query)) {
            return;
        }
        $filePath = $this->getFilePath($this->localeTransfer->getLocaleName());

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
                ->toArray();
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
        return FactFinderApiConstants::ITEM_FIELDS;
    }

    /**
     * @param string $localeName
     *
     * @return string
     */
    protected function getFilePath($localeName)
    {
        $directory = $this->factFinderConfig
            ->getCsvDirectory();
        $fileName = $this->fileNamePrefix . $this->fileNameDelimiter . $localeName . $this->fileExtension;

        return $directory . $fileName;
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
            $row = $this->addProductUrl($row);
            $row = $this->convertPrice($row);
            $row = $this->addCategoryPath($row, $localeTransfer);

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
                ->getYvesHost() . $data[FactFinderApiConstants::ITEM_PRODUCT_URL];
        $data[FactFinderApiConstants::ITEM_PRODUCT_URL] = $productUrl;

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array mixed
     */
    protected function convertPrice($data)
    {
        $price = $this->money
            ->convertIntegerToDecimal($data[FactFinderApiConstants::ITEM_PRICE]);

        $data[FactFinderApiConstants::ITEM_PRICE] = $price;

        return $data;
    }

    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return array
     */
    protected function addCategoryPath($data, LocaleTransfer $localeTransfer)
    {
        $parentCategoryName = $this->getParentСategoryName(
            $localeTransfer,
            $data[FactFinderApiConstants::ITEM_PARENT_CATEGORY_NODE_ID]
        );

        if (empty($parentCategoryName)) {
            $categoryPath = urlencode($data[FactFinderApiConstants::ITEM_CATEGORY]);
        } else {
            $categoryPath = $parentCategoryName . '/' . urlencode($data[FactFinderApiConstants::ITEM_CATEGORY]);
        }
        $data[FactFinderApiConstants::ITEM_CATEGORY_PATH] = $categoryPath;

        return $data;
    }

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param int $rootCategoryNodeId
     *
     * @return string
     */
    protected function getParentСategoryName(LocaleTransfer $localeTransfer, $rootCategoryNodeId)
    {
        $query = $this->factFinderQueryContainer
            ->getParentCategoryQuery($localeTransfer, $rootCategoryNodeId);
        $category = $query->findOne();

        if (!$category) {
            return '';
        }

        return $category->getName();
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
