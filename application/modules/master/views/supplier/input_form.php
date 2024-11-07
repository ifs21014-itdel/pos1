<form id="supplier_input_form" method="post" novalidate
	class="table_form">
	<table width="100%" border="0">
		<tr valign="top">
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td><strong>ID Supplier</strong></td>
						<td><input type="text" name='supplier_id' class="easyui-textbox"
							style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Nama Supplier</strong></td>
						<td><input type="text" name='nama' class="easyui-textbox"
							style="width: 100%" /></td>
					</tr>
					<tr>
						<td><strong>NPWP</strong></td>
						<td><input type="text" name='npwp' class="easyui-textbox"
							style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Telepon</strong></td>
						<td><input type="text" name='telepon' class="easyui-textbox"
							style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Kontak Nama</strong></td>
						<td><input type="text" name='kontak_nama' class="easyui-textbox"
							style="width: 100%" /></td>
					</tr>
					<tr>
						<td><strong>Nomor Kontak</strong></td>
						<td><input type="text" name='nomor_kontak' class="easyui-textbox"
							style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Diskon Reguler (%)</strong></td>
						<td><input type="text" name='diskon' class="easyui-textbox"
							style="width: 20%" /></td>
					</tr>
					<tr>
						<td><strong>Diskon Promo (%)</strong></td>
						<td><input type="text" name='diskon_promo' class="easyui-textbox"
							style="width: 20%" /></td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td><strong>Alamat</strong></td>
						<td><input type="text" name='alamat' class="easyui-textbox"
							data-options="multiline:true" style="width: 130%; height: 75px" /></td>
					</tr>
					<tr>
						<td><strong>Keterangan</strong></td>
						<td><input type="text" name='keterangan' class="easyui-textbox"
							data-options="multiline:true" style="width: 100%; height: 75px" /></td>
					</tr>
					<tr>
						<td><strong>Term Of Payment</strong></td>
						<td><input type="text" name='term_of_payment'
							class="easyui-textbox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>PKP Status</strong></td>
						<td>
						<select name="pkp" panelHeight="auto" class="easyui-combobox">
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