<form id="vendor_input_form" method="post" novalidate
	class="table_form">
	<input type="hidden" name="id">
	<table width="100%" border="0">
		<tr valign="top">
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td><strong>Vendor ID</strong></td>
						<td><input type="text" required="true" name='code' class="easyui-textbox"
							style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Vendor Name</strong></td>
						<td><input type="text" required="true" name='name' class="easyui-textbox"
							style="width: 100%" /></td>
					</tr>
					<tr>
						<td><strong>NPWP</strong></td>
						<td><input type="text" required="true" name='npwp' class="easyui-textbox"
							style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Phone Number</strong></td>
						<td><input type="text" required="true" name='phone_number' class="easyui-textbox"
							style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Contact Name</strong></td>
						<td><input type="text" required="true" name='contact_name' class="easyui-textbox"
							style="width: 100%" /></td>
					</tr>
					<tr>
						<td><strong>Contact Number</strong></td>
						<td><input type="text" required="true" name='contact_number' class="easyui-textbox"
							style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Discount(%)</strong></td>
						<td><input type="text" required="true" name='discount' class="easyui-textbox"
							style="width: 20%" /></td>
					</tr>
					<tr>
						<td><strong>Promo Discount(%)</strong></td>
						<td><input type="text" required="true" name='discount_promotion' class="easyui-textbox"
							style="width: 20%" /></td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td><strong>Address</strong></td>
						<td><input type="text" required="true" name='address' class="easyui-textbox"
							data-options="multiline:true" style="width: 130%; height: 75px" /></td>
					</tr>
					<tr>
						<td><strong>Description</strong></td>
						<td><input type="text" required="true" name='description' class="easyui-textbox"
							data-options="multiline:true" style="width: 100%; height: 75px" /></td>
					</tr>
					<tr>
						<td><strong>Term Of Payment</strong></td>
						<td><input type="text" required="true" name='term_of_payment'
							class="easyui-textbox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>PKP Status</strong></td>
						<td>
						<select name="pkp" required="true" panelHeight="auto" class="easyui-combobox">
							<option value="t">YA</option>
							<option value="f">TIDAK</option>
						</select>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>

<script>
	function vendor_save() {
		$('#vendor_input_form').form('submit', {
			url : vendor_url,
			onSubmit : function() {
				return $(this).form('validate');
			},
			success : function(content) {
				console.log(content);
				var result = eval('(' + content + ')');
				if (result.success) {
					$('#vendor_dialog').dialog('close');
					$('#vendor').datagrid('reload');
				} else {
					$.messager.alert('Error', result.msg, 'error');
				}
			}
		});
	}
</script>