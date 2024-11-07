/**
 * 
 */
var supplier_url = '';
function supplier_search() {
	$('#supplier').datagrid('reload', $('#supplier_form_search').serializeObject());
}

function supplier_input_form(type, title, row) {
	if ($('#supplier_dialog')) {
		$('#bodydata').append("<div id='supplier_dialog'></div>");
	}
	$('#supplier_dialog').dialog({
		title : title,
		width : 800,
		height : 'auto',
		href : base_url + '/master/supplier/input_form',
		modal : false,
		resizable : false,
		shadow : false,
		buttons : [ {
			text : (type === 'edit') ? 'Update' : 'Save',
			iconCls : 'icon-save',
			handler : function() {
				supplier_save();
			}
		}, {
			text : 'Close',
			iconCls : 'icon-remove',
			handler : function() {
				$('#supplier_dialog').dialog('close');
			}
		} ],
		onLoad : function() {
			$(this).dialog('center');
			if (type === 'edit') {
				$('#supplier_input_form').form('load', row);
			} else {
				$('#supplier_input_form').form('clear');
			}

		}
	});
}

function supplier_add() {
	supplier_input_form('add', 'ADD ITEM', null);
	supplier_url = base_url + '/master/supplier/save/0';
}

function supplier_edit() {
	var row = $('#supplier').datagrid('getSelected');
	if (row !== null) {
		supplier_input_form('edit', 'EDIT ITEM', row);
		supplier_url = base_url + '/master/supplier/save/' + row.id;
	} else {
		$.messager.alert('Item not Selected', 'Please Select Item', 'warning');
	}
}


function supplier_delete(){
	var row = $('#supplier').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function(r) {
            if (r) {
                $.post(base_url + '/master/supplier/delete', {
                    id: row.id	
                }, function(result) {
                    console.log(result.success);
                    if (result.success) {
                        $('#supplier').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Item not Selected', 'Select supplier', 'warning');
    }
}
function supplier_save() {
	$('#supplier_input_form').form('submit', {
		url : supplier_url,
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(content) {
			console.log(content);
			var result = eval('(' + content + ')');
			if (result.success) {
				$('#supplier_dialog').dialog('close');
				$('#supplier').datagrid('reload');
			} else {
				$.messager.alert('Error', result.msg, 'error');
			}
		}
	});
}