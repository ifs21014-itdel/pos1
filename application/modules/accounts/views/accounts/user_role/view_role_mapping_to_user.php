<div id="role_mapping_to_user_toolbar" style="padding-bottom: 2px;">
	Role Nama : <input type="text" id="username_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){user_mapping_to_role_search()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="user_mapping_to_role_search()"> Search</a>
    
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="show_view_assign_role_to_user()">Assign Role To User</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="un_assign_role_from_user()">UnAssign Role From User</a>
</div>
<table id="role_mapping_to_user"
	data-options="
       url:'<?php echo site_url('accounts/user_role/get_roles_mapping_to_user_with_pagination') ?>',
       method:'post',
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
       toolbar:'#role_mapping_to_user_toolbar'">
	<thead>
		<tr>
            <th field="id" hidden="true"></th>
            <th field="name" width="220" halign="center">Role Name</th>            
        </tr>
	</thead>
</table>

<div id="list_available_role_popup"></div>

<script type="text/javascript">
	$(function() {
		$('#role_mapping_to_user').datagrid({
		});
	});

	function show_view_assign_role_to_user(){
	    var user = $('#user_mapping_to_role').datagrid('getSelected');
	    if (user !== null) {
			$('#list_available_role_popup').dialog({
			    title: 'Assign Role To User',
			    width: '60%',
			    height: '80%',
			    closed: false,
			    cache: false,
			    href: '<?php echo site_url("accounts/user_role/view_available_role_to_user") ?>?user_id=' + user.id,
			    modal: true,
			    buttons: [{
					text:'Ok',
					iconCls:'icon-ok',
					handler:function(){
						assign_role_to_user(); //this method in view_available_role_to_user
					}
				},{
					text:'Cancel',
					handler:function(){
						closeDialog("#list_available_role_popup");
					}
				}]
		    
			});
		}else{
			$.messager.alert('Warning', 'Please select 1 row to Continue', 'warning');
		}
	}

	function closeDialog(dialogId){
		$(dialogId).dialog('close');
	}
	
	function un_assign_role_from_user() {
	    var rows = $('#role_mapping_to_user').datagrid('getSelections');
	    if (rows !== null) {
	        $.messager.confirm('Confirm', 'Are you sure you want to UnAssign Role(s) from User?', function(r) {
	            if (r) {
	        		var param="";
	        		var i=0;
	        	    $.each(rows, function (key, data) {
	        	    	param +="id[]="+ data.id + ( i == (rows.length - 1 ) ? "" : "&" );
	        	    	i++;
	                });            	
	                
	                $.get('<?php echo site_url("accounts/user_role/un_assign_role_from_user")?>', param ,
	                 function(result) {
	                    if (result.success) {
	                        $('#role_mapping_to_user').datagrid('reload');
	                    } else {
	                        $.messager.alert('Error', result.msg, 'error');
	                    }
	                }, 'json');
	            }
	        });
	    } else {
	        $.messager.alert('Warning', 'Select at least 1 row to continue.', 'warning');
	    }
	}
	
</script>
