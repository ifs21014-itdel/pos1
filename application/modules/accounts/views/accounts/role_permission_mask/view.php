<div class="easyui-layout" data-options="fit:true" style="border: none">        
	<div region="center"
		 style="width:30%"
		 collapsible="false"
		 split="true"
		 title="List of Role"
		 href="<?php echo site_url('accounts/role_permission_mask/role_mapping_to_permission_mask_view') ?>">                
	</div>
	<div region="east"
		 style="width:70%"
		 collapsible="false"
		 split="true"
		 title="List of Permission Per Role"
		 href="<?php echo site_url('accounts/role_permission_mask/permission_mask_mapping_to_role_view') ?>">
	</div>
</div>