<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-06-20 06:50:39 --> Severity: Warning --> mysql_fetch_object(): supplied argument is not a valid MySQL result resource C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_item.php 62
ERROR - 2016-06-20 06:50:45 --> Severity: Warning --> mysql_fetch_object(): supplied argument is not a valid MySQL result resource C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_item.php 62
ERROR - 2016-06-20 06:50:48 --> Severity: Warning --> mysql_fetch_object(): supplied argument is not a valid MySQL result resource C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_item.php 62
ERROR - 2016-06-20 06:50:50 --> Severity: Warning --> mysql_fetch_object(): supplied argument is not a valid MySQL result resource C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_item.php 62
ERROR - 2016-06-20 06:50:54 --> Severity: Warning --> mysql_fetch_object(): supplied argument is not a valid MySQL result resource C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_item.php 62
ERROR - 2016-06-20 06:50:57 --> Severity: Warning --> mysql_fetch_object(): supplied argument is not a valid MySQL result resource C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_item.php 62
ERROR - 2016-06-20 06:52:19 --> Severity: Warning --> mysql_fetch_object(): supplied argument is not a valid MySQL result resource C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_item.php 62
ERROR - 2016-06-20 06:52:24 --> Severity: Warning --> mysql_fetch_object(): supplied argument is not a valid MySQL result resource C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_item.php 62
ERROR - 2016-06-20 06:52:51 --> Severity: Warning --> mysql_fetch_object(): supplied argument is not a valid MySQL result resource C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_item.php 62
ERROR - 2016-06-20 07:56:36 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...code ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 07:56:36 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...code ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%sunkist%' or i.barcode ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 07:56:36 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 07:56:37 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...code ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 07:56:37 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...code ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%sunkist%' or i.barcode ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 07:56:37 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 07:56:41 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...code ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 07:56:41 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...code ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%sunkist%' or i.barcode ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 07:56:41 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 07:56:52 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 07:56:52 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%ck tempe%' or i.barcode ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 07:56:52 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 07:56:52 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 07:56:52 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%ck tempe%' or i.barcode ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 07:56:52 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 07:56:53 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 07:56:53 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%ck tempe%' or i.barcode ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 07:56:53 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 07:56:53 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 07:56:53 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%ck tempe%' or i.barcode ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 07:56:53 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 07:56:54 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 07:56:54 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%ck tempe%' or i.barcode ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 07:56:54 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 07:56:55 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 07:56:55 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...de ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%ck tempe%' or i.barcode ilike '%ck tempe%' or i.sku ilike '%ck tempe%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 07:56:55 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 08:02:35 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...arcode ilike '%sunist%' or i.sku ilike '%sunist%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 08:02:35 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...arcode ilike '%sunist%' or i.sku ilike '%sunist%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%sunist%' or i.barcode ilike '%sunist%' or i.sku ilike '%sunist%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 08:02:35 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 08:02:39 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ...code ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 08:02:39 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ...code ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%sunkist%' or i.barcode ilike '%sunkist%' or i.sku ilike '%sunkist%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 08:02:39 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 08:03:53 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ....barcode ilike '%fruit%' or i.sku ilike '%fruit%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 08:03:53 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ....barcode ilike '%fruit%' or i.sku ilike '%fruit%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%fruit%' or i.barcode ilike '%fruit%' or i.sku ilike '%fruit%' i.status_sku = 'ACTIVE' 
ERROR - 2016-06-20 08:03:53 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 08:03:58 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;i&quot;
LINE 6: ....barcode ilike '%fruit%' or i.sku ilike '%fruit%' i.status_s...
                                                             ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 08:03:58 --> Query error: ERROR:  syntax error at or near "i"
LINE 6: ....barcode ilike '%fruit%' or i.sku ilike '%fruit%' i.status_s...
                                                             ^ - Invalid query:  select count(1) as total from  item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4  where   i.name ilike '%fruit%' or i.barcode ilike '%fruit%' or i.sku ilike '%fruit%' i.status_sku = 'INACTIVE' 
ERROR - 2016-06-20 08:03:58 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\retail_dev\application\core\MY_Model.php 172
ERROR - 2016-06-20 16:35:26 --> 404 Page Not Found: /index
ERROR - 2016-06-20 18:08:02 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:02 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             order by r.id desc 
ERROR - 2016-06-20 18:08:02 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
ERROR - 2016-06-20 18:08:02 --> 404 Page Not Found: ../modules/accounts/controllers/User/get_data
ERROR - 2016-06-20 18:08:07 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:07 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             and (i.sku ilike '%n%' or i.name ilike '%n%' or u.code ilike '%n%') order by r.id desc 
ERROR - 2016-06-20 18:08:07 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
ERROR - 2016-06-20 18:08:08 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:08 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             and (i.sku ilike '%na%' or i.name ilike '%na%' or u.code ilike '%na%') order by r.id desc 
ERROR - 2016-06-20 18:08:08 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
ERROR - 2016-06-20 18:08:08 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:08 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             and (i.sku ilike '%nas%' or i.name ilike '%nas%' or u.code ilike '%nas%') order by r.id desc 
ERROR - 2016-06-20 18:08:08 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
ERROR - 2016-06-20 18:08:09 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:09 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             and (i.sku ilike '%nasi%' or i.name ilike '%nasi%' or u.code ilike '%nasi%') order by r.id desc 
ERROR - 2016-06-20 18:08:09 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
ERROR - 2016-06-20 18:08:09 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:09 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             and (i.sku ilike '%nasi %' or i.name ilike '%nasi %' or u.code ilike '%nasi %') order by r.id desc 
ERROR - 2016-06-20 18:08:09 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
ERROR - 2016-06-20 18:08:11 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:11 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             and (i.sku ilike '%nasi g%' or i.name ilike '%nasi g%' or u.code ilike '%nasi g%') order by r.id desc 
ERROR - 2016-06-20 18:08:11 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
ERROR - 2016-06-20 18:08:13 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:13 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             and (i.sku ilike '%nasi go%' or i.name ilike '%nasi go%' or u.code ilike '%nasi go%') order by r.id desc 
ERROR - 2016-06-20 18:08:13 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
ERROR - 2016-06-20 18:08:14 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:14 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             and (i.sku ilike '%nasi g%' or i.name ilike '%nasi g%' or u.code ilike '%nasi g%') order by r.id desc 
ERROR - 2016-06-20 18:08:14 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
ERROR - 2016-06-20 18:08:15 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:15 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             and (i.sku ilike '%nasi %' or i.name ilike '%nasi %' or u.code ilike '%nasi %') order by r.id desc 
ERROR - 2016-06-20 18:08:15 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
ERROR - 2016-06-20 18:08:15 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:15 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             and (i.sku ilike '%nasi%' or i.name ilike '%nasi%' or u.code ilike '%nasi%') order by r.id desc 
ERROR - 2016-06-20 18:08:15 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
ERROR - 2016-06-20 18:08:16 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;recipe&quot; does not exist
LINE 3:             from recipe r 
                         ^ C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-20 18:08:16 --> Query error: ERROR:  relation "recipe" does not exist
LINE 3:             from recipe r 
                         ^ - Invalid query: 
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
             and (i.sku ilike '%nasi %' or i.name ilike '%nasi %' or u.code ilike '%nasi %') order by r.id desc 
ERROR - 2016-06-20 18:08:16 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_recipe.php 51
