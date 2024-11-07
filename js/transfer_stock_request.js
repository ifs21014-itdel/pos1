/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function transfer_stock_request_search() {
    $('#transfer_stock_request').datagrid('reload', $('#transfer_stock_request_form_search').serializeObject());
}
function transfer_stock_request_add() {
    transfer_stock_request_input_form('add', 'Add Transfer Stock Request ', null);
    transfer_stock_request_url = base_url + '/order_management/transfer_stock_request/save/0';
}

function transfer_stock_request_edit() {
    var row = $('#transfer_stock_request').datagrid('getSelected');
    if (row !== null) {
        transfer_stock_request_input_form('edit', 'Edit Transfer Stock Request ', row);
        transfer_stock_request_url = base_url + '/order_management/transfer_stock_request/save/' + row.id;
    } else {
        $.messager.alert('No Transfer Stock Request  Selected', 'Please Select Transfer Stock Request ', 'warning');
    }
}

function transfer_stock_request_input_form(type, title, row) {
    if ($('#transfer_stock_request_dialog')) {
        $('#bodydata').append("<div id='transfer_stock_request_dialog'></div>");
    }
    $('#transfer_stock_request_dialog').dialog({
        title: title,
        width: 400,
        height: 'auto',
        href: base_url + '/order_management/transfer_stock_request/input',
        modal: true,
        resizable: false,
        shadow: false,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    transfer_stock_request_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#transfer_stock_request_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
            if (type === 'edit') {
                $('#transfer_stock_request_item_list').combobox('reload', base_url + '/order_management/item/get_data/' + row.sku);
                $('#transfer_stock_request_input_form').form('load', row);
            }
        }
    });
}

