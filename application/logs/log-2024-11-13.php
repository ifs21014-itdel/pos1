<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-11-13 09:16:58 --> Severity: Warning --> opendir(C:/xampp/htdocs/ho_bez/application/db_update,C:/xampp/htdocs/ho_bez/application/db_update): The system cannot find the path specified. (code: 3) C:\xampp\htdocs\pos1\application\modules\master\controllers\Db_version.php 21
ERROR - 2024-11-13 09:16:58 --> Severity: Warning --> opendir(C:/xampp/htdocs/ho_bez/application/db_update): failed to open dir: No such file or directory C:\xampp\htdocs\pos1\application\modules\master\controllers\Db_version.php 21
ERROR - 2024-11-13 09:17:07 --> Severity: Warning --> opendir(C:/xampp/htdocs/ho_bez/application/db_update,C:/xampp/htdocs/ho_bez/application/db_update): The system cannot find the path specified. (code: 3) C:\xampp\htdocs\pos1\application\modules\master\controllers\Version_app.php 28
ERROR - 2024-11-13 09:17:07 --> Severity: Warning --> opendir(C:/xampp/htdocs/ho_bez/application/db_update): failed to open dir: No such file or directory C:\xampp\htdocs\pos1\application\modules\master\controllers\Version_app.php 28
ERROR - 2024-11-13 09:25:41 --> 404 Page Not Found: ../modules/api/controllers/User/add_user
ERROR - 2024-11-13 09:26:39 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;email&quot; violates not-null constraint
DETAIL:  Failing row contains (16, t, null, null, null, null, null, null, null, d41d8cd98f00b204e9800998ecf8427e, null, f, null). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-11-13 09:26:39 --> Query error: ERROR:  null value in column "email" violates not-null constraint
DETAIL:  Failing row contains (16, t, null, null, null, null, null, null, null, d41d8cd98f00b204e9800998ecf8427e, null, f, null). - Invalid query: INSERT INTO "kds_user" ("active", "email", "username", "first_name", "last_name", "user_password", "password_reset") VALUES (TRUE, NULL, NULL, NULL, NULL, 'd41d8cd98f00b204e9800998ecf8427e', FALSE)
ERROR - 2024-11-13 09:40:35 --> Severity: Compile Error --> Access level to User::getMessageResult() must be public (as in class MY_Controller) C:\xampp\htdocs\pos1\application\modules\API\controllers\User.php 75
ERROR - 2024-11-13 09:41:21 --> Severity: Compile Error --> Access level to User::getMessageResult() must be public (as in class MY_Controller) C:\xampp\htdocs\pos1\application\modules\API\controllers\User.php 75
ERROR - 2024-11-13 09:41:30 --> Severity: Compile Error --> Access level to User::getMessageResult() must be public (as in class MY_Controller) C:\xampp\htdocs\pos1\application\modules\API\controllers\User.php 75
ERROR - 2024-11-13 09:43:55 --> 404 Page Not Found: ../modules/api/controllers/User/index
ERROR - 2024-11-13 09:43:59 --> 404 Page Not Found: ../modules/api/controllers/User/index
ERROR - 2024-11-13 09:45:15 --> 404 Page Not Found: ../modules/api/controllers/User/index
ERROR - 2024-11-13 09:49:39 --> Severity: Error --> Call to undefined method Model_user::select_where() C:\xampp\htdocs\pos1\application\modules\API\controllers\Auth.php 23
ERROR - 2024-11-13 09:49:39 --> Severity: Error --> Call to undefined method Model_user::select_where() C:\xampp\htdocs\pos1\application\modules\API\controllers\Auth.php 23
ERROR - 2024-11-13 09:53:22 --> 404 Page Not Found: /index
ERROR - 2024-11-13 09:53:59 --> 404 Page Not Found: /index
ERROR - 2024-11-13 09:55:01 --> Severity: Error --> Call to undefined method Model_user::selectRowByNameAndPassword() C:\xampp\htdocs\pos1\application\modules\API\controllers\Auth.php 19
ERROR - 2024-11-13 09:56:42 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;users&quot; does not exist
LINE 2: FROM &quot;users&quot;
             ^ C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-11-13 09:56:42 --> Query error: ERROR:  relation "users" does not exist
