<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-12-05 08:44:18 --> Severity: Notice --> Undefined property: stdClass::$totalPrice C:\xampp\htdocs\pos1\application\modules\API\models\Model_sales.php 85
ERROR - 2024-12-05 08:44:18 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024716, 2024.12.05.084418, 2, null, null, null, null, null, null, null, null, null, null, null, 1, 2024-12-05 08:44:18.627666+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-05 08:44:18 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024716, 2024.12.05.084418, 2, null, null, null, null, null, null, null, null, null, null, null, 1, 2024-12-05 08:44:18.627666+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "customer_id", "store_id", "total_quantity") VALUES ('2024.12.05.084418', '1', 2, '1', 1)
ERROR - 2024-12-05 08:44:18 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-05 08:44:18 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-05 08:44:18 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-05 09:04:09 --> Severity: Warning --> error_log() expects parameter 1 to be string, array given C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 95
ERROR - 2024-12-05 09:04:27 --> Severity: Warning --> error_log() expects parameter 1 to be string, array given C:\xampp\htdocs\pos1\application\modules\cashier\controllers\Sales.php 95
ERROR - 2024-12-05 11:09:21 --> 404 Page Not Found: /index
ERROR - 2024-12-05 11:09:34 --> 404 Page Not Found: /index
ERROR - 2024-12-05 11:10:04 --> 404 Page Not Found: /index
ERROR - 2024-12-05 11:12:12 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024729, 2024.12.05.111212, 2, null, 20000, 20000, 1234567812345678, null, 9876543219876543, null, VOUCHER123, null, 1, 2, 2, 2024-12-05 11:12:12.075623+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-05 11:12:12 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024729, 2024.12.05.111212, 2, null, 20000, 20000, 1234567812345678, null, 9876543219876543, null, VOUCHER123, null, 1, 2, 2, 2024-12-05 11:12:12.075623+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "customer_id", "total_cash", "store_id", "amount_pay_cash", "credit_card_number", "debit_card_number", "voucher_number", "credit_card_type", "debit_card_type", "total_quantity") VALUES ('2024.12.05.111212', '1', 2, 20000, '1', 20000, '1234567812345678', '9876543219876543', 'VOUCHER123', 1, 2, 2)
ERROR - 2024-12-05 11:12:12 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-05 11:12:12 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-05 11:12:12 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-05 11:13:04 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024730, 2024.12.05.111304, 2, null, 20000, 20000, 1234567812345678, null, 9876543219876543, null, VOUCHER123, null, 1, 2, 2, 2024-12-05 11:13:04.886629+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-05 11:13:04 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024730, 2024.12.05.111304, 2, null, 20000, 20000, 1234567812345678, null, 9876543219876543, null, VOUCHER123, null, 1, 2, 2, 2024-12-05 11:13:04.886629+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "customer_id", "total_cash", "store_id", "amount_pay_cash", "credit_card_number", "debit_card_number", "voucher_number", "credit_card_type", "debit_card_type", "total_quantity") VALUES ('2024.12.05.111304', '1', 2, 20000, '1', 20000, '1234567812345678', '9876543219876543', 'VOUCHER123', 1, 2, 2)
ERROR - 2024-12-05 11:13:04 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-05 11:13:04 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-05 11:13:04 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-05 11:13:18 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;total_price&quot; violates not-null constraint
DETAIL:  Failing row contains (2213020000000024731, 2024.12.05.111318, 2, null, 20000, 20000, 1234567812345678, null, 9876543219876543, null, VOUCHER123, null, 1, 2, 2, 2024-12-05 11:13:18.178031+07, 1, 1). C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-05 11:13:18 --> Query error: ERROR:  null value in column "total_price" violates not-null constraint
DETAIL:  Failing row contains (2213020000000024731, 2024.12.05.111318, 2, null, 20000, 20000, 1234567812345678, null, 9876543219876543, null, VOUCHER123, null, 1, 2, 2, 2024-12-05 11:13:18.178031+07, 1, 1). - Invalid query: INSERT INTO "sales" ("reference", "cashier_id", "customer_id", "total_cash", "store_id", "amount_pay_cash", "credit_card_number", "debit_card_number", "voucher_number", "credit_card_type", "debit_card_type", "total_quantity") VALUES ('2024.12.05.111318', '1', 2, 20000, '1', 20000, '1234567812345678', '9876543219876543', 'VOUCHER123', 1, 2, 2)
ERROR - 2024-12-05 11:13:18 --> Severity: Warning --> pg_query(): Query failed: ERROR:  current transaction is aborted, commands ignored until end of transaction block C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-05 11:13:18 --> Query error: ERROR:  current transaction is aborted, commands ignored until end of transaction block - Invalid query: SELECT last_value FROM sales_id_seq;
ERROR - 2024-12-05 11:13:18 --> Severity: Error --> Call to a member function row() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 25
ERROR - 2024-12-05 12:30:23 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for integer: &quot;idSales&quot;
LINE 19:      where s.id = 'idSales' 
                           ^ C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-05 12:30:23 --> Query error: ERROR:  invalid input syntax for integer: "idSales"
