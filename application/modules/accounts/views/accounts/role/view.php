<div id="accounts_role_toolbar" style="padding-bottom: 2px;">            
    Role Name : <input type="text" id="role_name_ID" size="10" class="easyui-validatebox" name="name" onkeypress="if(event.keyCode==13){role_search()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="role_search()"> Search</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="show_add_role_view()"> Add Role</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="show_role_edit_view()"> Edit Role</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="delete_role()"> Delete Role</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="role_activate()">Active</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="role_deactivate()">De-Active</a>
</div>
<table id="accounts_role" data-options="
       url:'<?php echo site_url('accounts/role/get_roles_with_pagination') ?>',
       method:'post',
       border:true,
       singleSelect:false,
       selectOnCheck:true,
       checkOnSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 100, 200],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true, 
       toolbar:'#accounts_role_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="name" width="220" halign="center">Role Name</th>            
            <th field="active" width="50" halign="center">Active</th>
        </tr>
    </thead>
</table>

<div id="add_role_popup"></div>
<div id="edit_role_popup"></div>

<script type="text/javascript">
    $(function() {
    	$('#accounts_role').datagrid({});
    });

    function role_search() {
	    var roleName = $('#role_name_ID').val();
	    $('#accounts_role').datagrid('reload', {
	    	name: roleName
	    });
	}

	function closeDialog(dialogId){
		$(dialogId).dialog('close');
	}
    
	function show_add_role_view(){
		$('#add_role_popup').dialog({
		    title: 'Add New Role',
		    width: '300px',
		    height: '120px',
		    closed: false,
		    cache: false,
		    href: '<?php echo site_url("accounts/role/add_role_view") ?>',
		    modal: true,
		    buttons: [{
				text:'Ok',
				iconCls:'icon-ok',
				handler:function(){
					add_role(); //this method in add
				}
			},{
				text:'Cancel',
				handler:function(){
					closeDialog("#add_role_popup");
				}
			}]
	    
		});
	}

	function show_role_edit_view() {
	    var row = $('#accounts_role').datagrid('getSelected');
	    console.log(row);
	    if (row !== null) {
	    	$('#edit_role_popup').dialog({
			    title: 'Edit Role',
			    width: '300px',
			    height: '120px',
			    closed: false,
			    cache: false,
			    href: '<?php echo site_url("accounts/role/edit_role_view") ?>',
			    modal: true,
			    buttons: [{
					text:'Ok',
					iconCls:'icon-ok',
					handler:function(){
						update_role(); //this method in edit
					}
				},{
					text:'Cancel',
					iconCls :"icon-cancel",
					handler:function(){
						closeDialog("#edit_role_popup");
					}
				}]
		    
			});
	    } else {
	        $.messager.alert('Notification', 'Please select 1 row to continue', 'warning');
	    }
	}

	function delete_role() {
	    var rows = $('#accounts_role').datagrid('getSelections');
	    if (rows !== null) {
	        $.messager.confirm('Confirm', 'Are you sure you want to delete that role(s)?', function(r) {
	            if (r) {
	        		var param="";
	        		var i=0;
	        	    $.each(rows, function (key, data) {
	        	    	param +="id[]="+ data.id + ( i == (rows.length - 1 ) ? "" : "&" );
	        	    	i++;
	                });        	
	                $.get('<?php echo site_url("accounts/role/delete_role")?>', param ,
	                 function(result) {
	                    if (result.success) {
	                        $('#accounts_role').datagrid('reload');
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

	function role_activate() {
	    var rows = $('#accounts_role').datagrid('getSelections');
	    if (rows !== null) {
        		var param="";
        		var i=0;
        	    $.each(rows, function (key, data) {
        	    	param +="id[]="+ data.id + ( i == (rows.length - 1 ) ? "" : "&" );
        	    	i++;
                });
                $.get('<?php echo site_url("accounts/role/activate_role")?>', param ,
                 function(result) {
                    if (result.success) {
                        $('#accounts_role').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
	    } else {
	        $.messager.alert('Warning', 'Select at least 1 row to continue.', 'warning');
	    }
	}

	function role_deactivate() {
	    var rows = $('#accounts_role').datagrid('getSelections');
	    if (rows !== null) {
        		var param="";
        		var i=0;
        	    $.each(rows, function (key, data) {
        	    	param +="id[]="+ data.id + ( i == (rows.length - 1 ) ? "" : "&" );
        	    	i++;
                });
                $.get('<?php echo site_url("accounts/role/deactivate_role")?>', param ,
                 function(result) {
                    if (result.success) {
                        $('#accounts_role').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
	    } else {
	        $.messager.alert('Warning', 'Select at least 1 row to continue.', 'warning');
	    }
	}
</script>
