<form id="store_input_form" method="post" novalidate class="table_form">
	<input type="hidden" name="id">
	<table width="100%" border="0">
		<tr valign="top">
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td><strong>Code</strong></td>
						<td><input type="text" name='code'
							class="easyui-texbox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Name</strong></td>
						<td><input type="text" name='name'
							class="easyui-texbox" style="width: 98%" /></td>
					</tr>
					<tr>
						<td width="25%"><strong>Address</strong></td>
						<td width="75%">
							<input type="text" name='address' class="easyui-texbox" style="width: 98%" />
						</td>
					</tr>
					<tr>
						<td width="25%"><strong>Serial Number</strong></td>
						<td width="75%">
							<input type="text" name='serial_number' class="easyui-texbox" style="width: 98%" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
<script>
	function store_save() {
		$('#store_input_form').form('submit', {
			url : store_url,
			onSubmit : function() {
				return $(this).form('validate');
			},
			success : function(content) {
				console.log(content);
				var result = eval('(' + content + ')');
				if (result.success) {
					$('#store_dialog').dialog('close');
					$('#store').datagrid('reload');
				} else {
					$.messager.alert('Error', result.msg, 'error');
				}
			}
		});
	}
</script>