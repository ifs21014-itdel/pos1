<div id="po_toolbar">
    <form id="po_form_search" onsubmit="return false">
        Purchase Order ID <input type="text" size="15" name="number"
                                 class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                                }" />
        <a
            href="javascript:void(0)" class="easyui-linkbutton"
            iconCls="icon-search" plain="true" onclick="po_search()">Find</a> <a
            href="javascript:void(0)" class="easyui-linkbutton"
            iconCls="icon-add" plain="true" onclick="po_add()">Add</a>
        <a
            href="javascript:void(0)" class="easyui-linkbutton"
            iconCls="icon-edit" id="po_edit" plain="true" onclick="po_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-remove" id="po_delete" plain="true" onclick="po_delete()">Delete</a> 
<!--         <a -->
<!--             href="javascript:void(0)" class="easyui-linkbutton" -->
<!--             iconCls="icon-preview" id="po_open" plain="true" onclick="po_open()">Open</a> -->
<!--         <a -->
<!--             href="javascript:void(0)" class="easyui-linkbutton" -->
<!--              iconCls="icon-requisition" id="po_close" plain="true" onclick="po_close()">Close</a>-->
        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-complete" id="po_release" plain="true" onclick="po_release()">Release</a> 
<!--        <a
            href="javascript:void(0)" class="easyui-linkbutton"
            iconCls="icon-receive" id="po_finish" plain="true" onclick="po_finish()">Finish</a> -->
        <a
            href="javascript:void(0)" class="easyui-linkbutton"
            iconCls="icon-print" id="po_print" plain="true" onclick="po_print()">Print</a> 
    </form>
</div>
<table id="po"
       data-options="
       url:'<?php echo site_url('order_management/Purchase_order/get') ?>',
       method:'post',
       border:true,       
       title:'List PO',
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
       toolbar:'#po_toolbar'">
    <thead data-options="frozen:true">
        <tr>
            <th field="id" hidden="true"></th>
            <th field="reference" width="100" halign="center">Nomor PO</th>
        </tr>
    </thead>
    <thead>
        <tr>
        	<th field="status" width="100" halign="center" align="center">Status</th>
            <th field="created_date" width="130" halign="center" align="center" formatter="myFormatDate">Tanggal PO</th>
            <th field="nama_supplier" width="200" halign="center" >Supplier</th>
            <th field="shipment_date" width="130" halign="center" align="center" formatter="myFormatDate">Tanggal Pengiriman</th>
            <th field="nama_toko" width="170" halign="center" >Toko</th>
            <th field="shipment_address" width="500" halign="center">Alamat Pengiriman</th>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#po').datagrid({
