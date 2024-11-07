<div id="stock_transfer_manifest_item_toolbar">
 <form id="stock_transfer_manifest_item_form_search"
  onsubmit="return false">
  Sku : <input type="text" size="12" name="sku"
   class="easyui-validatebox"
   onkeypress="if (event.keyCode == 13) {
                    stock_transfer_manifest_item_search()
                }" /> Barcode : <input type="text" size="12"
   name="barcode" class="easyui-validatebox"
   onkeypress="if (event.keyCode == 13) {
                    stock_transfer_manifest_item_search()
                }" /> <a href="javascript:void(0)"
   class="easyui-linkbutton" iconCls="icon-search" plain="true"
   onclick="stock_transfer_manifest_item_search()">Find</a> <a
   href="javascript:void(0)" class="easyui-linkbutton"
   iconCls="icon-add" plain="true" id="ts_item_add"
   onclick="stock_transfer_manifest_item_add()">Add</a> <a
   href="javascript:void(0)" class="easyui-linkbutton"
   iconCls="icon-add" plain="true" id="ts_item_add_barcode"
   onclick="stock_transfer_manifest_item_add_barcode()">Add (Barcode)</a>
  <a href="javascript:void(0)" id="ts_item_edit"
   class="easyui-linkbutton" iconCls="icon-edit" plain="true"
   onclick="stock_transfer_manifest_item_edit()">Edit</a> <a
   href="javascript:void(0)" class="easyui-linkbutton"
   iconCls="icon-remove" plain="true" id="ts_item_delete"
   onclick="stock_transfer_manifest_item_delete()">Delete</a>
 </form>
</div>
<table id="stock_transfer_manifest_item"
 data-options="
       url:'<?php echo site_url('/order_management/Stock_transfer_manifest/get_stock_transfer_manifest_items_with_pagination') ?>',
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
       toolbar:'#stock_transfer_manifest_item_toolbar'">
 <thead>
  <tr>
   <th field="sku" width="100" halign="center">SKU</th>
   <th field="barcode" width="120" halign="center">Barcode</th>
   <th field="item_name" width="250" halign="center">Item Name</th>
   <th field="quantity" width="80" halign="center" align="right">Quantity</th>
  </tr>
 </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#stock_transfer_manifest_item').datagrid({});
    });

    function stock_transfer_manifest_item_search() {
        $('#stock_transfer_manifest_item').datagrid('reload', $('#stock_transfer_manifest_item_form_search').serializeObject());
    }

    function stock_transfer_manifest_item_form(type, title, row) {
        if ($('#stock_transfer_manifest_item_dialog')) {
            $('#bodydata').append("<div id='stock_transfer_manifest_item_dialog'></div>");
        }
        $('#stock_transfer_manifest_item_dialog').dialog({
            title: title,
            width: 400,
            height: 'auto',
            href: base_url + '/order_management/Stock_transfer_manifest/item_form_view',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: (type === 'edit') ? 'Update' : 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        stock_transfer_manifest_item_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#stock_transfer_manifest_item_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                if (type === 'edit' || type === 'add') {
                    $('#stock_transfer_manifest_item_form').form('load', row);
                } else {
                    $('#stock_transfer_manifest_item_form').form('clear');
                }

            }
        });
    }

    function stock_transfer_manifest_item_form_barcode(type, title, row) {
        if ($('#stock_transfer_manifest_item_dialog_barcode')) {
            $('#bodydata').append("<div id='stock_transfer_manifest_item_dialog_barcode'></div>");
        }
        $('#stock_transfer_manifest_item_dialog_barcode').dialog({
            title: title,
            width: 420,
            height: 'auto',
            href: base_url + '/order_management/Stock_transfer_manifest/item_form_view_barcode',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: (type === 'edit') ? 'Update' : 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                    	stock_transfer_manifest_item_save_barcode();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#stock_transfer_manifest_item_dialog_barcode').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                if (type === 'edit' || type === 'add') {
                    $('#stock_transfer_manifest_item_form_barcode').form('load', row);
                } else {
                    $('#stock_transfer_manifest_item_form_barcode').form('clear');
                }

            }
        });
    }

    function stock_transfer_manifest_item_add() {
        var row = $('#stock_transfer_manifest').datagrid('getSelected');
        if (row !== null) {
	        var data = {stock_transfer_manifest_id: row.id};
	        stock_transfer_manifest_item_form('add', 'Add Stock Transfer Manifest Item', data);
	        stock_transfer_manifest_item_url = base_url + '/order_management/Stock_transfer_manifest/add_stock_transfer_manifest_item';
        }else {
            $.messager.alert('Warning', 'Please select 1 row of STM to proceed', 'warning');
        }
    }

    function stock_transfer_manifest_item_add_barcode() {
        var row = $('#stock_transfer_manifest').datagrid('getSelected');
        if (row !== null) {
	        var data = {stock_transfer_manifest_id: row.id};
	        stock_transfer_manifest_item_form_barcode('add', 'Add Stock Transfer Manifest Item', data);
	        stock_transfer_manifest_item_barcode_url = base_url + '/order_management/Stock_transfer_manifest/add_stock_transfer_manifest_item';
        }else {
            $.messager.alert('Warning', 'Please select 1 row of STM to proceed', 'warning');
        }
    }

    function stock_transfer_manifest_item_edit() {
        var row = $('#stock_transfer_manifest_item').datagrid('getSelected');
        if (row !== null) {
            stock_transfer_manifest_item_form('edit', 'Edit Stock Transfer Manifest', row);
            stock_transfer_manifest_item_url = base_url + '/order_management/Stock_transfer_manifest/update_stock_transfer_manifest_item';
        } else {
            $.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
        }
    }

    function stock_transfer_manifest_item_delete() {
        var row = $('#stock_transfer_manifest_item').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/Stock_transfer_manifest/delete_stock_transfer_manifest_item', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#stock_transfer_manifest_item').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('Warning', 'Please select at least 1 row to proceed', 'warning');
        }
    }
</script>
