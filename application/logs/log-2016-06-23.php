<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-06-23 06:45:14 --> Severity: Warning --> pg_query(): Query failed: ERROR:  update or delete on table &quot;item&quot; violates foreign key constraint &quot;fk_stock_item_item_id&quot; on table &quot;stock_item&quot;
DETAIL:  Key (id)=(5000006) is still referenced from table &quot;stock_item&quot;. C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-23 06:45:14 --> Query error: ERROR:  update or delete on table "item" violates foreign key constraint "fk_stock_item_item_id" on table "stock_item"
DETAIL:  Key (id)=(5000006) is still referenced from table "stock_item". - Invalid query: DELETE FROM "item"
WHERE "id" = '5000006'
ERROR - 2016-06-23 06:45:22 --> Severity: Warning --> pg_query(): Query failed: ERROR:  update or delete on table &quot;item&quot; violates foreign key constraint &quot;fk_bill_of_materials_item_item_id&quot; on table &quot;bill_of_materials_item&quot;
DETAIL:  Key (id)=(7447) is still referenced from table &quot;bill_of_materials_item&quot;. C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-23 06:45:22 --> Query error: ERROR:  update or delete on table "item" violates foreign key constraint "fk_bill_of_materials_item_item_id" on table "bill_of_materials_item"
DETAIL:  Key (id)=(7447) is still referenced from table "bill_of_materials_item". - Invalid query: DELETE FROM "item"
WHERE "id" = '7447'
ERROR - 2016-06-23 14:09:52 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...arcode ilike '%900076%' or i.sku ilike '%900076%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-23 14:09:52 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...arcode ilike '%900076%' or i.sku ilike '%900076%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%900076%' or i.barcode ilike '%900076%' or i.sku ilike '%900076%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-23 14:09:52 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-23 14:10:07 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...arcode ilike '%900076%' or i.sku ilike '%900076%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-23 14:10:07 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...arcode ilike '%900076%' or i.sku ilike '%900076%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%900076%' or i.barcode ilike '%900076%' or i.sku ilike '%900076%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-23 14:10:07 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-23 14:10:10 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...arcode ilike '%900076%' or i.sku ilike '%900076%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-23 14:10:10 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...arcode ilike '%900076%' or i.sku ilike '%900076%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%900076%' or i.barcode ilike '%900076%' or i.sku ilike '%900076%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-23 14:10:10 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-23 17:11:00 --> 404 Page Not Found: ../modules/master/controllers/Category/get_category
ERROR - 2016-06-23 17:14:20 --> 404 Page Not Found: ../modules/master/controllers/Category/get_category
ERROR - 2016-06-23 17:35:44 --> 404 Page Not Found: /index
ERROR - 2016-06-23 18:36:41 --> Severity: Notice --> Undefined property: CI::$model_category C:\xampp\htdocs\retail_dev\system\core\Model.php 77
ERROR - 2016-06-23 18:36:41 --> Severity: Error --> Call to a member function get_data() on null C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_item.php 180
