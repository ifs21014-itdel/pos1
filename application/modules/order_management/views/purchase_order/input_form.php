<form id="po_input_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">

        <tr>
            <td width="40%"><strong>Toko</strong></td>
            <td width="60%"><input class="easyui-combobox" name="store_destination_id"
                                   url="<?php echo site_url('master/Store/get') ?>"
                                   method="post" valueField="id" textField="name"
                                   style="width: 100%" required="true" mode="remote" panelHeight="auto"
                                   data-options="onSelect: function(row){
				            $('#po_store_id').textbox('setValue', row.address);
				        }"/>

            </td>
        </tr>
        <tr>
            <td width="40%"><strong>Currency</strong></td>
            <td width="60%"><select id="cc" class="easyui-combobox" name="currency" style="width:200px;">
                            <option value="IDR" selected>IDR</option>
                            <option value="USD" >USD</option>
                            </select>
            </td>
        </tr>
        <tr>
            <td><strong>Supplier</strong></td>
            <td><input class="easyui-combobox" name="vendor_id"
                       url="<?php echo site_url('master/Supplier/get') ?>"
                       method="post" valueField="id" textField="name"
                       data-options="formatter: namaSupplier"
                       style="width: 100%" mode="remote" required="true" panelHeight="200"/>
                <script type="text/javascript">
                    function namaSupplier(row) {
                        return '<span style="font-weight:bold;">' + row.code + '</span><br/>' +
                                '<span style="color:#888">Desc: ' + row.name + '</span>';
                    }</script>
            </td>
        </tr>
        <tr>
            <td><strong>Tanggal Pengiriman</strong></td>
            <td><input type="text" name='shipment_date' data-options="formatter:myformatter,parser:myparser"
                       class="easyui-datebox" style="width: 50%" /></td>
        </tr>
        <tr>
            <td><strong>Alamat Pengiriman</strong></td>
            <td><input type="text" id="po_store_id" name='shipment_address'
                       class="easyui-textbox" data-options="multiline:true"style="width: 100%;height:100px"
				readonly="readonly"
				style="width: 50%" required="true" mode="remote" panelHeight="auto"/>
				<script type="text/javascript">
//                     function unitformat(row) {
//                         return '<span style="color:#888">Desc: ' + row.address + '</span>';
//                     }
                </script></td>
        </tr>
    </table>
</form>