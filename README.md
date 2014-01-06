## About

This repository holds random stuff I written for Magento, either to help/debug something or to be used in production.


## Install

To use the following Magento custom web-services, you have to place the PhP files in the application's root folder.

`/category_export.php`

This web-service returns a JSON with all the categories defined in the application's
Admin, where children categories are nested in the respective parent category.

`/orders_payment_method.php`

This web-service returns a JSON with all the order's ID and Payment Method.