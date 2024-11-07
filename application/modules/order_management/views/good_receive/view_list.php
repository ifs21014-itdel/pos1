<div id="gr_toolbar">
    <form id="gr_form_search" onsubmit="return false">
        Search <input type="text" size="15" name="q"
                      class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                              }" />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="gr_search()">Find</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="gr_add()">Add</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="gr_print()">Print</a> 
    </form>
</div>
<table id="gr"
       data-options="
       url:'<?php echo site_url('order_management/Good_receive/get') ?>',
       method:'post',
       border:true,       
       title:'Goods Receive',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       idField:'id',
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#gr_toolbar'">
    <thead data-options="frozen:true">
        <tr>
            <th field="id" hidden="true"></th>
            <th field="reference" width="100" halign="center">Nomor GR</th>
        </tr>
    </thead>
    <thead>
        <tr>
        	<th field="no_sj" width="150" halign="center">No.Surat Jalan</th> 
            <th field="received_date" width="130" halign="center"formatter='myFormatDate'>Tanggal Terima</th>
            <th field="vendor_name" width="300" halign="center">Vendor</th> <!--
            <th field="nama_toko" width="130" halign="center" align="center">Toko</th>-->
            <th field="remark" width="200" halign="center">Keterangan</th> 
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#gr').datagrid({
            onSelect: function (value, row, index) {
                $('#gr_detail').datagrid('reload', {
                    good_receive_id: row.id
                });
            }

        });
    });
    var gr_url = '';
    function gr_search() {
        $('#gr').datagrid('reload', $('#gr_form_search').serializeObject());
    }

    function gr_print() {
        var row = $('#gr').datagrid('getSelected');
        if (row !== null) {
            popupCenter(base_url + '/order_management/Good_receive/prints/' + row.id, 'PRINT GR', 800, 600);
        }
        else {
            $.messager.alert('Good Receive not Selected', 'Please select gr to print', 'warning');
        }
    }

    function gr_add() {
        $('#global_dialog').dialog({
            title: 'New Goods Receive',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + '/order_management/Good_receive/input',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#goodreceive_input_form').form('submit', {
                            url: base_url + '/order_management/Good_receive/insert',
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                console.log(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#gr').datagrid('reload');
                                } else {
                                    $.messager.alert('Error', result.msg, 'error');
                                }
                            }
                        });
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
            }
        });
    }

    function gr_detail_add() {

        var row = $('#gr').datagrid('getSelected');
        if (row !== null) {
            $('#global_dialog').dialog({
                title: 'New Goods Receive',
                width: 700,
                height: 500,
                closed: false,
                cache: true,
                href: base_url + '/order_management/Good_receive/detail_input/' + row.vendor_id,
                modal: true,
                resizable: true,
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            if (index_e !== null) {
                                $('#gr_detail_dialog').datagrid('endEdit', index_e);
                                $('#gr_detail_dialog').datagrid('checkRow', index_e);
                                index_e = null;
                            }

                            $('#gr_detail_dialog').datagrid('acceptChanges');
                            var rows = $('#gr_detail_dialog').datagrid('getChecked');

                            if (rows.length !== 0) {
                                var arr_po_detail_id = new Array();
                                var arr_item_id = new Array();
                                var arr_uom_id = new Array();
                                var arr_unit_conversion = new Array();
                                var arr_qty_receive = new Array();

                                for (var i = 0; i < rows.length; i++) {
                                    if (rows[i].qty_receive !== "") {
                                        arr_po_detail_id.push(rows[i].id);
                                        arr_item_id.push(rows[i].item_id);
                                        arr_uom_id.push(rows[i].uom_id);
                                        arr_unit_conversion.push(rows[i].unit_conversion);
                                        arr_qty_receive.push(rows[i].qty_receive);
                                    }
                                }
                                if (arr_po_detail_id.length > 0) {
                                    $.post(base_url + '/order_management/Good_receive/detail_save', {
                                        good_received_id: row.id,
                                        po_detail_id: arr_po_detail_id,
                                        item_id: arr_item_id,
                                        uom_id: arr_uom_id,
                                        unit_conversion: arr_unit_conversion,
                                        qty_receive: arr_qty_receive
                                    }, function (content) {
                                        var result = eval('(' + content + ')');
                                        if (result.success) {
                                            $('#global_dialog').dialog('close');
                                            $('#gr_detail').datagrid('reload');
                                        } else {
                                            $.messager.alert('Error', result.msg, 'error');
                                        }
                                    });
                                } else {
                                    $.messager.alert('Warning', 'Nothing to save', 'warning');
                                }
                            } else {
                                $.messager.alert('Warning', 'Nothing to save', 'warning');
                            }
                        }
                    }, {
                        text: 'Close',
                        iconCls: 'icon-remove',
                        handler: function () {
                            $('#global_dialog').dialog('close');
                        }
                    }],
                onLoad: function () {
                    $(this).dialog('center');
                }
            });
        } else {
            $.messager.alert('No Goods Receive Selected', 'Please Goods Receive', 'warning');
        }
    }

    function gr_detail_edit() {
        var row = $('#gr_detail').datagrid('getSelected');
        if (row !== null) {
            $('#global_dialog').dialog({
                title: 'Edit Item',
                width: 400,
                height: 'auto',
                closed: false,
                cache: true,
                href: base_url + '/order_management/Good_receive/detail_edit',
                modal: true,
                resizable: true,
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {

                        }
                    }, {
                        text: 'Close',
                        iconCls: 'icon-remove',
                        handler: function () {
                            $('#global_dialog').dialog('close');
                        }
                    }],
                onLoad: function () {
                    $(this).dialog('center');
                    $('#good_receive_detail_edit_form').form('load', row);
                }
            });
        } else {
            $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
        }
    }

    // Detail item gr
    function gr_item_search() {
        $('#detail_gr').datagrid('reload', $('#item_gr_form_search').serializeObject());
    }

    function gr_terima() {
        var row = $('#detail_gr').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Data sudah diterima', function (r) {
                if (r) {
                    $.grst(base_url + '/master/good_receive/gr_terima', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#detail_gr').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
//            $.messager.alert('Item was not Selected', 'Select Item', 'warning');
        }
    }
        
</script>
