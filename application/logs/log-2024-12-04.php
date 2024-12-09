<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-12-04 19:19:34 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 93
ERROR - 2024-12-04 19:19:38 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 93
ERROR - 2024-12-04 19:20:53 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 93
ERROR - 2024-12-04 19:23:39 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 88
ERROR - 2024-12-04 19:23:39 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 90
ERROR - 2024-12-04 19:23:39 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 92
ERROR - 2024-12-04 19:24:00 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 88
ERROR - 2024-12-04 19:24:00 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 90
ERROR - 2024-12-04 19:24:00 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 92
ERROR - 2024-12-04 19:27:59 --> Severity: Error --> Call to undefined function dd() C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 92
ERROR - 2024-12-04 19:29:08 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 93
ERROR - 2024-12-04 19:29:49 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 87
ERROR - 2024-12-04 19:29:52 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 87
ERROR - 2024-12-04 19:30:24 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 88
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 83
ERROR - 2024-12-04 19:45:47 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 85
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 86
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 90
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 91
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 93
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 95
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 97
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 99
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 101
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 103
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 104
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 70
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024700, 2024.12.04.194547, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 19:45:47.086616+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 19:45:47 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024700, 2024.12.04.194547, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 19:45:47.086616+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "store_id") VALUES ('2024.12.04.194547', '1', '1')
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 19:45:47 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 19:45:47 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\pos1\system\core\Exceptions.php:272) C:\xampp\htdocs\pos1\system\core\Common.php 569
ERROR - 2024-12-04 19:45:47 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 19:50:49 --> Order data is missing. Request body: []
ERROR - 2024-12-04 19:50:56 --> Order data is missing. Request body: []
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 83
ERROR - 2024-12-04 20:08:45 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 85
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 86
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 90
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 91
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 93
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 95
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 97
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 99
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 101
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 103
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 104
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 71
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024701, 2024.12.04.200845, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:08:45.485249+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:08:45 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024701, 2024.12.04.200845, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:08:45.485249+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "store_id") VALUES ('2024.12.04.200845', '1', '1')
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:08:45 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:08:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\pos1\system\core\Exceptions.php:272) C:\xampp\htdocs\pos1\system\core\Common.php 569
ERROR - 2024-12-04 20:08:45 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 83
ERROR - 2024-12-04 20:18:04 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 85
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 86
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 90
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 91
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 93
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 95
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 97
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 99
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 101
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 103
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 104
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 71
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024702, 2024.12.04.201804, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:18:04.127806+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:18:04 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024702, 2024.12.04.201804, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:18:04.127806+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "store_id") VALUES ('2024.12.04.201804', '1', '1')
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:18:04 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:18:04 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\pos1\system\core\Exceptions.php:272) C:\xampp\htdocs\pos1\system\core\Common.php 569
ERROR - 2024-12-04 20:18:04 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:20:21 --> Severity: Error --> Call to undefined method Model_sales::saveOrder() C:\xampp\htdocs\pos1\application\modules\API\controllers\Sales.php 127
ERROR - 2024-12-04 20:20:55 --> Severity: Error --> Call to undefined method Model_sales::saveOrder() C:\xampp\htdocs\pos1\application\modules\API\controllers\Sales.php 127
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 83
ERROR - 2024-12-04 20:21:03 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 85
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 86
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 90
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 91
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 93
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 95
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 97
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 99
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 101
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 103
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 104
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 71
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024703, 2024.12.04.202103, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:21:03.192353+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:21:03 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024703, 2024.12.04.202103, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:21:03.192353+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "store_id") VALUES ('2024.12.04.202103', '1', '1')
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:21:03 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:21:03 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\pos1\system\core\Exceptions.php:272) C:\xampp\htdocs\pos1\system\core\Common.php 569
ERROR - 2024-12-04 20:21:03 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:22:32 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 86
ERROR - 2024-12-04 20:22:32 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 71
ERROR - 2024-12-04 20:22:32 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024704, 2024.12.04.202232, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:22:32.572154+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:22:32 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024704, 2024.12.04.202232, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:22:32.572154+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "store_id") VALUES ('2024.12.04.202232', '1', '1')
ERROR - 2024-12-04 20:22:32 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:22:32 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:22:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\pos1\system\core\Exceptions.php:272) C:\xampp\htdocs\pos1\system\core\Common.php 569
ERROR - 2024-12-04 20:22:32 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:26:04 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 71
ERROR - 2024-12-04 20:26:04 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024705, 2024.12.04.202604, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:26:04.871271+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:26:04 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024705, 2024.12.04.202604, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:26:04.871271+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "store_id") VALUES ('2024.12.04.202604', '1', '1')
ERROR - 2024-12-04 20:26:04 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:26:04 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:26:04 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:26:33 --> Severity: Warning --> First parameter must either be an object or the name of an existing class C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 71
ERROR - 2024-12-04 20:26:33 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024706, 2024.12.04.202633, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:26:33.776923+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:26:33 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024706, 2024.12.04.202633, null, null, null, null, null, null, null, null, null, null, null, null, null, 2024-12-04 20:26:33.776923+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "store_id") VALUES ('2024.12.04.202633', '1', '1')
ERROR - 2024-12-04 20:26:33 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:26:33 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:26:33 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:32:40 --> Severity: Warning --> pg_query(): Query failed: ERROR:  insert or update on table &quot;sales&quot; violates foreign key constraint &quot;fk_sales_customer_customer_id&quot;
DETAIL:  Key (customer_id)=(1) is not present in table &quot;customer&quot;. C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:32:40 --> Query error: ERROR:  insert or update on table "sales" violates foreign key constraint "fk_sales_customer_customer_id"
DETAIL:  Key (customer_id)=(1) is not present in table "customer". - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "customer_id", "total_price", "total_cash", "store_id", "amount_pay_cash", "total_quantity") VALUES ('2024.12.04.203240', '1', 1, 128500, 130000, '1', 128500, 3)
ERROR - 2024-12-04 20:32:40 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:32:40 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:32:40 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:38:02 --> Severity: Notice --> Undefined property: stdClass::$totalPrice C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 85
ERROR - 2024-12-04 20:38:02 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024708, 2024.12.04.203802, null, null, null, null, null, null, null, null, null, null, null, null, 1, 2024-12-04 20:38:02.244205+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:38:02 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024708, 2024.12.04.203802, null, null, null, null, null, null, null, null, null, null, null, null, 1, 2024-12-04 20:38:02.244205+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "store_id", "total_quantity") VALUES ('2024.12.04.203802', '1', '1', 1)
ERROR - 2024-12-04 20:38:02 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:38:02 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:38:02 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:40:39 --> Severity: Notice --> Undefined property: stdClass::$totalPrice C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 80
ERROR - 2024-12-04 20:40:39 --> Severity: Notice --> Undefined property: stdClass::$totalPrice C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 86
ERROR - 2024-12-04 20:40:39 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024709, 2024.12.04.204039, null, null, null, null, null, null, null, null, null, null, null, null, 1, 2024-12-04 20:40:39.314095+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:40:39 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024709, 2024.12.04.204039, null, null, null, null, null, null, null, null, null, null, null, null, 1, 2024-12-04 20:40:39.314095+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "store_id", "total_quantity") VALUES ('2024.12.04.204039', '1', '1', 1)
ERROR - 2024-12-04 20:40:39 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:40:39 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:40:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\pos1\application\core\MY_Model.php:25) C:\xampp\htdocs\pos1\system\core\Common.php 569
ERROR - 2024-12-04 20:40:39 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:40:52 --> Severity: Notice --> Undefined property: stdClass::$totalPrice C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 80
ERROR - 2024-12-04 20:40:52 --> Severity: Notice --> Undefined property: stdClass::$totalPrice C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 86
ERROR - 2024-12-04 20:40:52 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024710, 2024.12.04.204052, null, null, null, null, null, null, null, null, null, null, null, null, 1, 2024-12-04 20:40:52.853417+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:40:52 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024710, 2024.12.04.204052, null, null, null, null, null, null, null, null, null, null, null, null, 1, 2024-12-04 20:40:52.853417+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "store_id", "total_quantity") VALUES ('2024.12.04.204052', '1', '1', 1)
ERROR - 2024-12-04 20:40:52 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:40:52 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:40:52 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\pos1\application\core\MY_Model.php:25) C:\xampp\htdocs\pos1\system\core\Common.php 569
ERROR - 2024-12-04 20:40:52 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:44:24 --> 404 Page Not Found: ../modules/api/controllers/Sales/api_saveOrder
ERROR - 2024-12-04 20:44:42 --> 404 Page Not Found: ../modules/api/controllers/Sales/api_saveOrder
ERROR - 2024-12-04 20:45:19 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024711, 2024.12.04.204519, null, null, null, null, null, null, null, null, null, null, null, null, 1, 2024-12-04 20:45:19.415407+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:45:19 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024711, 2024.12.04.204519, null, null, null, null, null, null, null, null, null, null, null, null, 1, 2024-12-04 20:45:19.415407+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "store_id", "total_quantity") VALUES ('2024.12.04.204519', '1', '1', 1)
ERROR - 2024-12-04 20:45:19 --> Severity: Warning --> pg_affected_rows() expects parameter 1 to be resource, boolean given C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 364
ERROR - 2024-12-04 20:45:19 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:45:19 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:45:19 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:49:56 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for integer: &quot;VISA&quot;
LINE 1: ...4567812345678', '9876543219876543', 'VOUCHER123', 'VISA', 'M...
                                                             ^ C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:49:56 --> Query error: ERROR:  invalid input syntax for integer: "VISA"