function transfer_stock_request_save() {
    $('#transfer_stock_request_input_form').form('submit', {
        url: transfer_stock_request_url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            console.log(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#transfer_stock_request_dialog').dialog('close');
                $('#transfer_stock_request').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function transfer_stock_request_delete() {
    var row = $('#transfer_stock_request').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
            if (r) {
                $.post(base_url + '/order_management/transfer_stock_request/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#transfer_stock_request').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Transfer Stock Request  Selected', 'Please Select Transfer Stock Request ', 'warning');
    }
}

function transfer_stock_request_confirm() {
    var row = $('#transfer_stock_request').datagrid('getSelected');
    if (row !== null) {
        var rows_detail = $('#transfer_stock_request_detail').datagrid('getRows');
        if (rows_detail.length > 0) {
            $.messager.confirm('Confirm', 'Are you sure to confirm this request?', function (r) {
                if (r) {
                    $.post(base_url + '/order_management/transfer_stock_request/confirm', {
                        id: row.id
                    }, function (result) {
                        if (result.success) {
                            $('#transfer_stock_request').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('No Item to Request', 'Please Input Item to Request ', 'warning');
        }
    } else {
        $.messager.alert('No Transfer Stock Request  Selected', 'Please Select Transfer Stock Request ', 'warning');
    }
}

function transfer_stock_request_upload() {
    var row = $('#transfer_stock_request').datagrid('getSelected');
    $.messager.confirm('Confirm', 'Are you sure to Synchronize Transfer Stock Request?', function (r) {
        if (r) {
            $.post(base_url + '/synchronize/Store_factory/transfer_stock_request_upload', {
                transfer_stock_request_id: row.id
            }, function (result) {
                console.log(result.success);
                if (result.success) {
                    $.messager.alert('Success', 'Sync/Upload Berhasil');
                    $('#transfer_stock_request').datagrid('reload');
                    $('#transfer_stock_request_item').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }, 'json');
        }
    });
}
function transfer_stock_request_detail_search() {
    $('#transfer_stock_request_detail').datagrid('reload', {
        transfer_stock_request_id: $('#transfer_stock_request').datagrid('getSelected').id,
        q: $('#transfer_stock_request_detail_form_search input[name=q]').val()
    });
}


function transfer_stock_request_detail_add() {
    var row = $('#transfer_stock_request').datagrid('getSelected');
    if (row !== null) {
        transfer_stock_request_detail_input_form('add', 'Add Item', null);
        transfer_stock_request_url = base_url + '/order_management/transfer_stock_request/detail_save/0/' + row.id;
    } else {
        $.messager.alert('No Transfer Stock Request  Selected', 'Please Select Transfer Stock Request ', 'warning');
    }
}

function transfer_stock_request_detail_edit() {
    var row = $('#transfer_stock_request_detail').datagrid('getSelected');
    if (row !== null) {
        transfer_stock_request_detail_input_form('edit', 'Edit Item', row);
        transfer_stock_request_url = base_url + '/order_management/transfer_stock_request/detail_save/' + row.id + '/' + row.transfer_stock_request_id;
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}


function transfer_stock_request_detail_input_form(type, title, row) {
    if ($('#transfer_stock_request_dialog')) {
        $('#bodydata').append("<div id='transfer_stock_request_dialog'></div>");
    }
    $('#transfer_stock_request_dialog').dialog({
        title: title,
        width: 400,
        height: 'auto',
        href: base_url + '/order_management/transfer_stock_request/detail_input',
        modal: true,
        resizable: false,
        shadow: false,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    transfer_stock_request_detail_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#transfer_stock_request_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
            if (type === 'edit') {
                $('#transfer_stock_request_detail_item_list').combobox('reload', base_url + '/master/item/get_data/' + row.sku);
                $('#transfer_stock_request_detail_input_form').form('load', row);
            }
        }
    });
}

function transfer_stock_request_detail_save() {
    $('#transfer_stock_request_detail_input_form').form('submit', {
        url: transfer_stock_request_url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            console.log(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#transfer_stock_request_dialog').dialog('close');
                $('#transfer_stock_request_detail').datagrid('reload');
                $('#transfer_stock_request').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function transfer_stock_request_detail_delete() {
    var row = $('#transfer_stock_request_detail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
            if (r) {
                $.post(base_url + '/order_management/transfer_stock_request/detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#transfer_stock_request_detail').datagrid('reload');
                        $('#transfer_stock_request').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Transfer Stock Request  Selected', 'Please Select Transfer Stock Request ', 'warning');
    }
}

function transfer_stock_create_transfer() {
    var row = $('#transfer_stock_request').datagrid('getSelected');
    if (row !== null) {
        if ($('#transfer_stock_request_dialog')) {
            $('#bodydata').append("<div id='transfer_stock_request_dialog'></div>");
        }
        $('#transfer_stock_request_dialog').dialog({
            title: 'Transfer Stock',
            width: 700,
            height: 'auto',
            href: base_url + '/order_management/transfer_stock_request/create_transfer/' + row.id,
            modal: true,
            resizable: true,
            shadow: false,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#transfer_stock_create_form').form('validate')) {
                            var header = $('#transfer_stock_create_form').serializeObject();
                            //console.log(header);
                            var rows_checked = $('#transfer_stock_create_detail').datagrid('getChecked');
//                            console.log(rows_checked);
                            var details = [];
                            if (rows_checked.length > 0) {
                                for (var i = 0; i < rows_checked.length; i++) {
                                    var row_index = $('#transfer_stock_create_detail').datagrid('getRowIndex', rows_checked[i]);
                                    $('#transfer_stock_create_detail').datagrid('endEdit', row_index);
                                    console.log(rows_checked[i]);
                                    details.push({
                                        transfer_stock_request_item_id: rows_checked[i].id,
                                        item_id: rows_checked[i].item_id,
                                        qty: rows_checked[i].outstanding
                                    });
                                }
                                var object = {
                                    header: header,
                                    details: details
                                };
                                var param = "data=" + JSON.stringify(object);
                                if (details.length > 0) {
                                    $.post(base_url + '/order_management/Stock_transfer_manifest/save_from_request_transfer', param, function (content) {
                                        var result = eval('(' + content + ')');
                                        if (result.success) {
                                            if ($('#main-tab').tabs('exists', 'Stock Transfer Manifest')) {
                                                $('#main-tab').tabs('select', 'Stock Transfer Manifest');
                                                $('#stock_transfer_manifest').datagrid('reload');
                                            } else {
                                                $('#main-tab').tabs('add', {
                                                    title: 'Stock Transfer Manifest',
                                                    href: base_url + '/order_management/Stock_transfer_manifest/index',
                                                    closable: true,
                                                    fit: true,
                                                    cache: true,
                                                    tabHeight: 20
                                                });
                                            }
                                            $('#transfer_stock_request_dialog').dialog('close');
                                            $('#transfer_stock_request_detail').datagrid('reload');
                                            $('#transfer_stock_request').datagrid('reload');

                                        } else {
                                            display_error_message(result.msg);
                                        }
                                    }, 'json');
                                } else {
                                    display_error_message('Please check item to ceate PR..!');
                                }
                            } else {
                                $.messager.alert('No Item Checked', 'Please Check Item to Transfer', 'warning');
                            }
                        }
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#transfer_stock_request_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                $('#store_destination_id_67').combobox('setValue', row.store_destination_id);
            }
        });
    } else {
        $.messager.alert('No Transfer Stock Request  Selected', 'Please Select Transfer Stock Request ', 'warning');
    }
}