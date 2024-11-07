<div id="gr_detail_toolbar">
    <form id="item_gr_form_search" onsubmit="return false">

        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="gr_detail_add()">Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="gr_detail_edit()">Edit</a>
    </form>
</div>
<table id="gr_detail"
       data-options="
       url:'<?php echo site_url('/order_management/Good_receive/detail_get') ?>',
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
       toolbar:'#gr_detail_toolbar'">
    <thead>
        <tr>
            <th field="id" width="90" halign="center" hidden="true"></th>
            <th field="reference" width="90" halign="center">P.O No.</th>
            <th field="sku" width="90" halign="center">SKU</th>
            <th field="item_code" width="90" halign="center">Barcode</th>
            <th field="item_name" width="250" halign="center">Nama Barang</th>
            <th field="unit_code" width="90" halign="center" align="center">Satuan</th>
            <th field="order_qty" width="80" halign="center" align="right">Jumlah Order</th>
            <th field="quantity" width="80" halign="center" align="right">Jumlah Diterima</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#gr_detail').datagrid({});
    });
</script>
