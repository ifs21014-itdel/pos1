<div id="account_user_toolbar" style="padding-bottom: 2px;">            
    Nama : <input type="text" id="username_ID" size="10" class="easyui-validatebox" name="username" onkeypress="if(event.keyCode==13){user_search()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="user_search()"> Search</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="show_user_add_view()"> Add</a>
    
    <?php if(Authority::hasPermission(Permission::ACCOUNT_USER_UPDATE)){?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="show_user_edit_view()"> Edit </a>
    <?php }?>
    
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="user_delete()"> Delete</a>
    
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="user_activate()">Active</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="user_deactivate()">De-Active</a>
</div>
<table id="account_user" data-options="
       url:'<?php echo site_url('accounts/user/get_users_with_pagination') ?>',
       method:'post',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [10, 30, 50, 70, 100, 200],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       toolbar:'#account_user_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="username" width="220" halign="center">User Access Name(Login)</th>            
            <th field="email" width="220" halign="center">Email</th>
            <th field="first_name" width="220" halign="center">First Name</th>
            <th field="last_name" width="220" halign="center">Last Name</th>
            <th field="active" width="50" halign="center">Active</th>
        </tr>
    </thead>
</table>

<div id="add_user_popup"></div>
<div id="edit_user_popup"></div>

<script type="text/javascript">
    $(function() {
    	$('#account_user').datagrid({});
    });

    function user_search() {
	    var usernameValue = $('#username_ID').val();
	    $('#account_user').datagrid('reload', {
	    	username: usernameValue
	    });
	}

	function closeDialog(dialogId){
		$(dialogId).dialog('close');
	}
    
	function show_user_add_view(){
		$('#add_user_popup').dialog({
		    title: 'Add New User',
		    width: '300px',
		    height: '220px',
		    closed: false,
		    cache: false,
		    href: '<?php echo site_url("accounts/user/add_user_view") ?>',
		    modal: true,
		    buttons: [{
				text:'Ok',
				iconCls:'icon-ok',
				handler:function(){
					add_user(); //this method in add
				}
			},{
				text:'Cancel',
				handler:function(){
					closeDialog("#add_user_popup");
				}
			}]
	    
		});
	}

	function show_user_edit_view() {
	    var row = $('#account_user').datagrid('getSelected');
	    if (row !== null) {
	    	$('#edit_user_popup').dialog({
			    title: 'Edit User',
			    width: '300px',
			    height: '220px',
			    closed: false,
			    cache: false,
			    href: '<?php echo site_url("accounts/user/edit_user_view") ?>',
			    modal: true,
			    buttons: [{
					text:'Ok',
					iconCls:'icon-ok',
					handler:function(){
						update_user(); //this method in edit
					}
				},{
					text:'Cancel',
					iconCls :"icon-cancel",
					handler:function(){
						closeDialog("#edit_user_popup");
					}
				}]
		    
			});
	    } else {
	        $.messager.alert('Notification', 'Please select 1 row to continue', 'warning');
	    }
	}

	function user_delete() {
	    var rows = $('#account_user').datagrid('getSelections');
	    if (rows !== null) {
	        $.messager.confirm('Confirm', 'Are you sure you want to delete that User(s)?', function(r) {
	            if (r) {
	        		var param="";
	        		var i=0;
	        	    $.each(rows, function (key, data) {
	        	    	param +="id[]="+ data.id + ( i == (rows.length - 1 ) ? "" : "&" );
	        	    	i++;
	                });        	
	                $.get('<?php echo site_url("accounts/user/delete_user")?>', param ,
	                 function(result) {
	                    if (result.success) {
	                        $('#account_user').datagrid('reload');
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

	function user_activate() {
	    var rows = $('#account_user').datagrid('getSelections');
	    if (rows !== null) {
        		var param="";
        		var i=0;
        	    $.each(rows, function (key, data) {
        	    	param +="id[]="+ data.id + ( i == (rows.length - 1 ) ? "" : "&" );
        	    	i++;
                });
                $.get('<?php echo site_url("accounts/user/activate_user")?>', param ,
                 function(result) {
                    if (result.success) {
                        $('#account_user').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
	    } else {
	        $.messager.alert('Warning', 'Select at least 1 row to continue.', 'warning');
	    }
	}

	function user_deactivate() {
	    var rows = $('#account_user').datagrid('getSelections');
	    if (rows !== null) {
        		var param="";
        		var i=0;
        	    $.each(rows, function (key, data) {
        	    	param +="id[]="+ data.id + ( i == (rows.length - 1 ) ? "" : "&" );
        	    	i++;
                });
                $.get('<?php echo site_url("accounts/user/deactivate_user")?>', param ,
                 function(result) {
                    if (result.success) {
                        $('#account_user').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
	    } else {
	        $.messager.alert('Warning', 'Select at least 1 row to continue.', 'warning');
	    }
	}
</script>
