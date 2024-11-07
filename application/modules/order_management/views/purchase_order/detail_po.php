<div id="detail_po_toolbar">
    <form id="item_po_form_search" onsubmit="return false">
        Search : <input type="text" size="12" name="code_or_name"
                        class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                                }" /> <a
                        href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-search" plain="true" onclick="po_item_search()">Find</a> <a
                        href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-add" id="po_item_add" plain="true" onclick="po_item_add()">Add</a> <a
                        href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-edit" id="po_item_edit" plain="true" onclick="po_item_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-remove" id="po_item_delete" plain="true" onclick="po_item_delete()">Delete</a>
    </form>
</div>
<table id="detail_po"
       data-options="
       url:'<?php echo site_url('/order_management/Purchase_order/item_get') ?>',
       method:'post',
       border:true,       
       title:'List Item',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#detail_po_toolbar'">
    <thead>

        <tr>
            <th field="id" width="90" halign="center" hidden="true"></th>
            <th field="sku" width="90" halign="center">SKU</th>
            <th field="item_code" width="90" halign="center">Barcode</th>
            <th field="item_name" width="250" halign="center" align="left">Nama Barang</th>
            <th field="unit_code" width="90" halign="center" align="center">Satuan</th>
            <th field="quantity" width="150" halign="center" align="right">Jumlah</th>
            <th field="unit_conversion" width="90" halign="center" align="right">Unit Conversion</th>
            <th field="total_qty" width="100" halign="center" align="right">Jumlah Total</th>
            <th field="price" width="90" halign="center" align="right" formatter="formatPrice">Harga Satuan</th>
            <th field="total_price" width="100" halign="center" align="right" formatter="formatPrice">Total</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#detail_po').datagrid({
//             view: detailview,
            onCheck: function (index, row) {
            },
            onSelect: function (index, row) {
            },
            onUnselect: function (index, row) {
            },
            onSelectAll: function (row) {
            },
            onUnselectAll: function (row) {
            },
            detailFormatter: function (rowIndex, rowData) {
                return '<table><tr>' +
                        '<td style="vertical-align: text-top; padding: 10px;">Remark <span style="font-style: italic;font-size: 10px;">(*optional)</span></td><td style="border:0">' +
                        '<textarea data-id="' + rowData.sku + '" data-name="approval-remark" rows="2" cols="80" name="remark[]"></textarea>' +
                        '</td>' +
                        '</tr></table>';
            }

        });
    });
</script>
