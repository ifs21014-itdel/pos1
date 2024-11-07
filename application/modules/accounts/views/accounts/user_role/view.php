<div class="easyui-layout" data-options="fit:true" style="border: none">        
	<div region="center"
		style="width:35%"
		 collapsible="false"
		 split="true"
		 title="List of User"
		 href="<?php echo site_url('accounts/user_role/view_user_mapping_to_role') ?>">                
	</div>
	<div region="east"
		 style="width:50%"
		 collapsible="false"
		 split="true"
		 title="List of Role Per User"
		 href="<?php echo site_url('accounts/user_role/view_role_mapping_to_user') ?>">
	</div>
</div>