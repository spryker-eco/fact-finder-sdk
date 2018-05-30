<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\FactFinderSdk;

/**
 * @SuppressWarnings(ModuleConstantsRule)
 */
interface FactFinderSdkConstants
{
    const ENVIRONMENT = 'FACT_FINDER_SDK:ENVIRONMENT';
    const ENVIRONMENT_PRODUCTION = 'FACT_FINDER_SDK:ENVIRONMENT_PRODUCTION';
    const ENVIRONMENT_DEVELOPMENT = 'FACT_FINDER_SDK:ENVIRONMENT_DEVELOPMENT';
    const ENVIRONMENT_TEST = 'FACT_FINDER_SDK:ENVIRONMENT_TEST';
    const CSV_DIRECTORY = 'FACT_FINDER_SDK:CSV_DIRECTORY';
    const EXPORT_QUERY_LIMIT = 'FACT_FINDER_SDK:EXPORT_QUERY_LIMIT';
    const EXPORT_FILE_NAME_PREFIX = 'FACT_FINDER_SDK:EXPORT_FILE_NAME_PREFIX';
    const EXPORT_FILE_NAME_DELIMITER = 'FACT_FINDER_SDK:EXPORT_FILE_NAME_DELIMITER';
    const EXPORT_FILE_EXTENSION = 'FACT_FINDER_SDK:EXPORT_FILE_EXTENSION';
    const PHP_LOGGER_CONFIG_PATH = 'FACT_FINDER_SDK:PHP_LOGGER_CONFIG_PATH';
    const DETAIL_PAGE_URL = 'FACT_FINDER_SDK:DETAIL_PAGE_URL';
    const CHANNEL_PREFIX = 'FACT_FINDER_SDK:CHANNEL_PREFIX';
    const DEFAULT_PRODUCTS_PER_PAGE = 'FACT_FINDER_SDK:DEFAULT_PRODUCTS_PER_PAGE';
    const ITEM_FIELDS = 'FACT_FINDER_SDK:ITEM_FIELDS';
    const CATEGORIES_MAX_COUNT = 'FACT_FINDER_SDK:CATEGORIES_MAX_COUNT';
    const ADMIN_PANEL_URL = 'FACT_FINDER_SDK:ADMIN_PANEL_URL';
    const REDIRECT_IF_ONE_RESULT = 'FACT_FINDER_SDK:REDIRECT_IF_ONE_RESULT';

    const ITEM_PRODUCT_NUMBER = 'ProductNumber';
    const ITEM_ID_ABSTRACT_PRODUCT = 'IdProductAbstract';
    const ITEM_NAME = 'Name';
    const ABSTRACT_URL = 'AbstractUrl';
    const ITEM_PRICE = 'Price';
    const ITEM_STOCK = 'Stock';
    const ITEM_CATEGORY = 'Category';
    const ITEM_CATEGORY_1 = 'Category1';
    const ITEM_CATEGORY_2 = 'Category2';
    const ITEM_CATEGORY_3 = 'Category3';
    const ITEM_CATEGORY_4 = 'Category4';
    const ITEM_CATEGORY_PATH = 'CategoryPath';
    const ITEM_PRODUCT_URL = 'ProductURL';
    const ITEM_IMAGE_URL = 'ImageURL';
    const ITEM_DESCRIPTION = 'Description';
    const ITEM_CATEGORY_ID = 'CategoryId';
    const ITEM_PARENT_CATEGORY_NAME = 'ParentCategoryName';
    const ITEM_PARENT_CATEGORY_NODE_ID = 'ParentCategoryNodeId';
    const ITEM_MASTER_ID = 'MasterProductNumber';
    const ITEM_ORIGINAL_POSITION = '__ORIG_POSITION__';
    const ITEM_ATTRIBUTES = 'Attributes';
    const ITEM_ABSTRACT_PRODUCT_ATTRIBUTES = 'AbstractProductAttributes';
    const ITEM_CONCRETE_PRODUCT_ATTRIBUTES = 'ConcreteProductAttributes';
    const ITEM_RATING = 'Rating';
    const ITEM_CREATED_AT = 'CreatedAt';
    const ITEM_IS_NEW = 'IsNew';
    const ITEM_NEW_FROM = 'NewFrom';
    const ITEM_NEW_TO = 'NewTo';
    const PRICE_TYPE_NAME = 'DEFAULT';
}
