<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api;

/**
 * @SuppressWarnings(ModuleConstantsPathRule)
 * @SuppressWarnings(ModuleConstantsTypeRule)
 */
class ApiConstants
{
    public const REQUEST_FORMAT = 'json';

    public const TRANSACTION_TYPE_SEARCH = 'search';
    public const TRANSACTION_TYPE_RECOMMENDATION = 'recommendation';
    public const TRANSACTION_TYPE_SUGGEST = 'suggest';
    public const TRANSACTION_TYPE_TAG_CLOUD = 'tag_cloud';
    public const TRANSACTION_TYPE_TRACKING = 'tracking';
    public const TRANSACTION_TYPE_SIMILAR_RECORDS = 'similar_records';
    public const TRANSACTION_TYPE_PRODUCT_CAMPAIGN = 'product_campaign';
}
