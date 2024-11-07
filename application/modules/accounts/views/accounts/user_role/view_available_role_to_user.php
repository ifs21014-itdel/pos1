<div id="list_available_role_to_user_toolbar" style="padding-top: 5px; padding-bottom: 10px; height: auto;">
	Code : <input type="text" id="name_available_role_to_user_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){list_available_role_to_user_search()}" />
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="list_available_role_to_user_search()"> Search</a>
</div>
<table id="list_available_role_to_user"
	data-options="
	   url:'<?php echo site_url('accounts/user_role/get_available_roles_to_user_with_pagination?user_id='.$user_id) ?>',
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
       toolbar:'#list_available_role_to_user_toolbar'">
	<thead>
		<tr>
			<th data-options="field:'id',checkbox:true"></th>
            <th field="name" width="220" halign="center">Role Name</th>    
		</tr>
	</thead>
</table>
<script type="text/javascript">
	$(function(){
	    $('#list_available_role_to_user').datagrid({});
	});
	
	function list_available_role_to_user_search(){
		var roleName = $('#name_available_role_to_user_ID').val();
		$('#list_available_role_to_user').datagrid('reload', {
	    	role_name : roleName,
	    });
	}

	function assign_role_to_user(){
		var user = $('#user_mapping_to_role').datagrid('getSelected');
	    var roles = $('#list_available_role_to_user').datagrid('getSelections');

		console.log(user);
		console.log(roles);
	    
	    if (roles !== null) {
			var param="";
		    $.each(roles, function (key, role) {
		    	param +="role_id[]="+ role.id+"&";
	        });
			param += "user_id="+user.id

			console.log("param: ");
			console.log(param);
	        
			$.ajax({
				  type: "GET",
				  url: "<?php echo site_url("accounts/user_role/assign_role_to_user")?>",
				  data: param,
				  success: function(data){
					closeDialog("#list_available_role_popup");
					$('#role_mapping_to_user').datagrid('reload');
			      }
		     });
			
		}else{
			$.messager.alert('Warning', 'Please select atlease 1 row to Continue', 'warning');
		}
	}

</script>