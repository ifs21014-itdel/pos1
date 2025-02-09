<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">

.general-error ::selection { background-color: #E13300; color: white; }
.general-error ::-moz-selection { background-color: #E13300; color: white; }

#container_general_error{
	width: 50%;
}

.general-error {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

.general-error a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

.general-error h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

.general-error code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

.general-error {
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
}

.general-error p {
	margin: 12px 15px 12px 15px;
}
</style>
<div id="container_general_error" class="general-error">
	<h1><?php echo $heading; ?></h1>
	<?php echo $message; ?>
	<p>
		<a href="<?php echo site_url();?>"><< Back To Home</a>
	</p>
</div>
