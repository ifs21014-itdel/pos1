<div class="easyui-layout" fit="true" style="height: 400px">
    <div region="north" style="height: 60px">
        <form id="transfer_stock_create_form" method="post" novalidate class="table_form">
            <table width="50%" border="0">
                <tr>
                    <td width="30%"><strong>Store Destination</strong></td>
                    <td width="70%">
                        <input type="hidden" name="transfer_stock_request_id" value="<?php echo $tsrid ?>"/>
                        <input class="easyui-combobox" id="store_destination_id_67" name="store_destination_id" url="<?php echo site_url('/master/Store/get_store_exclude_self') ?>"
                               method="post" valueField="id" textField="name" style="width: 100%" required="true" mode="remote" panelHeight="auto" readonly=""/>
                    </td>
                </tr>
                <tr>
                    <td><strong>Ship Date</strong></td>
                    <td>
                        <input type="text" name='ship_date' data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" required="true" style="width: 50%" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div region="center" border="false">
        <table id="transfer_stock_create_detail"
               data-options="
               url:'<?php echo site_url('/order_management/transfer_stock_request/detail_get/' . $tsrid) ?>',
               method:'post',
               border:true,       
               title:'List Item',
               singleSelect:false,
               selectOnCheck:true,
               checkOnSelect:false,
               fit:true,
               rownumbers:true,
               fitColumns:false,
               pagination:false">
            <thead>
                <tr>
                    <th field="tscd_chck" checkbox="true"></th>
                    <th field="sku" width="15%" halign="center">Item Code</th>
                    <th field="item_name" width="35%" halign="center" halign="center">Item Name</th>
                    <th field="uom" width="10%" align="center" align="right">UoM</th>
                    <th field="quantity" width="15%" halign="center" align="right">Quantity</th>
                    <th field="outstanding" width="15%" halign="center" align="right" data-options="editor:{type:'numberbox'}">Transfer Qty</th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(function () {
                $('#transfer_stock_create_detail').datagrid({
                    onCheck: function (index, row) {
                        $('#transfer_stock_create_detail').datagrid('beginEdit', index);
                    },
                    onUncheck: function (index, row) {
                        $('#transfer_stock_create_detail').datagrid('cancelEdit', index);
                    },
                    onCheckAll: function (rows) {
                        for (var i = 0; i < rows.length; i++) {
                            $('#transfer_stock_create_detail').datagrid('beginEdit', i);
                        }
                    },
                    onUncheckAll: function (rows) {
                        for (var i = 0; i < rows.length; i++) {
                            $('#transfer_stock_create_detail').datagrid('cancelEdit', i);
                        }
                    }
                });
            });
        </script>
    </div>
</div>
