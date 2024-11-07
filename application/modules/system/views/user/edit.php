    <form id="edit_user_form" method="post" novalidate>
    	<input type="hidden" name="id">
        <table width="100%" border="0">
            <tr>
                <td align="right"><label for="username">User Access Name (Login) :</label></td>
                <td><input type="text" name="username" class="easyui-validatebox" required="true" value=""/></td>
            </tr>
            <tr>
                <td align="right"><label for="email">Email :</label></td>
                <td><input type="text" name="email" class="easyui-validatebox" required="true" value=""/></td>
            </tr>
            <tr>
                <td align="right"><label for="first_name">First Name :</label></td>
                <td><input type="text" name="first_name" class="easyui-validatebox" required="true" value=""/></td>
            </tr>
            <tr>
                <td align="right"><label for="last_name">Last Name :</label></td>
                <td><input type="text" name="last_name" class="easyui-validatebox" required="true" value=""/></td>
            </tr>            
            <tr>
                <td align="right"><label for="passord">Password :</label></td>
                <td><input type="text" name="password" class="easyui-validatebox"  required="true" value=""/></td>
            </tr>
        </table>        
    </form>
    
<script>
$(function(){
	var row = $('#account_user').datagrid('getSelected');
	$('#edit_user_form').form('load', row);
});

function update_user() {
    $('#edit_user_form').form('submit', {
        url: '<?php echo site_url("accounts/user/update_user")?>',
        onSubmit: function() {
        	return $(this).form('validate');
        },
        success: function(content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#edit_user_popup').dialog('close');
                $('#account_user').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}
</script>