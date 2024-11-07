<form id="transfer_req_input_form" method="post" novalidate class="table_form">
	<table width="100%" border="0">
		<tr valign="top">
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td><strong>TS Request ID</strong></td>
						<td><input type="text" name='id'
							class="easyui-texbox" style="width: 98%" /></td>
					</tr>
					<tr>
						<td><strong>Request TO</strong></td>
						<td><input class="easyui-combobox" name="request_to_store"
							url="<?php echo site_url('master/store/get') ?>"
							method="post" valueField="id" textField="name"
							style="width: 100%" required="true" mode="remote" panelHeight="auto"/></td>
					</tr>
					<tr>
						<td width="35%"><strong>Tanggal Pengiriman</strong></td>
						<td><input type="text" name='date_received_est' data-options="formatter:myformatter,parser:myparser"
							class="easyui-datebox" style="width: 50%" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>