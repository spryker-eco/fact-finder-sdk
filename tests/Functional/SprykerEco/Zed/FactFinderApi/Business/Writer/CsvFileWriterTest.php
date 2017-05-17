<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Functional\SprykerEco\Zed\FactFinderApi\Business\Writer;

use Codeception\Configuration;
use Codeception\TestCase\Test;
use SprykerEco\Zed\FactFinderApi\Business\Writer\CsvFileWriter;

/**
 * @group Functional
 * @group SprykerEco
 * @group Zed
 * @group FactFinderApi
 * @group FactFinderApiTest
 * @group CsvFileWriterTest
 */
class CsvFileWriterTest extends Test
{

    /**
     * @var CsvFileWriter
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

        @unlink($this->filePathName);
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
            ]
        ];

        $this->csvFileWriter
            ->write($this->filePathName, $data);

        $this->assertFileExists($this->filePathName);
    }

}
