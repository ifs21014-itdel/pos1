<div id="vendor_toolbar">
	<form id="vendor_form_search" onsubmit="return false">
		Search <input type="text" size="12" name="search"
			class="easyui-validatebox" onkeypress="if(event.keyCode==13){vendor_search()}" /><a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-search" plain="true" onclick="vendor_search()">Find</a>
		<a href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-add" plain="true" onclick="vendor_add()">Add</a> <a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-edit" plain="true" onclick="vendor_edit()">Edit</a> <a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-remove" plain="true" onclick="vendor_delete()">Delete</a>
	</form>
</div>
<table id="vendor"
	data-options="
       url:'<?php echo site_url('master/vendor/get_vendor_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List Vendor',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#vendor_toolbar'">
	<thead data-options="frozen:true">
		<tr>
			<th field="id" hidden="true"></th>
			<th field="code" width="100" halign="right" align="right">Vendor ID</th>
			<th field="name" width="200" halign="center" align="left">Vendor Name</th>
	
	</thead>
	<thead>
		<tr>
			<th field="npwp" width="100" halign="center" align="center">NPWP</th>
			<th field="phone_number" width="150" halign="center" align="center">Phone Number</th>
			<th field="contact_name" width="200" halign="center" align="left">Contact Name</th>
			<th field="contact_number" width="100" halign="center" align="center">Contact Number</th>
			<th field="discount" width="150" halign="center" align="right">Discount (%)</th>
			<th field="discount_promotion" width="150" halign="center" align="right">Promo Discount(%)</th>
			<th field="address" width="300" halign="center" align="center">Address</th>
			<th field="term_of_payment" width="50" halign="center" align="center">TOP</th>
			<th field="pkp" width="100" halign="center" align="center" data-options="formatter: function(value,row,index){
				if (value == 't'){
					return 'YA';
				} else {
					return 'TIDAK';
				}
			}">PKP Status</th>
		</tr>
	</thead>
</table>
<script type="text/javascript">
var vendor_url = '';

$(function() {
    $('#vendor').datagrid({});
});

function vendor_search() {
	$('#vendor').datagrid('reload', $('#vendor_form_search').serializeObject());
}

function vendor_input_form(type, title, row) {
	if ($('#vendor_dialog')) {
		$('#bodydata').append("<div id='vendor_dialog'></div>");
	}
	$('#vendor_dialog').dialog({
		title : title,
		width : 600,
		height : 'auto',
		href : base_url + '/master/vendor/input_form',
		modal : false,
		resizable : false,
		shadow : false,
		buttons : [ {
			text : (type === 'edit') ? 'Update' : 'Save',
			iconCls : 'icon-save',
			handler : function() {
				vendor_save();
			}
		}, {
			text : 'Close',
			iconCls : 'icon-remove',
			handler : function() {
				$('#vendor_dialog').dialog('close');
			}
		} ],
		onLoad : function() {
			$(this).dialog('center');
			if (type === 'edit') {
				$('#vendor_input_form').form('load', row);
			} else {
				$('#vendor_input_form').form('clear');
			}

		}
	});
}

function vendor_add() {
	vendor_input_form('add', 'ADD Vendor', null);
	vendor_url = base_url + '/master/vendor/add_vendor';
}

function vendor_edit() {
	var row = $('#vendor').datagrid('getSelected');
	if (row !== null) {
		vendor_input_form('edit', 'Edit Vendor', row);
		vendor_url = base_url + '/master/vendor/update_vendor';
	} else {
		$.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
	}
}

function vendor_delete(){
	var row = $('#vendor').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function(r) {
            if (r) {
                $.post(base_url + '/master/vendor/delete_vendor', {
                    id: row.id
                }, function(result) {
                    console.log(result.success);
                    if (result.success) {
                        $('#vendor').datagrid('reload');
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
</script>
