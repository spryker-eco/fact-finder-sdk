<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\FactFinderSdk;

interface FactFinderSdkConfigInterface
{
    /**
     * @return string
     */
    public function getEnvironment();

    /**
     * @return array
     */
    public function getFactFinderConfiguration();

    /**
     * @return string
     */
    public function getCsvDirectory();

    /**
     * @return string
     */
    public function getExportQueryLimit();

    /**
     * @return string
     */
    public function getExportFileNamePrefix();

    /**
     * @return string
     */
    public function getExportFileNameDelimiter();

    /**
     * @return string
     */
    public function getExportFileExtension();

    /**
     * @return string
     */
    public function getYvesHost();

    /**
     * @return array
     */
    public function getItemFields();

    /**
     * @return int
     */
    public function getCategoriesMaxCount();
}
