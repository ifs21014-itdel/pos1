<div id="broken_stock_toolbar">
    <form id="broken_stock_form_search" onsubmit="return false">
        Search : <input type="text" size="12" name="search" class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                            broken_stock_search()
                        }" /> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="broken_stock_search()">Find</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="broken_stock_add()">Add</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" id="broken_stock_edit" plain="true" onclick="broken_stock_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id="broken_stock_delete" plain="true" onclick="broken_stock_delete()">Delete</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" id="broken_stock_print" plain="true" onclick="broken_stock_print()">Print</a>
    </form>
</div>
<table id="broken_stock"
       data-options="
       url:'<?php echo site_url('order_management/broken_stock/get_broken_stock_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List Broken Item ',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#broken_stock_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="sku" width="100" halign="center" align="center">SKU</th>
            <th field="item_code" width="150" halign="center" align="center">Barcode</th>
            <th field="item_name" width="250" halign="center" >Nama Barang</th>
            <th field="unit_code" width="100" halign="center" align="center">Satuan</th>
            <th field="quantity" width="100" halign="center" align="right">Jumlah Barang</th>
            <th field="description" width="200" halign="center">Description</th>
            <th field="createdate" width="200" halign="center">Date</th>
    </thead>
</table>
<script type="text/javascript">
    var broken_stock_url = '';

    $(function () {
        $('#broken_stock').datagrid({
            onCheck: function (index, row) {
            },
            onSelect: function (value, row, index) {
                $today = '<?php echo date("Y-m-d") ?>';
                console.log(row.createdate);
                if (row.createdate !== $today) {
                    $('#broken_stock_edit').linkbutton('disable');
                    $('#broken_stock_delete').linkbutton('disable');
                } else {
                    $('#broken_stock_edit').linkbutton('enable');
                    $('#broken_stock_delete').linkbutton('enable');
                }
            },
        });
    });

    function broken_stock_search() {
        $('#broken_stock').datagrid('reload', $('#broken_stock_form_search').serializeObject());
    }

    function broken_stock_input_form(type, title, row) {
        if ($('#broken_stock_dialog')) {
            $('#bodydata').append("<div id='broken_stock_dialog'></div>");
        }
        $('#broken_stock_dialog').dialog({
            title: title,
            width: 500,
            height: 'auto',
            href: base_url + '/order_management/broken_stock/input_form',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: (type === 'edit') ? 'Update' : 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        broken_stock_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#broken_stock_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                if (type === 'edit') {
                    $('#broken_stock_input_form').form('load', row);
                } else {
                    $('#broken_stock_input_form').form('clear');
                }

            }
        });
    }

    function broken_stock_add() {
        broken_stock_input_form('add', 'ADD Item to Broken Stock', null);
        broken_stock_url = base_url + '/order_management/broken_stock/add_broken_stock';
    }

    function broken_stock_edit() {
        var row = $('#broken_stock').datagrid('getSelected');
        if (row !== null) {
            broken_stock_input_form('edit', 'Edit Item to Broken Stock', row);
            broken_stock_url = base_url + '/order_management/broken_stock/update_broken_stock';
        } else {
            $.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
        }
    }

    function broken_stock_delete() {
        var row = $('#broken_stock').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/broken_stock/delete_broken_stock', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#broken_stock').datagrid('reload');
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

    function broken_stock_print() {
        var row = $('#broken_stock').datagrid('getSelected');

        if ($('#broken_stock_dialog')) {
            $('#bodydata').append("<div id='broken_stock_dialog'></div>");
        }

        $('#broken_stock_dialog').dialog({
            title: 'PRINT',
            width: 300,
            height: 'auto',
            href: base_url + '/order_management/broken_stock/print_form',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: 'Print',
                    iconCls: 'icon-print',
                    handler: function () {
                        if ($('#print_input_form').form('validate')) {
                            var start_date = $('#print_input_form input[name="start-date"]').val();
                            popupCenter(base_url + '/order_management/broken_stock/prints/' + start_date , 'PRINT', 800, 600);
                        }
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#broken_stock_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
            }
        });
    }

</script>
