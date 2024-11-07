<div id="user_mapping_to_role_toolbar" style="padding-bottom: 2px;">
	User Nama : <input type="text" id="username_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){user_mapping_to_role_search()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="user_mapping_to_role_search()"> Search</a>
</div>
<table id="user_mapping_to_role"
	data-options="
       url:'<?php echo site_url('accounts/user/get_users_with_pagination') ?>',
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
       toolbar:'#user_mapping_to_role_toolbar'">
	<thead>
		<tr>
            <th field="id" hidden="true"></th>
            <th field="username" width="220" halign="center">User Access Name(Login)</th>            
        </tr>
	</thead>
</table>

<script type="text/javascript">
	$(function() {
		$('#user_mapping_to_role').datagrid({
			onSelect : function( index, user ){
				reloadRoleMappingToUser( user.id );
	        }
		});
	});
	
	function user_mapping_to_role_search() {
	    var usernameValue = $('#username_ID').val();
	    $('#user_mapping_to_role').datagrid('reload', {
	    	username: usernameValue
	    });
	}

	function reloadRoleMappingToUser(userId){
		$('#role_mapping_to_user').datagrid('reload', {
			user_id: userId
	    });
	}
</script>
