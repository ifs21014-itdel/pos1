/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function recipe_search() {
    $('#recipe').datagrid('reload', {
        q: $('#recipe_form_search input[name=q]').val()
    });
}
function recipe_add() {
    recipe_input_form('add', 'Add Recipe', null);
    recipe_url = base_url + '/master/recipe/save/0';
}

function recipe_edit() {
    var row = $('#recipe').datagrid('getSelected');
    if (row !== null) {
        recipe_input_form('edit', 'Edit Recipe', row);
        recipe_url = base_url + '/master/recipe/save/' + row.id;
    } else {
        $.messager.alert('No Recipe Selected', 'Please Select Recipe', 'warning');
    }
}

function recipe_input_form(type, title, row) {
    if ($('#recipe_dialog')) {
        $('#bodydata').append("<div id='recipe_dialog'></div>");
    }
    $('#recipe_dialog').dialog({
        title: title,
        width: 400,
        height: 'auto',
        href: base_url + '/master/recipe/input',
        modal: true,
        resizable: false,
        shadow: false,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    recipe_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#recipe_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
            if (type === 'edit') {
                $('#recipe_item_list').combobox('reload', base_url + '/master/item/get_data/' + row.sku);
                $('#recipe_input_form').form('load', row);
            }
        }
    });
}

function recipe_save() {
    $('#recipe_input_form').form('submit', {
        url: recipe_url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            console.log(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#recipe_dialog').dialog('close');
                $('#recipe').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function recipe_delete() {
    var row = $('#recipe').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
            if (r) {
                $.post(base_url + '/master/recipe/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#recipe').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Recipe Selected', 'Please Select Recipe', 'warning');
    }
}

function recipe_detail_search() {
    $('#recipe_detail').datagrid('reload', {
        recipe_id: $('#recipe').datagrid('getSelected').id,
        q: $('#recipe_detail_form_search input[name=q]').val()
    });
}


function recipe_detail_add() {
    var row = $('#recipe').datagrid('getSelected');
    if (row !== null) {
        recipe_detail_input_form('add', 'Add Item', null);
        recipe_url = base_url + '/master/recipe/detail_save/0/' + row.id;
    } else {
        $.messager.alert('No Recipe Selected', 'Please Select Recipe', 'warning');
    }
}

function recipe_detail_edit() {
    var row = $('#recipe_detail').datagrid('getSelected');
    if (row !== null) {
        recipe_detail_input_form('edit', 'Edit Item', row);
        recipe_url = base_url + '/master/recipe/detail_save/' + row.id + '/' + row.recipe_id;
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}


function recipe_detail_input_form(type, title, row) {
    if ($('#recipe_dialog')) {
        $('#bodydata').append("<div id='recipe_dialog'></div>");
    }
    $('#recipe_dialog').dialog({
        title: title,
        width: 400,
        height: 'auto',
        href: base_url + '/master/recipe/detail_input',
        modal: true,
        resizable: false,
        shadow: false,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    recipe_detail_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#recipe_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
            if (type === 'edit') {
                $('#recipe_detail_item_list').combobox('reload', base_url + '/master/item/get_data/' + row.sku);
                $('#recipe_detail_input_form').form('load', row);
            }
        }
    });
}

function recipe_detail_save() {
    $('#recipe_detail_input_form').form('submit', {
        url: recipe_url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            console.log(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#recipe_dialog').dialog('close');
                $('#recipe_detail').datagrid('reload');
                $('#recipe').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function recipe_detail_delete() {
    var row = $('#recipe_detail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
            if (r) {
                $.post(base_url + '/master/recipe/detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#recipe_detail').datagrid('reload');
                        $('#recipe').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Recipe Selected', 'Please Select Recipe', 'warning');
    }
}