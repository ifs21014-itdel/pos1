    <form id="edit_role_form" method="post" novalidate>
    	<input type="hidden" name="id">
        <table width="100%" border="0">
            <tr>
                <td align="right"><label for="name">Role Nama :</label></td>
                <td><input type="text" name="name" class="easyui-validatebox" maxlength="200" required="true" size="30"/></td>
            </tr>
            <tr>
                <td align="right"><label for="name">Active :</label></td>
                <td>
	                <input type="radio" name="active" value="true" class="easyui-validatebox" required="true"/>
	                <input type="radio" name="active" value="false" class="easyui-validatebox" required="true"/>
                </td>
            </tr>
        </table>        
    </form>
    
<script>
$(function(){
	var row = $('#accounts_role').datagrid('getSelected');
	$('#edit_role_form').form('load', row);
});

function update_role() {
    $('#edit_role_form').form('submit', {
        url: '<?php echo site_url("accounts/role/update_role")?>',
        onSubmit: function() {
			console.log("asdfasd");
        	return $(this).form('validate');
        },
        success: function(content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#edit_role_popup').dialog('close');
                $('#accounts_role').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}
</script>