/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var promotion_url = '';

function promotion_search() {
    $('#promotion').datagrid('reload', $('#promotion_form_search').serializeObject());
}

function promotion_detail_search() {
    var data = $('#promotion_detail_form_search').serializeObject();
    $.extend(data, {promotion_id: $('#promotion').datagrid('getSelected').id});
    $('#promotion_detail').datagrid('reload', data);
}

function promotion_input_form(type, title, row) {
    if ($('#promotion_dialog')) {
        $('#bodydata').append("<div id='promotion_dialog'></div>");
    }
    $('#promotion_dialog').dialog({
        title: title,
        width: 400,
        height: 'auto',
        href: base_url + '/master/promotion/input_form',
        modal: false,
        resizable: false,
        shadow: false,
        buttons: [{
                text: (type === 'edit') ? 'Update' : 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    promotion_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#promotion_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
            if (type === 'edit') {
                $('#promotion_input_item_id').combobox('reload', base_url + '/master/item/get_data/' + row.sku);
                $('#promotion_input_form').form('load', row);
            } else {
                $('#promotion_input_form').form('clear');
            }

        }
    });
}

function promotion_add() {
    promotion_input_form('add', 'ADD Promotion', null);
    promotion_url = base_url + '/master/promotion/add_promotion';
}

function promotion_edit() {
    var row = $('#promotion').datagrid('getSelected');
    if (row !== null) {
        promotion_input_form('edit', 'Edit Promotion', row);
        promotion_url = base_url + '/master/promotion/update_promotion';
    } else {
        $.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
    }
}

function promotion_delete() {
    var row = $('#promotion').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
            if (r) {
                $.post(base_url + '/master/promotion/delete_promotion', {
                    id: row.id
                }, function (result) {
                    console.log(result.success);
                    if (result.success) {
                        $('#promotion').datagrid('reload');
                        $('#promotion_detail').datagrid('reload');
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

function promotion_save() {
    $('#promotion_input_form').form('submit', {
        url: promotion_url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            console.log(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#promotion_dialog').dialog('close');
                $('#promotion').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}


function promotion_detail_add() {
    var row = $('#promotion').datagrid('getSelected');
    if (row !== null) {
        promotion_detail_input_form('add', 'Add Detail', null);
        promotion_url = base_url + '/master/promotion/detail_save/' + row.id;
    } else {
        $.messager.alert('No Promotion Selected', 'Please select at least 1 row of promotion with tipe group to proceed', 'warning');
    }
}

function promotion_detail_delete() {
    var row = $('#promotion_detail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
            if (r) {
                $.post(base_url + '/master/promotion/detail_delete', {
                    id: row.id
                }, function (result) {
                    console.log(result.success);
                    if (result.success) {
                        $('#promotion_detail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Promotion Detail Selected', 'Please select at least 1 row of promotion detail to proceed', 'warning');
    }
}

function promotion_detail_edit() {
    var row = $('#promotion_detail').datagrid('getSelected');
    if (row !== null) {
        promotion_detail_input_form('edit', 'Edit Detail', row);
        promotion_url = base_url + '/master/promotion/detail_save/' + row.promotion_id;
    } else {
        $.messager.alert('No Promotion Detail Selected', 'Please select at least 1 row of promotion detail to proceed', 'warning');
    }
}

function promotion_detail_input_form(type, title, row) {
    if ($('#promotion_dialog')) {
        $('#bodydata').append("<div id='promotion_dialog'></div>");
    }
    $('#promotion_dialog').dialog({
        title: title,
        width: 400,
        height: 'auto',
        href: base_url + '/master/promotion/detail_input',
        modal: false,
        resizable: false,
        shadow: false,
        buttons: [{
                text: (type === 'edit') ? 'Update' : 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    promotion_detail_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#promotion_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
            if (type === 'edit') {
                $('#promotion_detail_input_item_id').combobox('reload', base_url + '/master/item/get_data/' + row.sku);
                $('#promotion_detail_input_form').form('load', row);
            } else {
                $('#promotion_detail_input_form').form('clear');
            }

        }
    });
}


function promotion_detail_save() {
    $('#promotion_detail_input_form').form('submit', {
        url: promotion_url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            console.log(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#promotion_dialog').dialog('close');
                $('#promotion_detail').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}