LINE 19:      where s.id = 'idSales' 
                           ^ - Invalid query:  SELECT s.id, 
						s.reference, 
						s.total_price, 
						s.total_cash, 
						s.amount_pay_cash, 
				        (coalesce(s.total_cash,0) - coalesce(s.amount_pay_cash,0)) as cash_retun,
						coalesce(s.credit_card_number,'') as credit_card_number, 
						coalesce(s.amount_pay_cash_credit_card,0) as amount_pay_cash_credit_card,
						coalesce(s.debit_card_number,'') as debit_card_number, 
						coalesce(s.amount_pay_cash_debit_card,0) as amount_pay_cash_debit_card, 
						coalesce(s.voucher_number,'') as voucher_number, coalesce(s.amount_pay_cash_voucher,0) as amount_pay_cash_voucher, 
						coalesce(s.credit_card_type,0) as credit_card_type, coalesce(s.debit_card_type,0) as debit_card_type, 
						coalesce(s.total_quantity,0) as total_quantity, 
						to_char(s.sales_date, 'dd-MM-yyyy HH:mm:ss') as sales_date, 
						u.first_name, 
						coalesce((select sum(si.discount) from sales_item si where si.sales_id = s.id),0) as total_discount
						FROM sales s
						join kds_user u on u.id = s.cashier_id
					where s.id = 'idSales' 
ERROR - 2024-12-05 12:30:23 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 89
ERROR - 2024-12-05 12:30:30 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for integer: &quot;idSales&quot;
LINE 19:      where s.id = 'idSales' 
                           ^ C:\xampp\htdocs\pos1\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2024-12-05 12:30:30 --> Query error: ERROR:  invalid input syntax for integer: "idSales"
LINE 19:      where s.id = 'idSales' 
                           ^ - Invalid query:  SELECT s.id, 
						s.reference, 
						s.total_price, 
						s.total_cash, 
						s.amount_pay_cash, 
				        (coalesce(s.total_cash,0) - coalesce(s.amount_pay_cash,0)) as cash_retun,
						coalesce(s.credit_card_number,'') as credit_card_number, 
						coalesce(s.amount_pay_cash_credit_card,0) as amount_pay_cash_credit_card,
						coalesce(s.debit_card_number,'') as debit_card_number, 
						coalesce(s.amount_pay_cash_debit_card,0) as amount_pay_cash_debit_card, 
						coalesce(s.voucher_number,'') as voucher_number, coalesce(s.amount_pay_cash_voucher,0) as amount_pay_cash_voucher, 
						coalesce(s.credit_card_type,0) as credit_card_type, coalesce(s.debit_card_type,0) as debit_card_type, 
						coalesce(s.total_quantity,0) as total_quantity, 
						to_char(s.sales_date, 'dd-MM-yyyy HH:mm:ss') as sales_date, 
						u.first_name, 
						coalesce((select sum(si.discount) from sales_item si where si.sales_id = s.id),0) as total_discount
						FROM sales s
						join kds_user u on u.id = s.cashier_id
					where s.id = 'idSales' 
ERROR - 2024-12-05 12:30:30 --> Severity: Error --> Call to a member function result() on boolean C:\xampp\htdocs\pos1\application\core\MY_Model.php 89
