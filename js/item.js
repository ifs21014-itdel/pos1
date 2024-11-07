/**
 * 
 */
var item_url = '';
function item_search() {
	$('#item').datagrid('reload', $('#item_form_search').serializeObject());
}

function item_input_form(type, title, row) {
	if ($('#item_dialog')) {
		$('#bodydata').append("<div id='item_dialog'></div>");
	}
	$('#item_dialog').dialog({
		title : title,
		width : 800,
		height : 'auto',
		href : base_url + '/master/item/input_form',
		modal : false,
		resizable : false,
		shadow : false,
		buttons : [ {
			text : (type === 'edit') ? 'Update' : 'Save',
			iconCls : 'icon-save',
			handler : function() {
				item_save();
			}
		}, {
			text : 'Close',
			iconCls : 'icon-remove',
			handler : function() {
				$('#item_dialog').dialog('close');
			}
		} ],
		onLoad : function() {
			$(this).dialog('center');
			if (type === 'edit') {
				$('#item_input_form').form('load', row);
			} else {
				$('#item_input_form').form('clear');
			}

		}
	});
}

function item_add() {
	item_input_form('add', 'ADD ITEM', null);
	item_url = base_url + '/master/item/save/0';
}

function item_edit() {
	var row = $('#item').datagrid('getSelected');
	if (row !== null) {
		item_input_form('edit', 'EDIT ITEM', row);
		item_url = base_url + '/master/item/save/' + row.id;
	} else {
		$.messager.alert('Item not Selected', 'Please Select Item', 'warning');
	}
}



//function item_view() {
//	var row = $('#item').datagrid('getSelected');
//	if (row !== null) {
//		item_input_form('edit', 'View Detail', null);
////		item_url = base_url + '/master/item/save/' + row.id;
//	} else {
//		$.messager.alert('Item not Selected', 'Please Select Item', 'warning');
//	}
//}

function item_delete(){
	var row = $('#item').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function(r) {
            if (r) {
                $.post(base_url + '/master/item/delete', {
                    id: row.id	
                }, function(result) {
                    console.log(result.success);
                    if (result.success) {
                        $('#item').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Item not Selected', 'Select item', 'warning');
    }
}
function item_save() {
	$('#item_input_form').form('submit', {
		url : item_url,
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(content) {
			console.log(content);
			var result = eval('(' + content + ')');
			if (result.success) {
				$('#item_dialog').dialog('close');
				$('#item').datagrid('reload');
			} else {
				$.messager.alert('Error', result.msg, 'error');
			}
		}
	});
}