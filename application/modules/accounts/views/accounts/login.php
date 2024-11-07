<html>
<head>
<link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen" />
<link href="<?php echo base_url() ?>css/login.css" rel="stylesheet" media="screen" />
<script> var rootUrl = "<?php echo base_url() ?>index.php";
</script>
</head>
<body>
	<div class="container">
		<div class="row page-header">
			<h1>PT. BEZ RETAILINDO</h1>
			<p class="lead">STORE :: <?php echo (isset($store_name) ? $store_name:"" );?></p>
		</div>
		<div class="row" style="padding-bottom: 20px;">
			<div class="col-md-8">
				<img class="featurette-image img-responsive"
					data-src="holder.js/500x500/auto" alt="500x500"
					src="<?php echo base_url("assets/img/login/retail.jpg")?>"
					data-holder-rendered="true">
			</div>
			<div class="col-md-3 col-md-push-1" style="
			    padding: 25px;
			    margin: 0;
			    border: 1px solid #eee;
			    border-top-width: 5px;
			    border-radius: 3px;
			    border-color: #1b809e;
			    min-height: 400px;
			    background-color: #f0f0f0;
			">
				<form class="form-signin"
					action="<?php echo base_url() ?>index.php/accounts/accounts/login_auth"
					method="POST">
					<input type="hidden"
						name="<?php echo $this->security->get_csrf_token_name();?>"
						value="<?php echo $this->security->get_csrf_hash();?>" />
					<h2 class="form-signin-heading">Sign In</h2>
					<label for="inputEmail" class="sr-only">Account ID</label> <input
						type="text" id="inputEmail" name='username' class="form-control"
						placeholder="Email address" required autofocus
						data-toggle="tooltip" data-placement="top" title="Email Address">
					<label for="inputPassword" class="sr-only">Password</label> <input
						type="password" id="inputPassword" name="password"
						class="form-control" placeholder="Password" required
						data-toggle="tooltip" data-placement="top" title="Password"> <br />
					<button class="btn btn-lg btn-primary btn-block" type="submit">Sign
						In</button>
				</form>
			</div>
		</div>
		<footer class="row footer"
			style="padding-top: 19px; color: #777; border-top: 1px solid #e5e5e5;">
			<p>&COPY; 2016 Bezmart.</p>
		</footer>
	</div>

	<script src="<?php echo base_url() ?>assets/js/jquery-2.0.3.min.js"></script>
	<script
		src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script>
		jQuery(function() {
		
		});
	</script>
</body>
</html>