<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-06-29 05:26:03 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;filename&quot; of relation &quot;db_version&quot; does not exist C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-29 05:26:03 --> Query error: ERROR:  column "filename" of relation "db_version" does not exist - Invalid query: ALTER TABLE db_version DROP COLUMN filename
ERROR - 2016-06-29 05:26:03 --> Severity: Error --> Call to undefined method Model_db_version::add_version() C:\xampp\htdocs\retail_dev\application\modules\master\controllers\Db_version.php 50
ERROR - 2016-06-29 05:28:00 --> Severity: Error --> Call to undefined method Model_db_version::add_version() C:\xampp\htdocs\retail_dev\application\modules\master\controllers\Db_version.php 50
ERROR - 2016-06-29 05:28:30 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;test&quot; already exists C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-29 05:28:30 --> Query error: ERROR:  relation "test" already exists - Invalid query: CREATE TABLE test
(
  id bigint NOT NULL
)
ERROR - 2016-06-29 05:28:30 --> Severity: Notice --> Undefined variable: db_version C:\xampp\htdocs\retail_dev\application\modules\master\models\Model_db_version.php 28
ERROR - 2016-06-29 05:28:31 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;version_num&quot; violates not-null constraint
DETAIL:  Failing row contains (2, null). C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-29 05:28:31 --> Query error: ERROR:  null value in column "version_num" violates not-null constraint
DETAIL:  Failing row contains (2, null). - Invalid query: INSERT INTO "db_version" ("version_num") VALUES (NULL)
ERROR - 2016-06-29 05:28:31 --> Severity: Error --> Call to undefined method CI_DB_postgre_driver::_error_message() C:\xampp\htdocs\retail_dev\application\core\MY_Controller.php 33
ERROR - 2016-06-29 05:29:38 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;test&quot; already exists C:\xampp\htdocs\retail_dev\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2016-06-29 05:29:38 --> Query error: ERROR:  relation "test" already exists - Invalid query: CREATE TABLE test
(
  id bigint NOT NULL
)
ERROR - 2016-06-29 07:03:39 --> Severity: Error --> Call to undefined method Model_db_version::add_version() C:\xampp\htdocs\retail_dev\application\modules\master\controllers\Db_version.php 53
ERROR - 2016-06-29 09:41:30 --> Severity: Notice --> Undefined property: CI::$model_db_version C:\xampp\htdocs\retail_dev\application\third_party\MX\Controller.php 59
ERROR - 2016-06-29 09:41:30 --> Severity: Error --> Call to a member function get_row_count() on null C:\xampp\htdocs\retail_dev\application\modules\master\controllers\App_version.php 30
ERROR - 2016-06-29 13:34:38 --> Severity: Error --> Call to undefined method MY_Loader::retail_dev() C:\xampp\htdocs\retail_dev\application\modules\master\controllers\App_version.php 32
