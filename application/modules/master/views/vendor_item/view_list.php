<div id="vendor_item_toolbar">
	<form id="vendor_item_form_search" onsubmit="return false">
		Supplier ID : 
		<input type="text" size="12" name="search" class="easyui-validatebox" onkeypress="if(event.keyCode==13){vendor_item_search()}" />
	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="vendor_item_search()">Find</a> 
	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="vendor_item_add()">Add</a> 
	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="vendor_item_edit()">Edit</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="vendor_item_delete()">Delete</a>
	</form>
</div>
<table id="vendor_item"
	data-options="
       url:'<?php echo site_url('master/vendor_item/get_vendor_item_with_pagination') ?>',
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
       toolbar:'#vendor_item_toolbar'">
	<thead>
		<tr>
			<th field="id" width="90" hidden="true"></th>
			<th field="vendor_code" width="100" halign="center">Vendor ID</th>
			<th field="vendor_name" width="200" halign="center">Nama Vendor</th>
			<th field="sku" width="80" halign="center" align="center">SKU</th>
			<th field="barcode" width="100" halign="center" align="center" >Barcode</th>
			<th field="item_name" width="200" halign="center" align="center" >Nama Barang</th>
			<th field="price" width="100" halign="center" align="right" formatter="formatPrice">Price</th>
			<th field="discount" width="100" halign="center" align="right">Diskon</th>
		</tr>	
	</thead>
</table>
<script type="text/javascript">
    var vendor_item_url = '';
    
    $(function() {
        $('#vendor_item').datagrid({});
    });

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
    	vendor_item_url = base_url + '/master/vendor_item/add_vendor_item';
    }

    function vendor_item_edit() {
    	var row = $('#vendor_item').datagrid('getSelected');
    	if (row !== null) {
    		vendor_item_input_form('edit', 'Edit Vendor Item', row);
    		vendor_item_url = base_url + '/master/vendor_item/update_vendor_item';
    	} else {
    		$.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
    	}
    }

    function vendor_item_delete(){
    	var row = $('#vendor_item').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function(r) {
                if (r) {
                    $.post(base_url + '/master/vendor_item/delete_vendor_item', {
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
        	$.messager.alert('Warning', 'Please select at least 1 row to proceed', 'warning');
        }
    }
    
</script>
