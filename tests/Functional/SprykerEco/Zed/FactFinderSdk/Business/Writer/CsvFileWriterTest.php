<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Functional\SprykerEco\Zed\FactFinderSdk\Business\Writer;

use Codeception\Configuration;
use Codeception\TestCase\Test;
use Exception;
use SprykerEco\Zed\FactFinderSdk\Business\Writer\CsvFileWriter;

/**
 * @group Functional
 * @group SprykerEco
 * @group Zed
 * @group FactFinderSdk
 * @group FactFinderSdkTest
 * @group CsvFileWriterTest
 */
class CsvFileWriterTest extends Test
{
    /**
     * @var \SprykerEco\Zed\FactFinderSdk\Business\Writer\CsvFileWriter
     */
    protected $csvFileWriter;

    /**
     * @var string
     */
    protected $filePathName;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->csvFileWriter = new CsvFileWriter();
        $this->filePathName = Configuration::outputDir() . 'test.csv';

        try {
            unlink($this->filePathName);
        } catch (Exception $e) {
        }
    }

    /**
     * @return void
     */
    public function testWrite()
    {
        $data = [
            [
                'id',
                'name',
                'url',
            ],
            [
                '938383',
                'Acer Aspire',
                'http://example.com/acer-aspire',
            ],
        ];

        $this->csvFileWriter
            ->write($this->filePathName, $data);

        $this->assertFileExists($this->filePathName);
    }
}
