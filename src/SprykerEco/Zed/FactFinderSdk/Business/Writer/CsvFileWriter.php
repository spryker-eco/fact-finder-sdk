<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Business\Writer;

class CsvFileWriter extends AbstractFileWriter
{
    const DELIMITER = ',';

    /**
     * @param string $filePath
     * @param array $data
     * @param bool $append
     *
     * @return void
     */
    public function write($filePath, $data, $append = false)
    {
        $this->createDirectory($filePath);

        if ($append) {
            $filePointer = fopen($filePath, 'a');
        } else {
            $filePointer = fopen($filePath, 'w');
        }

        foreach ($data as $row) {
            fputcsv($filePointer, $row, self::DELIMITER);
        }

        fclose($filePointer);
    }
}
