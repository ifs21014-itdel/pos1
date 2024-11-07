<div id="detail_rtv_toolbar">
    <form id="item_rtv_form_search" onsubmit="return false">
        Search : <input type="text" size="12" name="search_item" class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {rtv_item_search()}" />
         <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" id="rtv_item_search" plain="true" onclick="rtv_item_search()">Find</a> 
         <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" id="rtv_item_add" plain="true" onclick="rtv_item_add()">Add</a> 
         <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" id="rtv_item_edit" plain="true" onclick="rtv_item_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id="rtv_item_delete" plain="true" onclick="rtv_item_delete()">Delete</a>
    </form>
</div>
<table id="detail_rtv"
       data-options="
       url:'<?php echo site_url('/order_management/return_to_vendor/get_rtv_items_with_pagination') ?>',
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
       toolbar:'#detail_rtv_toolbar'">
    <thead>
        <tr>
            <th field="id" width="90" halign="center" hidden="true"></th>
            <th field="sku" width="90" halign="center" align="center">SKU</th>
            <th field="item_code" width="120" halign="center" align="center">Barcode</th>
            <th field="item_name" width="250" halign="center" align="center">Nama Barang</th>
            <th field="unit_code" width="90" halign="center" align="center">Satuan</th>
            <th field="quantity" width="100" halign="center" align="right">Jumlah</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
//Detail item Return to Vendor
$(function () {
        $('#detail_rtv').datagrid({});
    });

    function item_rtv_form_search() {
        $('#detail_rtv').datagrid('reload', $('#item_rtv_form_search').serializeObject());
    }

    function rtv_item_form(type, title, row) {
        if ($('#rtv_item_dialog')) {
            $('#bodydata').append("<div id='rtv_item_dialog'></div>");
        }
        $('#rtv_item_dialog').dialog({
            title: title,
            width: 400,
            height: 'auto',
            href: base_url + '/order_management/return_to_vendor/item_form_view',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: (type === 'edit') ? 'Update' : 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        rtv_item_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#rtv_item_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                if (type === 'edit' || type === 'add') {
                    $('#rtv_item_form').form('load', row);
                } else {
                    $('#rtv_item_form').form('clear');
                }

            }
        });
    }

    function rtv_item_add() {
        var row = $('#rtv').datagrid('getSelected');
        if (row !== null) {
        	var data = {returned_to_vendor_id: row.id};
	        rtv_item_form('add', 'Add Return to Vendor Item', data);
	        rtv_item_url = base_url + '/order_management/return_to_vendor/add_rtv_item';
        } else {
            $.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
        }
    }

    function rtv_item_edit() {
        var row = $('#detail_rtv').datagrid('getSelected');
        if (row !== null) {
        	rtv_item_form('edit', 'Edit Item Return to Vendor', row);
        	rtv_item_url = base_url + '/order_management/return_to_vendor/update_rtv_item';
        } else {
            $.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
        }
    }

    function rtv_item_delete() {
        var row = $('#detail_rtv').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/return_to_vendor/delete_rtv_item', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#detail_rtv').datagrid('reload');
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
