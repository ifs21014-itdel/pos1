/**
 * 
 */
var vendor_item_url = '';
function vendor_item_search() {
	$('#vendor_item').datagrid('reload', $('#vendor_item_form_search').serializeObject());
}

function vendor_item_input_form(type, title, row) {
	if ($('#vendor_item_dialog')) {
		$('#bodydata').append("<div id='vendor_item_dialog'></div>");
	}
	$('#vendor_item_dialog').dialog({
		title : title,
		width : 400,
		height : 'auto',
		href : base_url + '/master/vendor_item/input_form',
		modal : false,
		resizable : false,
		shadow : false,
		buttons : [ {
			text : (type === 'edit') ? 'Update' : 'Save',
			iconCls : 'icon-save',
			handler : function() {
				vendor_item_save();
			}
		}, {
			text : 'Close',
			iconCls : 'icon-remove',
			handler : function() {
				$('#vendor_item_dialog').dialog('close');
			}
		} ],
		onLoad : function() {
			$(this).dialog('center');
			if (type === 'edit') {
				$('#vendor_item_input_form').form('load', row);
			} else {
				$('#vendor_item_input_form').form('clear');
			}

		}
	});
}

function vendor_item_add() {
	vendor_item_input_form('add', 'ADD Vendor Item', null);
	vendor_item_url = base_url + '/master/vendor_item/save/0';
}

function vendor_item_edit() {
	var row = $('#vendor_item').datagrid('getSelected');
	if (row !== null) {
		vendor_item_input_form('edit', 'EDIT Vendor Item', row);
		vendor_item_url = base_url + '/master/vendor_item/save/' + row.id;
	} else {
		$.messager.alert('Vendor Item not Selected', 'Please Select Vendor Item', 'warning');
	}
}

function vendor_item_delete(){
	var row = $('#vendor_item').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function(r) {
            if (r) {
                $.post(base_url + '/master/vendor_item/delete', {
                    id: row.id
                }, function(result) {
                    console.log(result.success);
                    if (result.success) {
                        $('#vendor_item').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Vendor Item not Selected', 'Select Vendor Item', 'warning');
    }
}
function vendor_item_save() {
	$('#vendor_item_input_form').form('submit', {
		url : vendor_item_url,
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(content) {
			console.log(content);
			var result = eval('(' + content + ')');
			if (result.success) {
				$('#vendor_item_dialog').dialog('close');
				$('#vendor_item').datagrid('reload');
			} else {
				$.messager.alert('Error', result.msg, 'error');
			}
		}
	});
}