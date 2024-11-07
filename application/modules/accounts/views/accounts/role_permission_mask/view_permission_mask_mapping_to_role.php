<div id="permission_mask_mapping_to_role_toolbar" style="padding-bottom: 2px;">
	Code : <input type="text" id="permission_mask_mapping_to_role_code_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){search_permission_mask_mapping_to_role()}" />
	Group Code : <input type="text" id="permission_mask_mapping_to_role_group_code_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){search_permission_mask_mapping_to_role()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="search_permission_mask_mapping_to_role()"> Search</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="show_view_assign_permission_mask_to_role()">Assign Permission To Role</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="un_assign_permission_mask_from_role()">UnAssign Permission From Role</a>
	
</div>
<table id="permission_mask_mapping_to_role"
	data-options="
       url:'<?php echo site_url('accounts/role_permission_mask/get_permission_masks_mapping_to_role_with_pagination') ?>',
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
       toolbar:'#permission_mask_mapping_to_role_toolbar'">
	<thead>
		<tr>
            <th field="id" hidden="true"></th>
            <th field="code" width="280" halign="center">Code</th>
            <th field="description" width="280" halign="center">Description</th>     
            <th field="group_code" width="200" halign="center">Group Code</th>       
        </tr>
	</thead>
</table>

<div id="list_available_permission_mask_popup"></div>

<script type="text/javascript">
	$(function() {
		$('#permission_mask_mapping_to_role').datagrid({
		});
	});

	function search_permission_mask_mapping_to_role() {
	    var codeValue = $('#permission_mask_mapping_to_role_code_ID').val() || "";
	    var groupCodeValue = $('#permission_mask_mapping_to_role_group_code_ID').val() || "";
	    var role = $('#role_mapping_to_permission_mask').datagrid('getSelected') || {id:""};
	    $('#permission_mask_mapping_to_role').datagrid('reload', {
	    	code: codeValue,
	    	group_code:groupCodeValue,
	    	role_id : role.id
	    });
	}

	function show_view_assign_permission_mask_to_role(){
	    var role = $('#role_mapping_to_permission_mask').datagrid('getSelected');
	    if (role !== null) {
			$('#list_available_permission_mask_popup').dialog({
			    title: 'Assign Permission To Role',
			    width: '60%',
			    height: '80%',
			    closed: false,
			    cache: false,
			    href: '<?php echo site_url("accounts/role_permission_mask/available_permission_mask_to_role_view") ?>?role_id=' + role.id,
			    modal: true,
			    buttons: [{
					text:'Ok',
					iconCls:'icon-ok',
					handler:function(){
						assign_permission_mask_to_role(); //this method in view_available_permission_to_role
					}
				},{
					text:'Cancel',
					handler:function(){
						closeDialog("#list_available_permission_mask_popup");
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
	
	function un_assign_permission_mask_from_role() {
	    var rows = $('#permission_mask_mapping_to_role').datagrid('getSelections');
	    console.log(rows);
	    if (rows !== null) {
	        $.messager.confirm('Confirm', 'Are you sure you want to UnAssign PermissionMask(s) from Role?', function(r) {
	            if (r) {
	        		var param="";
	        		var i=0;
	        	    $.each(rows, function (key, data) {
	        	    	param +="id[]="+ data.id + ( i == (rows.length - 1 ) ? "" : "&" );
	        	    	i++;
	                });        	
	                $.get('<?php echo site_url("accounts/role_permission_mask/un_assign_permission_mask_from_role")?>', param ,
	                 function(result) {
	                    if (result.success) {
	                        $('#permission_mask_mapping_to_role').datagrid('reload');
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
