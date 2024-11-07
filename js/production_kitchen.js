/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function production_kitchen_search() {
    $('#production_kitchen').datagrid('reload', {
        q: $('#production_kitchen_form_search input[name=q]').val()
    });
}

function production_kitchen_add() {
    production_kitchen_input_form('add', 'Add Production Kitchen', null);
    production_kitchen_url = base_url + '/master/production_kitchen/save/0';
}

function production_kitchen_edit() {
    var row = $('#production_kitchen').datagrid('getSelected');
    if (row !== null) {
        production_kitchen_input_form('edit', 'Edit Recipe', row);
        production_kitchen_url = base_url + '/master/production_kitchen/save/0';
    } else {
        $.messager.alert('No Production Kitchen Selected', 'Please Select Production Kitchen', 'warning');
    }
}

function production_kitchen_input_form(type, title, row) {
    if ($('#production_kitchen_dialog')) {
        $('#bodydata').append("<div id='production_kitchen_dialog'></div>");
    }
    $('#production_kitchen_dialog').dialog({
        title: title,
        width: 400,
        height: 'auto',
        href: base_url + '/master/production_kitchen/input',
        modal: true,
        resizable: false,
        shadow: false,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    production_kitchen_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#production_kitchen_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
            if (type === 'edit') {
//                alert('test');
                $('#production_kitchen_input_form').form('load', row);
                $('#production_kitchen_item_list').combobox('setText', row.name);
            }
        }
    });
}

function production_kitchen_save() {
    $('#production_kitchen_input_form').form('submit', {
        url: production_kitchen_url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            console.log(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#production_kitchen_dialog').dialog('close');
                $('#production_kitchen').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function production_kitchen_delete() {
    var row = $('#production_kitchen').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
            if (r) {
                $.post(base_url + '/master/production_kitchen/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#production_kitchen').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Production Kitchen Selected', 'Please Select Production Kitchen', 'warning');
    }
}

function production_kitchen_confirm() {
    var row = $('#production_kitchen').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to confirm this data?', function (r) {
            if (r) {
                $.post(base_url + '/master/production_kitchen/confirm', {
                    id: row.id,
                    item_id: row.item_id,
                    qty: row.quantity
                }, function (result) {
                    if (result.success) {
                        $('#production_kitchen').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Production Kitchen Selected', 'Please Select Production Kitchen', 'warning');
    }
}

function production_kitchen_detail_search() {
    $('#production_kitchen_detail').datagrid('reload', {
        production_kitchen_id: $('#production_kitchen').datagrid('getSelected').id,
        q: $('#production_kitchen_detail_form_search input[name=q]').val()
    });
}

function production_kitchen_detail_add() {
    var row = $('#production_kitchen').datagrid('getSelected');
    if (row !== null) {
        production_kitchen_detail_input_form('add', 'Add Item', null);
        production_kitchen_url = base_url + '/master/production_kitchen/detail_save/0/' + row.id;
    } else {
        $.messager.alert('No Production Kitchen Selected', 'Please Select Production Kitchen', 'warning');
    }
}

function production_kitchen_detail_edit() {
    var row = $('#production_kitchen_detail').datagrid('getRows');
    for (var i = 0; i < row.length; i++) {
        $('#production_kitchen_detail').datagrid('beginEdit', i);
    }
    $('#production_kitchen_detail_save').linkbutton('enable');
    $('#production_kitchen_detail_edit').linkbutton('disable');
//    console.log(row);
}

function production_kitchen_detail_save() {
    var row = $('#production_kitchen_detail').datagrid('getRows');
    for (var i = 0; i < row.length; i++) {
        $('#production_kitchen_detail').datagrid('endEdit', i);
    }
    row = $('#production_kitchen_detail').datagrid('getChanges');
    var msg = '';
    if (row.length > 0) {
        for (i = 0; i < row.length; i++) {
            if (parseFloat(row[i].raw_quantity) < parseFloat(row[i].production_quantity)) {
                msg = "Invalid input, raw qty must be greater than production qty";
//                console.log('masuk');
                break;
            }
        }
        if (msg === '') {
            var param = JSON.stringify(row);
            $.post(base_url + '/master/production_kitchen/detail_save', {data: param},
            function (content) {
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#production_kitchen_detail').datagrid('reload');
                    $('#production_kitchen_detail_save').linkbutton('disable');
                    $('#production_kitchen_detail_edit').linkbutton('enable');
                } else {
                    display_error_message(result.msg);
                }
            });
        } else {
            $.messager.alert('Error', msg,'error');
            var row = $('#production_kitchen_detail').datagrid('getRows');
            for (var i = 0; i < row.length; i++) {
                $('#production_kitchen_detail').datagrid('beginEdit', i);
            }
            return;
        }
    } else {
        $('#production_kitchen_detail_save').linkbutton('disable');
        $('#production_kitchen_detail_edit').linkbutton('enable');
    }
    $('#production_kitchen_detail_save').linkbutton('disable');
    $('#production_kitchen_detail_edit').linkbutton('enable');
}

function production_kitchen_detail_delete() {
    var row = $('#production_kitchen_detail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
            if (r) {
                $.post(base_url + '/master/production_kitchen/detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#production_kitchen_detail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}