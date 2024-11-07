<form id="item_ts_form" method="post" novalidate class="table_form">
	<table width="100%" border="0">
		<tr>
			<td width="35%">
				<strong>Nama Barang</strong>
			</td>
			<td width="65%">
				<input class="easyui-combobox" name="item_name" url="<?php echo site_url('master/item/get') ?>" method="post"
					valueField="barcode" textField="name" style="width: 100%" required="true" mode="remote" panelHeight="auto" />
			</td>
		</tr>
		<tr>
			<td>
				<strong>Jumlah PCS/Satuan</strong>
			</td>
			<td>
				<input type="text" name='quantity' class="easyui-textbox" style="width: 100%" />
			</td>
		</tr>
	</table>
</form>