LINE 1: ...4567812345678', '9876543219876543', 'VOUCHER123', 'VISA', 'M...
                                                             ^ - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "customer_id", "total_price", "total_cash", "store_id", "amount_pay_cash", "credit_card_number", "debit_card_number", "voucher_number", "credit_card_type", "debit_card_type", "total_quantity") VALUES ('2024.12.04.204956', '1', '1', 7500, 8000, '1', 7500, '1234567812345678', '9876543219876543', 'VOUCHER123', 'VISA', 'MASTER', 1)
ERROR - 2024-12-04 20:49:56 --> Severity: Warning --> pg_affected_rows() expects parameter 1 to be resource, boolean given C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 364
ERROR - 2024-12-04 20:49:56 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:49:56 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:49:56 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:54:31 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for integer: &quot;VISA&quot;
LINE 1: ...4567812345678', '9876543219876543', 'VOUCHER123', 'VISA', 'M...
                                                             ^ C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:54:31 --> Query error: ERROR:  invalid input syntax for integer: "VISA"
LINE 1: ...4567812345678', '9876543219876543', 'VOUCHER123', 'VISA', 'M...
                                                             ^ - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "customer_id", "total_price", "total_cash", "store_id", "amount_pay_cash", "credit_card_number", "debit_card_number", "voucher_number", "credit_card_type", "debit_card_type", "total_quantity") VALUES ('2024.12.04.205431', '1', 1, 7500, 8000, '1', 7500, '1234567812345678', '9876543219876543', 'VOUCHER123', 'VISA', 'MASTER', 1)
