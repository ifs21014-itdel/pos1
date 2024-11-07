/**
 * 
 */
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
//		open_target("post", base_url + '/order_management/Purchase_order/prints', {id:row.id}, '_new')

        popupCenter(base_url + '/order_management/Purchase_order/prints/' + row.id, 'PRINT PO', 800, 600);
//		window.open(base_url + '/order_management/Purchase_order/prints/' + row.id + '/print', '_blank')
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