<div id="transfer_stock_request_detail_toolbar">
    <form id="transfer_stock_request_detail_form_search" onsubmit="return false">
        Search : <input type="text" size="12" name="q"
                        class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                                    transfer_stock_request_detail_search();
                                }" /> <a
                        href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-search" plain="true" onclick="transfer_stock_request_detail_search()">Find</a> <a
                        href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-add" plain="true" onclick="transfer_stock_request_detail_add()">Add</a> <a
                        href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-edit" plain="true" onclick="transfer_stock_request_detail_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-remove" plain="true" onclick="transfer_stock_request_detail_delete()">Delete</a>
    </form>
</div>
<table id="transfer_stock_request_detail"
       data-options="
       url:'<?php echo site_url('/order_management/transfer_stock_request/detail_get') ?>',
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
       toolbar:'#transfer_stock_request_detail_toolbar'">
    <thead>

        <tr>
            <th field="id" width="90" halign="center" hidden="true"></th>
            <th field="sku" width="90" halign="center">Item Code</th>
            <th field="item_name" width="250" halign="center" halign="center">Item Name</th>
            <th field="uom" width="50" align="center" align="right">UoM</th>
            <th field="available" width="150" halign="center" align="right">Available</th>
            <th field="quantity" width="150" halign="center" align="right">Qty Request</th>
            <th field="outstanding" width="150" halign="center" align="right">Ots Outstanding Receive</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#transfer_stock_request_detail').datagrid({
        });
    });
</script>