ERROR - 2024-12-04 20:54:31 --> Severity: Warning --> pg_affected_rows() expects parameter 1 to be resource, boolean given C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 364
ERROR - 2024-12-04 20:54:31 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:54:31 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:54:31 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:54:50 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for integer: &quot;VISA&quot;
LINE 1: ...4567812345678', '9876543219876543', 'VOUCHER123', 'VISA', 'M...
                                                             ^ C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:54:50 --> Query error: ERROR:  invalid input syntax for integer: "VISA"
LINE 1: ...4567812345678', '9876543219876543', 'VOUCHER123', 'VISA', 'M...
                                                             ^ - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "customer_id", "total_price", "total_cash", "store_id", "amount_pay_cash", "credit_card_number", "debit_card_number", "voucher_number", "credit_card_type", "debit_card_type", "total_quantity") VALUES ('2024.12.04.205450', '1', 1, 7500, 8000, '1', 7500, '1234567812345678', '9876543219876543', 'VOUCHER123', 'VISA', 'MASTER', 1)
ERROR - 2024-12-04 20:54:50 --> Severity: Warning --> pg_affected_rows() expects parameter 1 to be resource, boolean given C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 364
ERROR - 2024-12-04 20:54:50 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:54:50 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:54:50 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:56:15 --> Severity: Warning --> pg_query(): Query failed: ERROR:  insert or update on table &quot;sales&quot; violates foreign key constraint &quot;fk_sales_customer_customer_id&quot;
DETAIL:  Key (customer_id)=(1) is not present in table &quot;customer&quot;. C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:56:15 --> Query error: ERROR:  insert or update on table "sales" violates foreign key constraint "fk_sales_customer_customer_id"
DETAIL:  Key (customer_id)=(1) is not present in table "customer". - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "customer_id", "total_price", "total_cash", "store_id", "amount_pay_cash", "credit_card_number", "debit_card_number", "voucher_number", "credit_card_type", "debit_card_type", "total_quantity") VALUES ('2024.12.04.205615', '1', 1, 7500, 8000, '1', 7500, '1234567812345678', '9876543219876543', 'VOUCHER123', 1, 2, 1)
ERROR - 2024-12-04 20:56:15 --> Severity: Warning --> pg_affected_rows() expects parameter 1 to be resource, boolean given C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 364
ERROR - 2024-12-04 20:56:15 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-04 20:56:15 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-04 20:56:15 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-04 20:58:20 --> Severity: Notice --> Use of undefined constant result_empty - assumed 'result_empty' C:\xampp\htdocs\pos1\application\core\MY_Model.php 215
