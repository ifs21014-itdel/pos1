<?php

/**
 * Model Email
 *
 * @author Rizal.Gurning
 */
class Model_email extends CI_Model {

    function sendMail($employee_name, $department_name, $jobtitle_name, $leave_type, $start_date, $end_date, $amount, $event, $approver_name, $approver_email) {
        $this->load->library('email');

        $subject = '[Info] New Leave Request';
        $message = '<p>Please verify request leave with details below:</p>';

        $messageBody = $this->getMessage($employee_name, $department_name, $jobtitle_name, $leave_type, $start_date, $end_date, $amount, $event, $approver_name, $approver_email);

        $message .= $messageBody;
        $message .= '<br/><br/>
				Kind Regards,<br/>
				Ebako-HR';

        // Get full html:
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				    <title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) . '</title>
				    <style type="text/css">
				        body {
				            font-family: Arial, Verdana, Helvetica, sans-serif;
				            font-size: 16px;
				        }
				    </style>
				</head>
				<body>
				' . $message . '
				</body>
				</html>';
        // Also, for getting full html you may use the following internal method:
        // $body = $this->email->full_html($subject, $message);
        //,$approver_name,$approver_email
        //print_r($approver_email);
        $mail_from = $this->config->item('smtp_user');
        $result = $this->email->from($mail_from)->to($approver_email)->subject($subject)->message($body)->send();

        // print_r($message);
        // var_dump($result);
        // echo '<br />';
        // echo $this -> email -> print_debugger();
        // echo "send....";
        // exit;
    }

    function getMessage($employee_name, $department_name, $jobtitle_name, $leave_type, $start_date, $end_date, $amount, $event) {
        return '
				<table>
					<tr>
						<td align="right">Employee Name</td>
						<td>:</td>
						<td>' . ($employee_name == null ? "" : $employee_name) . '</td>
					</tr>
					<tr>
						<td align="right">Department</td>
						<td>:</td>
						<td>' . ($department_name == null ? "" : $department_name) . '</td>
					</tr>
					<tr>
						<td align="right">JobTitle</td>
						<td>:</td>
						<td>' . ($jobtitle_name == null ? "" : $jobtitle_name) . '</td>
					</tr>								
					<tr>
						<td align="right">Type</td>
						<td>:</td>
						<td>' . ($leave_type == null ? "" : $leave_type) . '</td>
					</tr>
					<tr>
						<td align="right">Start Date</td>
						<td>:</td>
						<td>' . ($start_date == null ? "" : $start_date) . '</td>
					</tr>
					<tr>
						<td align="right">End Date</td>
						<td>:</td>
						<td>' . ($end_date == null ? "" : $end_date) . '</td>
					</tr>
					<tr>
						<td align="right">Amount</td>
						<td>:</td>
						<td>' . ($amount == null ? "" : $amount) . ' Day(s)</td>
					</tr>
					<tr>
						<td align="right">Event</td>
						<td>:</td>
						<td>' . ($event == null ? "" : $event) . '</td>
					</tr>
				</table>
				';
    }

}

?>