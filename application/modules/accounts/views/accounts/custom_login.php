<script>
	var rootUrl = "<?php echo base_url() ?>index.php";
</script>

      <form id="form_custom_login" class="form-signin" action="" method="POST">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
		<div class="row">
			<div class="col-xs-12">
		        <h3 class="form-signin-heading">Please sign in to change Discount</h3>
		        <label for="inputEmail" class="sr-only">User Name</label>
		        <input type="text" id="inputEmail" name='username' class="form-control" placeholder="Email address" required autofocus data-toggle="tooltip" data-placement="top" title="Email Address">
		        <label for="inputPassword" class="sr-only">Password</label>
		        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required data-toggle="tooltip" data-placement="top" title="Password">
		        <input type="button" id="button_submit_form" class="btn btn-lg btn-primary btn-block" value="Sign In"/>
	    	</div>
	    	<div class="col-xs-12">
	    		<p id="info_msg" style="color: #d9534f;padding-top: 10px;"></p>
	    	</div>
    	</div>
      </form>
	<script>
		jQuery(function() {
			$("#button_submit_form").click(function(){submitForm()});
		});

		function submitForm(){
			var param = $('#form_custom_login').serialize();
			$.ajax({
                type: "POST",
                url: "<?php echo site_url("/accounts/accounts/custom_login_auth");?>",
                data: param,
                dataType : "json",
                success: function(result){
                    console.log("data:",result);
                    if(result.message.isAllowed){
						console.log("allowed:",result.message.isAllowed);
						$('.login-discount-modal-md').modal("hide");
						$('.edit-discount-item-modal-lg').modal({'show':true,backdrop: 'static', keyboard: true});
						console.log('show modal dicount');
						
                    }else{
                    	console.log("not allowed:",result.message.info);
                    	$("#info_msg").text(result.message.info);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                	console.log("error:");
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
		}
		
	</script>
