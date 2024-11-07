<form id="item_input_form" method="post" novalidate class="table_form">
    <input type="hidden" name="id">
	<table width="100%" border="0">
		<tr valign="top">
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td width="40%"><strong>SKU</strong></td>
						<td width="60%"><input type="text" name='sku'
							class="easyui-validatebox" required="true" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Nama Barang</strong></td>
						<td><input type="text" name='name' class="easyui-validatebox"
							style="width: 98%" /></td>
					</tr>
					<tr>
						<td width="25%"><strong>Barcode</strong></td>
						<td width="75%"><input type="text" name='barcode'
							class="easyui-validatebox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td width="25%"><strong>Harga Pokok Pembelian</strong></td>
						<td width="75%"><input type="text" name='cost'
							class="easyui-validatebox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Harga Jual</strong></td>
						<td><input type="text" name='retail_price'
							class="easyui-validatebox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Trading Price</strong></td>
						<td><input type="text" name='trading_price'
							class="easyui-validatebox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>BKP</strong></td>
						<td><select type="text" name='taxed' class="easyui-combobox"
							style="width: 50%" panelHeight="auto">
								<option value="t">YES</option>
								<option value="f">NO</option>
						</select></td>
					</tr>
					<tr>
						<td><strong>Consignment</strong></td>
						<td><select type="text" name='consignment' class="easyui-combobox"
							style="width: 50%" panelHeight="auto">
								<option value="t">YES</option>
								<option value="f">NO</option>
						</select></td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td width="40%"><strong>Kategori LVL 1</strong></td>
						<td width="60%"><input class="easyui-combobox" name="category1"
							url="<?php echo site_url('master/category/get_data/1') ?>"
							method="post" id="cat1" valueField="id" textField="name"
							style="width: 100%" required="true" mode="remote" panelHeight="auto"/></td>
					</tr>
					<tr>
						<td><strong>Kategori LVL 2</strong></td>
						<td><input class="easyui-combobox" name="category2"
							url="<?php echo site_url('master/category/get_data/2') ?>"
							method="post" id="cat2" valueField="id" textField="name"
							style="width: 100%" required="true" mode="remote" /></td>
					</tr>
					<tr>
						<td width="25%"><strong>Kategori LVL 3</strong></td>
						<td width="75%"><input class="easyui-combobox" name="category3"
							url="<?php echo site_url('master/category/get_data/3') ?>"
							method="post" id="cat3" valueField="id" textField="name"
							style="width: 100%" required="true" mode="remote" /></td>
					</tr>
					<tr>
						<td><strong>Kategori LVL 4</strong></td>
						<td><input class="easyui-combobox" name="category4"
							url="<?php echo site_url('master/category/get_data/4') ?>"
							method="post" id="cat4" valueField="id" textField="name"
							style="width: 100%" required="true" mode="remote" /></td>
					</tr>
					<tr>
						<td><strong>Satuan</strong></td>
						<td><input class="easyui-combobox" name="uom_id"
							url="<?php echo site_url('master/UOM/get') ?>"
							method="post" valueField="id" textField="code"
							data-options="formatter: unitformat"
							style="width: 100%" required="true" mode="remote" panelHeight="auto"/>
							<script type="text/javascript">
                    function unitformat(row) {
                        return '<span style="font-weight:bold;">' + row.code + '</span><br/>' +
                                '<span style="color:#888">Desc: ' + row.name + '</span>';
                    }
                </script></td>
					</tr>
					<tr>
						<td><strong>BOM ?</strong></td>
						<td><select type="text" name='bom_status' class="easyui-combobox"
							style="width: 50%">
							<option value="t">YES</option>
							<option value="f">NO</option></select></td>
					</tr>
					<tr>
						<td width="25%"><strong>Type</strong></td>
						<td width="75%"><select type="text" name='type' class="easyui-combobox"
							style="width: 50%" panelHeight="auto">
								<option value="1">Retail</option>
								<option value="2">Material</option>
								<option value="3">Trading</option>
						</select></td>
					</tr>
					<tr>
						<td width="25%"><strong>CARTON</strong></td>
						<td width="75%"><input type="text" name='carton'
							class="easyui-validatebox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>INNER</strong></td>
						<td><input type="text" name='inner' class="easyui-validatebox"
							style="width: 50%" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>

<script>
	function item_save() {
		$('#item_input_form').form('submit', {
			url : item_url,
			onSubmit : function() {
				return $(this).form('validate');
			},
			success : function(content) {
				console.log(content);
				var result = eval('(' + content + ')');
				if (result.success) {
					$('#item_dialog').dialog('close');
					$('#item').datagrid('reload');
				} else {
					$.messager.alert('Error', result.msg, 'error');
				}
			}
		});
	}
</script>