//             view: detailview,
            onClick: function (index, row) {
            },
            onSelect: function (value, row, index) {
                $('#detail_po').datagrid('reload', {
                    id: row.id
                });
                if (row.status === 'DRAFT' || row.status === 'OPEN') {//New PO
                	$('#po_item_add').linkbutton('enable');
                	$('#po_item_edit').linkbutton('enable');
                	$('#po_item_delete').linkbutton('enable');
                	$('#po_edit').linkbutton('enable');
                 	$('#po_delete').linkbutton('enable');
                	$('#po_print').linkbutton('disable');
                    if(row.status === 'DRAFT'){
                        $('#po_open').linkbutton('enable');
                        $('#po_close').linkbutton('enable');
                        $('#po_release').linkbutton('enable');
                        $('#po_finish').linkbutton('enable');
                    }if(row.status === 'OPEN'){
                        $('#po_open').linkbutton('disable');
                        $('#po_close').linkbutton('enable');
                        $('#po_release').linkbutton('enable');
                        $('#po_finish').linkbutton('enable');
                    }   
                 }if(row.status === 'CLOSE' || row.status === 'RELEASE' || row.status === 'FINISHED'){
                	$('#po_item_add').linkbutton('disable');
                 	$('#po_item_edit').linkbutton('disable');
                 	$('#po_item_delete').linkbutton('disable');
                 	$('#po_edit').linkbutton('disable');
                 	$('#po_delete').linkbutton('disable');
                 	$('#po_print').linkbutton('enable');
                 	if(row.status === 'CLOSE'){
                        $('#po_open').linkbutton('enable');
                        $('#po_close').linkbutton('disable');
                        $('#po_release').linkbutton('enable');
                        $('#po_finish').linkbutton('enable');
                    }if(row.status === 'RELEASE'){
                        $('#po_open').linkbutton('enable');
                        $('#po_close').linkbutton('enable');
                        $('#po_release').linkbutton('disable');
                        $('#po_finish').linkbutton('enable');
                    }if(row.status === 'FINISHED'){
                        $('#po_open').linkbutton('enable');
                        $('#po_close').linkbutton('enable');
                        $('#po_release').linkbutton('enable');
                        $('#po_finish').linkbutton('disable');
                    }    
                 }
//                     $('#po_close').linkbutton('disable');                    
//                 }else if (row.status === '1') {// PO Open
//                     $('#po_close').linkbutton('enable');
//                     $('#po_open').linkbutton('disable');
//                 } 
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
            }, 
            rowStyler: function(index,row){
//         		if (row.status === 'Open'){
//         			return 'background-color:#A6EB8F;color:#000;';	
//         		} if(row.status == 'Close'){
//         			return 'background-color:#B7B4A1;color:#000;';
//                 }if (row.status === 'Release'){
//         			return 'background-color:#FFF28A;color:#000;';	
//         		} 
        		if(row.status == 'DRAFT'){
        			return 'background-color:#FFA1A1;color:#000;';
                }
//                 else {
//                 	return 'background-color:#fff;color:#000;';
//                 }
        	},

        });
    });
    var po_url = '';
    function po_search() {
        $('#po').datagrid('reload', $('#po_form_search').serializeObject());
    }

    function po_input_form(type, title, row) {
        if ($('#po_dialog')) {
            $('#bodydata').append("<div id='po_dialog'></div>");
        }
        $('#po_dialog').dialog({
            title: title,
            width: 400,
            height: 'auto',
            href: base_url + '/order_management/Purchase_order/input_form',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: (type === 'edit') ? 'Update' : 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        po_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#po_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                if (type === 'edit') {
                    $('#po_input_form').form('load', row);
                } else {
                    $('#po_input_form').form('clear');
                }

            }
        });
    }

    function po_add() {
        po_input_form('add', 'Add Purchase Order', null);
        po_url = base_url + '/order_management/Purchase_order/save/0';
    }

    function po_edit() {
        var row = $('#po').datagrid('getSelected');
        if (row !== null) {
            po_input_form('edit', 'EDIT Purchase Order', row);
            po_url = base_url + '/order_management/Purchase_order/save/' + row.id;
        } else {
            $.messager.alert('Purchase Order not Selected', 'Please Select PO', 'warning');
        }
    }

    function po_delete() {
        var row = $('#po').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/Purchase_order/delete', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#po').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('Purchase Order  not Selected', 'Select PO', 'warning');
        }
    }
    function po_save() {
        $('#po_input_form').form('submit', {
            url: po_url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (content) {
                console.log(content);
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#po_dialog').dialog('close');
                    $('#po').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }
        });
    }


    // === awal fungsi ubah status PO ====
    // status PO Open
    function po_open() {
        var row = $('#po').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to open this PO?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/Purchase_order/po_open', {
                        id: row.id
                    }, function (content) {
                        console.log(content);
                        var result = eval('(' + content + ')');
                        if (result.success === true) {
                            $('#po').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    });
                }
            });
        } else {
            $.messager.alert('Purchase Order  not Selected', 'Select PO', 'warning');
        }
    }
    //status PO Close
    function po_close() {
        var row = $('#po').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to close this PO?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/Purchase_order/po_close', {
                        id: row.id
                    }, function (content) {
                        console.log(content);
                        var result = eval('(' + content + ')');
                        if (result.success == true) {
                            $('#po').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    });
                }
            });
        } else {
            $.messager.alert('Purchase Order  not Selected', 'Select PO', 'warning');
        }
    }
    //status PO Release
    function po_release() {
        var row = $('#po').datagrid('getSelected');
        if (row !== null) {
            var rows = $('#detail_po').datagrid('getData');
            if (rows.total > 0) {
                $.messager.confirm('Confirm', 'Are you sure to release this PO?', function (r) {
                    if (r) {
                        $.post(base_url + '/order_management/Purchase_order/po_release', {
                            id: row.id
                        }, function (content) {
                            console.log(content);
                            var result = eval('(' + content + ')');
                            if (result.success == true) {
                                $('#po').datagrid('reload');
                            } else {
                                $.messager.alert('Error', result.msg, 'error');
                            }
                        });
                    }
                });
            } else {
                $.messager.alert('Item PO', 'Input Item PO sebelum Release', 'warning');
            }
        } else {
            $.messager.alert('Purchase Order  not Selected', 'Select PO', 'warning');
        }
    }
    //status PO Finish
    function po_finish() {
        var row = $('#po').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to finish this PO?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/Purchase_order/po_finish', {
                        id: row.id
                    }, function (content) {
                        console.log(content);
                        var result = eval('(' + content + ')');
                        if (result.success == true) {
                            $('#po').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    });
                }
            });
        } else {
            $.messager.alert('Purchase Order  not Selected', 'Select PO', 'warning');
        }
    }
    //=== akhir fungsi ubah status PO ====

    function po_delete() {
        var row = $('#po').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/Purchase_order/delete', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#po').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('Purchase Order  not Selected', 'Select PO', 'warning');
        }
    }
    function po_save() {
        $('#po_input_form').form('submit', {
            url: po_url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (content) {
                console.log(content);
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#po_dialog').dialog('close');
                    $('#po').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }
        });
    }

    function po_print() {
        var row = $('#po').datagrid('getSelected');
        if (row !== null) {
//    		open_target("post", base_url + '/order_management/Purchase_order/prints', {id:row.id}, '_new')

            popupCenter(base_url + '/order_management/Purchase_order/prints/' + row.id, 'PRINT PO', 800, 600);
//    		window.open(base_url + '/order_management/Purchase_order/prints/' + row.id + '/print', '_blank')
        }
        else {
            $.messager.alert('Purchase Order not Selected', 'Please select PO to print', 'warning');
        }
    }

    // Detail item PO
    function po_item_search() {
        $('#detail_po').datagrid('reload', $('#item_po_form_search').serializeObject());
    }
    function item_po_form(type, title, row) {
        if ($('#item_po_dialog')) {
            $('#bodydata').append("<div id='item_po_dialog'></div>");
        }
        $('#item_po_dialog').dialog({
            title: title,
            width: 400,
            height: 'auto',
            href: base_url + '/order_management/Purchase_order/item_po_form',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: (type === 'edit') ? 'Update' : 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        //alert(po_url);
                        item_po_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#item_po_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                if (type === 'edit') {
                    $('#item_po_form').form('load', row);
                } else {
                    $('#item_po_form').form('clear');
                }

            }
        });
    }

    function po_item_add() {
        var row = $('#po').datagrid('getSelected');
        if (row !== null) {
            item_po_form('add', 'Add Item into PO', null);
            po_url = base_url + '/order_management/Purchase_order/item_save/0/' + row.id;
        } else {
            $.messager.alert('Purchase Order not Selected', 'Please Select PO', 'warning');
        }
    }

    function po_item_edit() {
        var row = $('#detail_po').datagrid('getSelected');
        if (row !== null) {
            item_po_form('edit', 'EDIT Purchase Order', row);
            po_url = base_url + '/order_management/Purchase_order/item_save/' + row.id + '/0';
        } else {
            $.messager.alert('Item was not Selected', 'Please Select Item', 'warning');
        }
    }

    function po_item_delete() {
        var row = $('#detail_po').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/Purchase_order/item_delete', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#detail_po').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('Item was not Selected', 'Select Item', 'warning');
        }
    }

    function item_po_save() {
        $('#item_po_form').form('submit', {
            url: po_url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (content) {
                console.log(content);
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#item_po_dialog').dialog('close');
                    $('#detail_po').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }
        });
    }
</script>
