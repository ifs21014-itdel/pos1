<form id="category_input_form" method="post" novalidate class="table_form">
	<input type="hidden" name="id">
	<table width="100%" border="0">
		<tr valign="top">
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td><strong>Nama Kategori</strong></td>
						<td><input type="text" name='name'
							class="easyui-validatebox" style="width: 98%" /></td>
					</tr>
					<tr>
						<td width="25%"><strong>Level</strong></td>
						<td width="75%"><select type="text" name='level'
							class="easyui-combobox" style="width: 50%" panelHeight="auto">
							<option value="1">Level 1</option>
							<option value="2">Level 2</option>
							<option value="3">Level 3</option>
							<option value="4">Level 4</option></select></td>
					</tr>
					<tr>
						<td width="25%"><strong>Parent ID</strong></td>
						<td width="75%"><input type="text" name='parent_id'
							class="easyui-textbox" style="width: 50%" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>

<script>
	function category_save() {
		$('#category_input_form').form('submit', {
			url : category_url,
			onSubmit : function() {
				return $(this).form('validate');
			},
			success : function(content) {
				console.log(content);
				var result = eval('(' + content + ')');
				if (result.success) {
					$('#category_dialog').dialog('close');
					$('#category').datagrid('reload');
				} else {
					$.messager.alert('Error', result.msg, 'error');
				}
			}
		});
	}
</script>