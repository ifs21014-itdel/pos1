<div id="role-form">
    <form id="add_role_form_id" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right"><label for="name">Role Nama :</label></td>
                <td><input type="text" name="name" class="easyui-validatebox" maxlength="200" required="true" size="30" value=""/></td>
            </tr>
        </table>        
    </form>
</div>

<script>
	function add_role() {
	    $('#add_role_form_id').form('submit', {
	        url: '<?php echo site_url("accounts/role/add_role")?>',
	        onSubmit: function() {
	            return $(this).form('validate');
	        },
	        success: function(content) {
	            console.log(content);
	            var result = eval('(' + content + ')');
	            if (result.success) {
	            	closeDialog("#add_role_popup");
					$('#accounts_role').datagrid('reload');
	            } else {
	                $.messager.alert('Error', result.msg, 'error');
	            }
	        }
	    });
	}
</script>