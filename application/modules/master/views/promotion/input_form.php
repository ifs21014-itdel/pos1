<form id="promotion_input_form" method="post" novalidate class="table_form">
	<input type="hidden" name="id">
	<table width="100%" border="0">
		<tr valign="top">
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td width="35%"><strong>Nama Barang</strong></td>
						<td width="65%">
							<input class="easyui-combobox" name="item_id"
								url="<?php echo site_url('master/item/get_data') ?>"
								method="post" valueField="id" textField="name"
								style="width: 100%" required="true" mode="remote" panelHeight="auto"/>
					    </td>
					</tr>
					<tr>
						<td><strong>Tipe Diskon</strong></td>
						<td><select type="text" name='discount_type' class="easyui-combobox"
							style="width: 50%" panelHeight="auto">
								<option value="PERCENT">PERCENT</option>
								<option value="PRICE">PRICE</option>
						</select></td>
					</tr>
					<tr>
						<td width="25%"><strong>Value</strong></td>
						<td width="75%"><input type="text" name='value'
							class="easyui-texbox" style="width: 20%" /></td>
					</tr>
					<tr>
						<td><strong>Awal Promo</strong></td>
						<td><input type="text" name='start_date' data-options="formatter:myformatter,parser:myparser"
							class="easyui-datebox" style="width: 80%" /></td>
					</tr>
					<tr>
						<td><strong>Akhir Promo</strong></td>
						<td><input type="text" name='end_date' data-options="formatter:myformatter,parser:myparser"
							class="easyui-datebox" style="width: 80%" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>

<script>
	function promotion_save() {
		$('#promotion_input_form').form('submit', {
			url : promotion_url,
			onSubmit : function() {
				return $(this).form('validate');
			},
			success : function(content) {
				console.log(content);
				var result = eval('(' + content + ')');
				if (result.success) {
					$('#promotion_dialog').dialog('close');
					$('#promotion').datagrid('reload');
				} else {
					$.messager.alert('Error', result.msg, 'error');
				}
			}
		});
	}
</script>