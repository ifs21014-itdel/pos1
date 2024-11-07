<form id="vendor_item_input_form" method="post" novalidate class="table_form">
	<input type="hidden" name="id">
	<table width="100%" border="0">
		<tr valign="top">
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td width="25%"><strong>Vendor</strong></td>
						<td width="75%"><input class="easyui-combobox" name="vendor_id"
							url="<?php echo site_url('master/vendor/get_data') ?>"
							method="post" id="vendor_id" valueField="id" textField="name"
							style="width: 100%" required="true" mode="remote" />
						</td>
					</tr>
					<tr>
						<td width="25%"><strong>Barang</strong></td>
						<td width="75%"><input class="easyui-combobox" name="item_id"
							url="<?php echo site_url('master/item/get_data') ?>"
							method="post" id="item_id" valueField="id" textField="name"
							style="width: 100%" required="true" mode="remote" />
						</td>
					</tr>
					<tr>
						<td width="25%"><strong>Diskon (%)</strong></td>
						<td width="75%"><input type="text" required="true" name='discount' class="easyui-textbox" style="width: 50%" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
<script>
function vendor_item_save() {
	$('#vendor_item_input_form').form('submit', {
		url : vendor_item_url,
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(content) {
			console.log(content);
			var result = eval('(' + content + ')');
			if (result.success) {
				$('#vendor_item_dialog').dialog('close');
				$('#vendor_item').datagrid('reload');
			} else {
				$.messager.alert('Error', result.msg, 'error');
			}
		}
	});
}
</script>