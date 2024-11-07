<form id="rtv_input_form" method="post" novalidate class="table_form">
	<input type="hidden" name="id">
	<table width="100%" border="0">
		<tr valign="top">
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td width="25%"><strong>Ref NO.</strong></td>
						<td width="75%"><input type="text" name='reference'
							class="easyui-validatebox" style="width: 90%" /></td>
					</tr>
					<tr>
						<td width="25%"><strong>Vendor</strong></td>
						<td width="75%"><input class="easyui-combobox" name="vendor_id"
		                       url="<?php echo site_url('master/Vendor/get_data') ?>"
		                       method="post" valueField="id" textField="name"
		                       data-options="formatter: namaSupplier"
		                       style="width: 80%" mode="remote" required="true" panelHeight="200"/>
		               			 <script type="text/javascript">
		                    		function namaSupplier(row) {
		                        	return '<span style="font-weight:bold;">' + row.code + '</span><br/>' +
		                                '<span style="color:#888">Desc: ' + row.name + '</span>';
		                    	}</script>
		                 </td>
					</tr>
					<tr>
						<td width="25%"><strong>Description</strong></td>
						<td width="75%"><input type="text" name='description'
							class="easyui-textbox" style="width: 100%" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>

<script>
	function rtv_save() {
		$('#rtv_input_form').form('submit', {
			url : rtv_url,
			onSubmit : function() {
				return $(this).form('validate');
			},
			success : function(content) {
				console.log(content);
				var result = eval('(' + content + ')');
				if (result.success) {
					$('#rtv_dialog').dialog('close');
					$('#rtv').datagrid('reload');
				} else {
					$.messager.alert('Error', result.msg, 'error');
				}
			}
		});
	}
</script>