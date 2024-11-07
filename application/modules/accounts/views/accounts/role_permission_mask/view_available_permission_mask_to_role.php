<div id="list_available_permission_mask_to_role_toolbar" style="padding-top: 5px; padding-bottom: 10px; height: auto;">
	Code : <input type="text" id="name_available_permission_mask_to_role_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){search_available_permission_mask_to_role()}" />
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="search_available_permission_mask_to_role()"> Search</a>
</div>
<table id="list_available_permission_mask_to_role"
	data-options="
	   url:'<?php echo site_url('accounts/role_permission_mask/get_available_permission_mask_to_role_with_pagination?role_id='.$role_id) ?>',
       method:'get',
       border:true,
       fit:true,
       singleSelect:false,
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
       toolbar:'#list_available_permission_mask_to_role_toolbar'">
	<thead>
		<tr>
			<th data-options="field:'id',checkbox:true"></th>
            <th field="code" width="280" halign="center">Code</th>
            <th field="description" width="280" halign="center">Description</th>     
            <th field="group_code" width="200" halign="center">Group Code</th> 
		</tr>
	</thead>
</table>
<script type="text/javascript">
	$(function(){
	    $('#list_available_permission_mask_to_role').datagrid({});
	});
	
	function search_available_permission_mask_to_role(){
		var permissionMaskCode = $('#name_available_permission_mask_to_role_ID').val();
		$('#list_available_permission_mask_to_role').datagrid('reload', {
	    	code : permissionMaskCode,
	    });
	}

	function assign_permission_mask_to_role(){
		var role = $('#role_mapping_to_permission_mask').datagrid('getSelected');
	    var permissionMasks = $('#list_available_permission_mask_to_role').datagrid('getSelections');
	    if (permissionMasks !== null) {
			var param = "";
		    $.each(permissionMasks, function (key, permissionMask) {
		    	param +="permission_mask_id[]=" + permissionMask.id + "&";
	        });
			param += "role_id="+role.id

			console.log("param: ");
			console.log(param);
	        
			$.ajax({
				  type: "GET",
				  url: "<?php echo site_url("accounts/role_permission_mask/assign_permission_mask_to_role")?>",
				  data: param,
				  success: function(data){
					closeDialog("#list_available_permission_mask_popup");
					$('#permission_mask_mapping_to_role').datagrid('reload');
			      }
		     });
			
		} else {
			$.messager.alert('Warning', 'Please select atlease 1 row to continue', 'warning');
		}
	}

</script>