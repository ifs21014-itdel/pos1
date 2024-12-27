<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-12-20 11:46:12 --> Severity: Warning --> pg_query(): Query failed: ERROR:  insert or update on table &quot;item&quot; violates foreign key constraint &quot;fk_item_category3&quot;
DETAIL:  Key (category3)=(0) is not present in table &quot;category&quot;. C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-20 11:46:12 --> Query error: ERROR:  insert or update on table "item" violates foreign key constraint "fk_item_category3"
DETAIL:  Key (category3)=(0) is not present in table "category". - Invalid query: INSERT INTO "item" ("sku", "name", "barcode", "cost", "category1", "category2", "category3", "category4", "uom_id", "carton", "inner", "retail_price", "taxed", "consignment", "type", "trading_price", "bom_status", "status_sku", "image") VALUES ('45456667', 'dastin', '2445', '345.0', '4', '7', '0', '0', '0', '134', '344', '556.0', 't', 't', '1', '1', 't', 'Available', '1734669971_temp_image.jpg')
ERROR - 2024-12-20 11:49:55 --> Severity: Warning --> pg_query(): Query failed: ERROR:  insert or update on table &quot;item&quot; violates foreign key constraint &quot;fk_item_category4&quot;
DETAIL:  Key (category4)=(0) is not present in table &quot;category&quot;. C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-20 11:49:55 --> Query error: ERROR:  insert or update on table "item" violates foreign key constraint "fk_item_category4"
DETAIL:  Key (category4)=(0) is not present in table "category". - Invalid query: INSERT INTO "item" ("sku", "name", "barcode", "cost", "category1", "category2", "category3", "category4", "uom_id", "carton", "inner", "retail_price", "taxed", "consignment", "type", "trading_price", "bom_status", "status_sku", "image") VALUES ('55654374747', 'dian', '134444', '2233.0', '4', '6', '4', '0', '0', '12', '122', '222.0', 't', 't', '1', '1', 't', 'Available', '1734670194_temp_image.jpg')
ERROR - 2024-12-20 11:56:46 --> Severity: Warning --> pg_query(): Query failed: ERROR:  insert or update on table &quot;item&quot; violates foreign key constraint &quot;fk_item_category2&quot;
DETAIL:  Key (category2)=(0) is not present in table &quot;category&quot;. C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-20 11:56:46 --> Query error: ERROR:  insert or update on table "item" violates foreign key constraint "fk_item_category2"
DETAIL:  Key (category2)=(0) is not present in table "category". - Invalid query: INSERT INTO "item" ("sku", "name", "barcode", "cost", "category1", "category2", "category3", "category4", "uom_id", "carton", "inner", "retail_price", "taxed", "consignment", "type", "trading_price", "bom_status", "status_sku", "image") VALUES ('77788885', 'defu', '1345', '134.0', '3', '0', '0', '0', '0', '134', '245', '134.0', 't', 't', '1', '1', 't', 'Available', '1734670606_temp_image.jpg')
ERROR - 2024-12-20 12:01:31 --> Severity: Warning --> pg_query(): Query failed: ERROR:  insert or update on table &quot;item&quot; violates foreign key constraint &quot;fk_item_category2&quot;
DETAIL:  Key (category2)=(0) is not present in table &quot;category&quot;. C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-20 12:01:31 --> Query error: ERROR:  insert or update on table "item" violates foreign key constraint "fk_item_category2"
DETAIL:  Key (category2)=(0) is not present in table "category". - Invalid query: INSERT INTO "item" ("sku", "name", "barcode", "cost", "category1", "category2", "category3", "category4", "uom_id", "carton", "inner", "retail_price", "taxed", "consignment", "type", "trading_price", "bom_status", "status_sku", "image") VALUES ('23756677', 'qerty', '14577', '0.0', '3', '0', '0', '0', '0', '1', '1', '234.0', 't', 't', '1', '1', 't', 'Available', '1734670891_temp_image.jpg')
ERROR - 2024-12-20 13:26:44 --> 404 Page Not Found: ../modules/api/controllers/Item/get_item
ERROR - 2024-12-20 14:48:27 --> 404 Page Not Found: ../modules/master/controllers/Item/get_items
ERROR - 2024-12-20 14:49:09 --> 404 Page Not Found: ../modules/master/controllers/Item/get_item_by_id
ERROR - 2024-12-20 14:49:57 --> Severity: Warning --> Missing argument 1 for Item::get_item_by_id() C:\xampp\htdocs\pos1\application\modules\API\controllers\Item.php 340
ERROR - 2024-12-20 14:49:57 --> Severity: Notice --> Undefined variable: id C:\xampp\htdocs\pos1\application\modules\API\controllers\Item.php 341
