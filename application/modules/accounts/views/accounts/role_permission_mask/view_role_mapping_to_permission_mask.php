<div id="role_mapping_to_permission_mask_toolbar" style="padding-bottom: 2px;">
	Role Nama : <input type="text" id="role_mapping_to_permission_mask_name_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){user_mapping_to_role_search()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="user_mapping_to_role_search()"> Search</a>
</div>
<table id="role_mapping_to_permission_mask"
	data-options="
       url:'<?php echo site_url('accounts/role/get_roles_with_pagination') ?>',
       method:'post',
       border:true,
       fit:true,
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:true,
       pageSize:30,
       pageList:[30, 50, 70, 100, 200],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true, 
       remoteSort:true,
       multiSort:true,
       toolbar:'#role_mapping_to_permission_mask_toolbar'">
	<thead>
		<tr>
            <th field="id" hidden="true"></th>
            <th field="name" width="220" halign="center">Role Name</th>            
        </tr>
	</thead>
</table>

<script type="text/javascript">
	$(function() {
		$('#role_mapping_to_permission_mask').datagrid({
			onSelect : function( index, role ){
				reloadPermissionMaskMappingToRole( role.id );
	        }
		});
	});
	
	function user_mapping_to_role_search() {
	    var nameValue = $('#role_mapping_to_permission_mask_name_ID').val();
	    $('#role_mapping_to_permission_mask').datagrid('reload', {
	    	name: nameValue
	    });
	}

	function reloadPermissionMaskMappingToRole(roleId){
		$('#permission_mask_mapping_to_role').datagrid('reload', {
			role_id: roleId
	    });
	}
</script>
