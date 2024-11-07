/**
 * 
 */
var UOM_url = '';
function UOM_search() {
	$('#UOM').datagrid('reload', $('#UOM_form_search').serializeObject());
}

function UOM_input_form(type, title, row) {
	if ($('#UOM_dialog')) {
		$('#bodydata').append("<div id='UOM_dialog'></div>");
	}
	$('#UOM_dialog').dialog({
		title : title,
		width : 300,
		height : 'auto',
		href : base_url + '/master/UOM/input_form',
		modal : false,
		resizable : false,
		shadow : false,
		buttons : [ {
			text : (type === 'edit') ? 'Update' : 'Save',
			iconCls : 'icon-save',
			handler : function() {
				UOM_save();
			}
		}, {
			text : 'Close',
			iconCls : 'icon-remove',
			handler : function() {
				$('#UOM_dialog').dialog('close');
			}
		} ],
		onLoad : function() {
			$(this).dialog('center');
			if (type === 'edit') {
				$('#UOM_input_form').form('load', row);
			} else {
				$('#UOM_input_form').form('clear');
			}

		}
	});
}

function UOM_add() {
	UOM_input_form('add', 'Add UOM', null);
	UOM_url = base_url + '/master/UOM/save/0';
}

function UOM_edit() {
	var row = $('#UOM').datagrid('getSelected');
	if (row !== null) {
		UOM_input_form('edit', 'EDIT UOM', row);
		UOM_url = base_url + '/master/UOM/save/' + row.id;
	} else {
		$.messager.alert('UOM not Selected', 'Please Select UOM', 'warning');
	}
}

function UOM_delete(){
	var row = $('#UOM').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function(r) {
            if (r) {
                $.post(base_url + '/master/UOM/delete', {
                    id: row.id
                }, function(result) {
                    console.log(result.success);
                    if (result.success) {
                        $('#UOM').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('UOM not Selected', 'Select UOM', 'warning');
    }
}
function UOM_save() {
	$('#UOM_input_form').form('submit', {
		url : UOM_url,
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(content) {
			console.log(content);
			var result = eval('(' + content + ')');
			if (result.success) {
				$('#UOM_dialog').dialog('close');
				$('#UOM').datagrid('reload');
			} else {
				$.messager.alert('Error', result.msg, 'error');
			}
		}
	});
}