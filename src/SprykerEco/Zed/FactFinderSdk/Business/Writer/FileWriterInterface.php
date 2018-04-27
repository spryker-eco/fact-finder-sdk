<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk\Business\Writer;

interface FileWriterInterface
{
    /**
     * @param string $filePath
     * @param array $data
     * @param bool $append
     *
     * @return void
     */
    public function write($filePath, $data, $append = false);
}
