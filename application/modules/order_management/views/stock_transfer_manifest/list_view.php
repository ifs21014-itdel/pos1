<div id="stock_transfer_manifest_toolbar">
    <form id="stock_transfer_manifest_form_search" onsubmit="return false">
        No Transfer Stock : 
        <input type="text" size="12" name="code" class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                }" /> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="stock_transfer_manifest_search()">Find</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="stock_transfer_manifest_add()">Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-arrow-up" plain="true" id="stock_transfer_manifest_confirm" onclick="stock_transfer_manifest_confirm()">Confirm TS</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" id="stock_transfer_manifest_print" onclick="stock_transfer_manifest_print()">Print</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" id="stock_transfer_manifest_syncronize" onclick="syncronize_stock_transfer_manifest_upload()">Synchronize [Upload]</a>
    </form>
</div>
<table id="stock_transfer_manifest"
       data-options="
       url:'<?php echo site_url('/order_management/Stock_transfer_manifest/get_stock_transfer_manifests_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List Transfer Stock',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#stock_transfer_manifest_toolbar'">
    <thead>
        <tr>
            <th field="id" width="90" halign="center" hidden="false"></th>
            <th field="status" width="90" hidden="true"></th>
            <th field="code" width="120" halign="center" >NO Transfer Stock</th>
            <th field="status_info" width="90" halign="center" align="center">Status</th>
            <th field="is_synchronized_status" width="120"> Synchronize Status </th>
            <th field="store_source_name" width="150" halign="center" >Store Source</th>
            <th field="ship_date" width="150" halign="center" align="center">Tanggal Pengiriman</th>
            <th field="delivered_by" width="100" halign="center" >Delivered By</th>
            <th field="store_destination_name" width="150" halign="center" >Store Destination</th>
            <th field="received_date" width="150" halign="center" >Received Date</th>
            <th field="received_by" width="100" halign="center" align="center">Received By</th>
            <th field="address" width="200" halign="center" >Address</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#stock_transfer_manifest').datagrid({
            rowStyler: function (index, row) {
                if (row.status === '1' || row.is_synchronized_status === 'NOT SYNC') {
                    return 'background-color:#FFA1A1;color:#000;';
                } else {
                    return 'background-color:#fff;color:#000;';
                }
            },
            onSelect: function (index, row) {
                $('#stock_transfer_manifest_item').datagrid('reload', {
                    stock_transfer_manifest_id: row.id
                });
                if (row.status === '2' || row.status === '3') {//New PO
                    $('#ts_item_add').linkbutton('disable');
                    $('#ts_item_add_barcode').linkbutton('disable');
                    $('#ts_item_edit').linkbutton('disable');
                    $('#ts_item_delete').linkbutton('disable');
                    $('#stock_transfer_manifest_print').linkbutton('enable');
                    $('#stock_transfer_manifest_confirm').linkbutton('disable');
                } else {
                    $('#ts_item_add').linkbutton('enable');
                    $('#ts_item_add_barcode').linkbutton('enable');
                    $('#ts_item_edit').linkbutton('enable');
                    $('#ts_item_delete').linkbutton('enable');
                    $('#stock_transfer_manifest_print').linkbutton('disable');
                    $('#stock_transfer_manifest_confirm').linkbutton('enable');
                }

                if (row.status === '1' || row.is_synchronized_status === 'SYNCRONIZE') {
                    $('#stock_transfer_manifest_syncronize').linkbutton('disable');
                } else {
                    $('#stock_transfer_manifest_syncronize').linkbutton('enable');
                }
            },
        });
    });
    function stock_transfer_manifest_search() {
        $('#stock_transfer_manifest').datagrid('reload', $('#stock_transfer_manifest_form_search').serializeObject());
    }

    function stock_transfer_manifest_input_form(type, title, row) {
        if ($('#stock_transfer_manifest_dialog')) {
            $('#bodydata').append("<div id='stock_transfer_manifest_dialog'></div>");
        }
        $('#stock_transfer_manifest_dialog').dialog({
            title: title,
            width: 400,
            height: 'auto',
            href: base_url + '/order_management/Stock_transfer_manifest/form_view',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: (type === 'edit') ? 'Update' : 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        stock_transfer_manifest_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#stock_transfer_manifest_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                if (type === 'edit') {
                    $('#stock_transfer_manifest_input_form').form('load', row);
                } else {
                    $('#stock_transfer_manifest_input_form').form('clear');
                }

            }
        });
    }

    function stock_transfer_manifest_add() {
        stock_transfer_manifest_input_form('add', 'Add Stock Transfer Manifest', null);
        stock_transfer_manifest_url = base_url + '/order_management/Stock_transfer_manifest/add_stock_transfer_manifest';
    }

    function stock_transfer_manifest_edit() {
        var row = $('#stock_transfer_manifest').datagrid('getSelected');
        if (row !== null) {
            stock_transfer_manifest_input_form('edit', 'Edit Stock Transfer Manifest', row);
            stock_transfer_manifest_url = base_url + '/order_management/Stock_transfer_manifest/update_stock_transfer_manifest';
        } else {
            $.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
        }
    }

    function stock_transfer_manifest_delete() {
        var row = $('#stock_transfer_manifest').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/Stock_transfer_manifest/delete_stock_transfer_manifest', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#stock_transfer_manifest').datagrid('reload');
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

    function stock_transfer_manifest_confirm() {
        var rows = $('#stock_transfer_manifest_item').datagrid('getData');
        if (rows.total > 0) {
            var row = $('#stock_transfer_manifest').datagrid('getSelected');
            $.messager.confirm('Confirm', 'Are you sure to Confirm Stock Transfer Manifest?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/Stock_transfer_manifest/confirm_stock_transfer_manifest', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#stock_transfer_manifest').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('No Item to conform', 'Please input item to conform', 'warning');
        }
    }

    function syncronize_stock_transfer_manifest_upload() {
        var row = $('#stock_transfer_manifest').datagrid('getSelected');
        $.messager.confirm('Confirm', 'Are you sure to Synchronize Stock Transfer Manifest?', function (r) {
            if (r) {
                $.post(base_url + '/synchronize/Store_factory/stock_transfer_manifest_upload', {
                    stock_transfer_manifest_id: row.id
                }, function (result) {
                    console.log(result.success);
                    if (result.success) {
                        $.messager.alert('Success', 'Sync/Upload Berhasil');
                        $('#stock_transfer_manifest').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    }

</script>
