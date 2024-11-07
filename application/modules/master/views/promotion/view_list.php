<div id="promotion_toolbar">
	<form id="promotion_form_search" onsubmit="return false">
		Search : <input type="text" size="12" name="name" class="easyui-validatebox" onkeypress="if(event.keyCode==13){promotion_search()}" />
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="promotion_search()">Find</a> 
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="promotion_add()">Add</a> 
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="promotion_edit()">Edit</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="promotion_delete()">Delete</a>
	</form>
</div>
<table id="promotion"
	data-options="
       url:'<?php echo site_url('master/promotion/get_promotion_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List Promotion',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#promotion_toolbar'">
	<thead>
		<tr>
			<th field="id" hidden="true"></th>
			<th field="sku" width="90" halign="center">SKU</th>
			<th field="barcode" width="100" halign="center">Barcode</th>
			<th field="item_name" width="200" halign="center">Nama Barang</th>
			<th field="discount_type" width="100" halign="center" align="center">Tipe Diskon</th>
			<th field="value" width="100" halign="center" align="right" formatter="formatPrice">Value</th>
			<th field="start_date" width="150" halign="center" align="center">Awal Promo</th>
			<th field="end_date" width="150" halign="center" align="center">Akhir Promo</th>
			<th field="username" width="100" halign="center" align="center">Pembuat</th>
			<th field="created_date" width="100" halign="center" align="center">Dibuat Tanggal</th>
	</thead>
</table>
<script type="text/javascript">
    var promotion_url = '';
    
    $(function() {
        $('#promotion').datagrid({});
    });

    function promotion_search() {
    	$('#promotion').datagrid('reload', $('#promotion_form_search').serializeObject());
    }

    function promotion_input_form(type, title, row) {
    	if ($('#promotion_dialog')) {
    		$('#bodydata').append("<div id='promotion_dialog'></div>");
    	}
    	$('#promotion_dialog').dialog({
    		title : title,
    		width : 400,
    		height : 'auto',
    		href : base_url + '/master/promotion/input_form',
    		modal : false,
    		resizable : false,
    		shadow : false,
    		buttons : [ {
    			text : (type === 'edit') ? 'Update' : 'Save',
    			iconCls : 'icon-save',
    			handler : function() {
    				promotion_save();
    			}
    		}, {
    			text : 'Close',
    			iconCls : 'icon-remove',
    			handler : function() {
    				$('#promotion_dialog').dialog('close');
    			}
    		} ],
    		onLoad : function() {
    			$(this).dialog('center');
    			if (type === 'edit') {
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

    function promotion_delete(){
    	var row = $('#promotion').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function(r) {
                if (r) {
                    $.post(base_url + '/master/promotion/delete_promotion', {
                        id: row.id
                    }, function(result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#promotion').datagrid('reload');
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
