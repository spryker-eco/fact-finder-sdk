<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\FactFinderSdk;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 *
 * @SuppressWarnings(ModuleConstantsFormingConstantValuesRule)
 */
interface FactFinderSdkConstants
{
    public const ENVIRONMENT = 'FACT_FINDER_SDK:ENVIRONMENT';
    public const ENVIRONMENT_PRODUCTION = 'FACT_FINDER_SDK:ENVIRONMENT_PRODUCTION';
    public const ENVIRONMENT_DEVELOPMENT = 'FACT_FINDER_SDK:ENVIRONMENT_DEVELOPMENT';
    public const ENVIRONMENT_TEST = 'FACT_FINDER_SDK:ENVIRONMENT_TEST';
    public const CSV_DIRECTORY = 'FACT_FINDER_SDK:CSV_DIRECTORY';
    public const EXPORT_QUERY_LIMIT = 'FACT_FINDER_SDK:EXPORT_QUERY_LIMIT';
    public const EXPORT_FILE_NAME_PREFIX = 'FACT_FINDER_SDK:EXPORT_FILE_NAME_PREFIX';
    public const EXPORT_FILE_NAME_DELIMITER = 'FACT_FINDER_SDK:EXPORT_FILE_NAME_DELIMITER';
    public const EXPORT_FILE_EXTENSION = 'FACT_FINDER_SDK:EXPORT_FILE_EXTENSION';
    public const PHP_LOGGER_CONFIG_PATH = 'FACT_FINDER_SDK:PHP_LOGGER_CONFIG_PATH';
    public const DETAIL_PAGE_URL = 'FACT_FINDER_SDK:DETAIL_PAGE_URL';
    public const CHANNEL_PREFIX = 'FACT_FINDER_SDK:CHANNEL_PREFIX';
    public const DEFAULT_PRODUCTS_PER_PAGE = 'FACT_FINDER_SDK:DEFAULT_PRODUCTS_PER_PAGE';
    public const ITEM_FIELDS = 'FACT_FINDER_SDK:ITEM_FIELDS';
    public const CATEGORIES_MAX_COUNT = 'FACT_FINDER_SDK:CATEGORIES_MAX_COUNT';
    public const ADMIN_PANEL_URL = 'FACT_FINDER_SDK:ADMIN_PANEL_URL';
    public const REDIRECT_IF_ONE_RESULT = 'FACT_FINDER_SDK:REDIRECT_IF_ONE_RESULT';

    public const ITEM_PRODUCT_NUMBER = 'ProductNumber';
    public const ITEM_ID_ABSTRACT_PRODUCT = 'IdProductAbstract';
    public const ITEM_NAME = 'Name';
    public const ABSTRACT_URL = 'AbstractUrl';
    public const ITEM_PRICE = 'Price';
    public const ITEM_STOCK = 'Stock';
    public const ITEM_CATEGORY = 'Category';
    public const ITEM_CATEGORY_1 = 'Category1';
    public const ITEM_CATEGORY_2 = 'Category2';
    public const ITEM_CATEGORY_3 = 'Category3';
    public const ITEM_CATEGORY_4 = 'Category4';
    public const ITEM_CATEGORY_PATH = 'CategoryPath';
    public const ITEM_PRODUCT_URL = 'ProductURL';
    public const ITEM_IMAGE_URL = 'ImageURL';
    public const ITEM_DESCRIPTION = 'Description';
    public const ITEM_CATEGORY_ID = 'CategoryId';
    public const ITEM_PARENT_CATEGORY_NAME = 'ParentCategoryName';
    public const ITEM_PARENT_CATEGORY_NODE_ID = 'ParentCategoryNodeId';
    public const ITEM_MASTER_ID = 'MasterProductNumber';
    public const ITEM_ORIGINAL_POSITION = '__ORIG_POSITION__';
    public const ITEM_ATTRIBUTES = 'Attributes';
    public const ITEM_ABSTRACT_PRODUCT_ATTRIBUTES = 'AbstractProductAttributes';
    public const ITEM_CONCRETE_PRODUCT_ATTRIBUTES = 'ConcreteProductAttributes';
    public const ITEM_RATING = 'Rating';
    public const ITEM_CREATED_AT = 'CreatedAt';
    public const ITEM_IS_NEW = 'IsNew';
    public const ITEM_NEW_FROM = 'NewFrom';
    public const ITEM_NEW_TO = 'NewTo';
}