LINE 2: FROM "users"
             ^ - Invalid query: SELECT *
FROM "users"
WHERE "username" IS NULL
AND "user_password" = 'd41d8cd98f00b204e9800998ecf8427e'
ERROR - 2024-11-13 09:56:42 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\modules\API\models\Model_user.php 31
ERROR - 2024-11-13 10:00:35 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;users&quot; does not exist
LINE 2: FROM &quot;users&quot;
             ^ C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-11-13 10:00:35 --> Query error: ERROR:  relation "users" does not exist
LINE 2: FROM "users"
             ^ - Invalid query: SELECT *
FROM "users"
WHERE "username" IS NULL
AND "user_password" = 'd41d8cd98f00b204e9800998ecf8427e'
ERROR - 2024-11-13 10:00:35 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\modules\API\models\Model_user.php 30
ERROR - 2024-11-13 10:00:37 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;users&quot; does not exist
LINE 2: FROM &quot;users&quot;
             ^ C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-11-13 10:00:37 --> Query error: ERROR:  relation "users" does not exist
LINE 2: FROM "users"
             ^ - Invalid query: SELECT *
FROM "users"
WHERE "username" IS NULL
AND "user_password" = 'd41d8cd98f00b204e9800998ecf8427e'
ERROR - 2024-11-13 10:00:37 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\modules\API\models\Model_user.php 30
ERROR - 2024-11-13 10:25:43 --> 404 Page Not Found: /index
ERROR - 2024-11-13 11:04:20 --> Severity: Error --> Call to undefined method Model_user::get_data() C:\xampp\htdocs\pos1\application\modules\API\controllers\User.php 12
ERROR - 2024-11-13 11:10:56 --> Severity: 4096 --> Object of class CI_Input could not be converted to string C:\xampp\htdocs\pos1\application\modules\API\controllers\User.php 32
ERROR - 2024-11-13 11:10:56 --> Severity: 4096 --> Object of class CI_Input could not be converted to string C:\xampp\htdocs\pos1\application\modules\API\controllers\User.php 34
ERROR - 2024-11-13 11:10:56 --> Severity: 4096 --> Object of class CI_Input could not be converted to string C:\xampp\htdocs\pos1\application\modules\API\controllers\User.php 35
ERROR - 2024-11-13 11:10:56 --> Severity: 4096 --> Object of class CI_Input could not be converted to string C:\xampp\htdocs\pos1\application\modules\API\controllers\User.php 36
ERROR - 2024-11-13 12:32:33 --> 404 Page Not Found: /index
ERROR - 2024-11-13 12:36:07 --> 404 Page Not Found: /index
ERROR - 2024-11-13 14:25:23 --> 404 Page Not Found: ../modules/accounts/controllers/Accounts/auth
ERROR - 2024-11-13 14:31:25 --> 404 Page Not Found: ../modules/accounts/controllers/Accounts/auth
ERROR - 2024-11-13 14:31:41 --> 404 Page Not Found: ../modules/accounts/controllers/Accounts/auth
ERROR - 2024-11-13 14:31:48 --> 404 Page Not Found: ../modules/accounts/controllers/Accounts/auth
ERROR - 2024-11-13 14:32:08 --> 404 Page Not Found: ../modules/accounts/controllers/Accounts/auth
ERROR - 2024-11-13 14:32:50 --> 404 Page Not Found: ../modules/accounts/controllers/Accounts/auth
ERROR - 2024-11-13 14:33:03 --> 404 Page Not Found: ../modules/accounts/controllers/Accounts/auth
ERROR - 2024-11-13 14:33:22 --> 404 Page Not Found: ../modules/accounts/controllers/Accounts/auth
ERROR - 2024-11-13 14:35:36 --> 404 Page Not Found: ../modules/api/controllers/User/login_auth
ERROR - 2024-11-13 14:36:46 --> 404 Page Not Found: ../modules/api/controllers/User/login_auth
ERROR - 2024-11-13 15:23:13 --> 404 Page Not Found: ../modules/master/controllers//index
