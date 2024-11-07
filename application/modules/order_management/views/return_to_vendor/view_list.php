<div id="rtv_toolbar">
	<form id="rtv_form_search" onsubmit="return false">
		Search : <input type="text" size="12" name="search" class="easyui-validatebox" onkeypress="if(event.keyCode==13){rtv_search()}" /> 
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="rtv_search()">Find</a> 
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="rtv_add()">Add</a> 
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="rtv_edit()">Edit</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="rtv_delete()">Delete</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" id="rtv_print" plain="true" onclick="rtv_print()">Print</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-complete" id="rtv_final" plain="true" onclick="rtv_final()">Finish</a>
	</form>
</div>
<table id="rtv"
	data-options="
       url:'<?php echo site_url('order_management/return_to_vendor/get_rtv_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List Return to Vendor',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#rtv_toolbar'">
	<thead>
		<tr>
			<th field="id" hidden="true"></th>
			<th field="reference" width="100" halign="center">Ref No.</th>
			<th field="vendor_code" width="100" halign="center" align="center">Vendor Code</th>
			<th field="vendor_name" width="200" halign="center">Vendor Name</th>
			<th field="username" width="100" halign="center" align="center">Created By</th>
			<th field="status" width="100" halign="center" align="center"
				data-options="formatter: function(value,row,index){
				if (value == 'f'){
					return 'DRAFT';
				} else {return 'FINAL'}}
			">Status</th>
			<th field="description" width="200" halign="center">Description</th>
	</thead>
</table>
<script type="text/javascript">
    var rtv_url = '';
    
    $(function() {
        $('#rtv').datagrid({
        	rowStyler: function(index, row){
        		if(row.status == 'f'){
        			return 'background-color:#FFA1A1;color:#000;';
                }
//                 else {
//                 	return 'background-color:#fff;color:#000;';
//                 }
        	},
        	onCheck: function (index, row) {
            	},
                onSelect: function (value, row, index) {
                    $('#detail_rtv').datagrid('reload', {
                        id: row.id
                    });
                    if (row.status === 'f') {//New PO
                     	 $('#rtv_final').linkbutton('enable');
                     	 $('#rtv_item_add').linkbutton('enable');
                     	 $('#rtv_item_edit').linkbutton('enable');
                     	 $('#rtv_item_delete').linkbutton('enable');
                     	 $('#rtv_print').linkbutton('disable');
	                 }else{
	                     $('#rtv_final').linkbutton('disable');
                     	 $('#rtv_item_add').linkbutton('disable');
                     	 $('#rtv_item_edit').linkbutton('disable');
                     	 $('#rtv_item_delete').linkbutton('disable');
                     	 $('#rtv_print').linkbutton('enable');
	                 }    
                },
                   
        });
    });

    function rtv_search() {
    	$('#rtv').datagrid('reload', $('#rtv_form_search').serializeObject());
    }

    function rtv_input_form(type, title, row) {
    	if ($('#rtv_dialog')) {
    		$('#bodydata').append("<div id='rtv_dialog'></div>");
    	}
    	$('#rtv_dialog').dialog({
    		title : title,
    		width : 400,
    		height : 'auto',
    		href : base_url + '/order_management/return_to_vendor/input_form',
    		modal : false,
    		resizable : false,
    		shadow : false,
    		buttons : [ {
    			text : (type === 'edit') ? 'Update' : 'Save',
    			iconCls : 'icon-save',
    			handler : function() {
    				rtv_save();
    			}
    		}, {
    			text : 'Close',
    			iconCls : 'icon-remove',
    			handler : function() {
    				$('#rtv_dialog').dialog('close');
    			}
    		} ],
    		onLoad : function() {
    			$(this).dialog('center');
    			if (type === 'edit') {
    				$('#rtv_input_form').form('load', row);
    			} else {
    				$('#rtv_input_form').form('clear');
    			}

    		}
    	});
    }

    function rtv_add() {
    	rtv_input_form('add', 'ADD Return to Vendor', null);
    	rtv_url = base_url + '/order_management/return_to_vendor/add_rtv';
    }

    function rtv_edit() {
    	var row = $('#rtv').datagrid('getSelected');
    	if (row !== null) {
    		rtv_input_form('edit', 'Edit Retun to Vendor', row);
    		rtv_url = base_url + '/order_management/return_to_vendor/update_rtv';
    	} else {
    		$.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
    	}
    }

    function rtv_delete(){
    	var row = $('#rtv').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function(r) {
                if (r) {
                    $.post(base_url + '/order_management/return_to_vendor/delete_rtv', {
                        id: row.id
                    }, function(result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#rtv').datagrid('reload');
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

    function rtv_print() {
        var row = $('#rtv').datagrid('getSelected');
        if (row !== null) {
//    		open_target("post", base_url + '/order_management/Purchase_order/prints', {id:row.id}, '_new')

            popupCenter(base_url + '/order_management/return_to_vendor/prints/' + row.id, 'PRINT PO', 800, 600);
//    		window.open(base_url + '/order_management/Purchase_order/prints/' + row.id + '/print', '_blank')
        }
        else {
            $.messager.alert('Warning', 'Please select at least 1 row to proceed', 'warning');
        }
    }

    function rtv_final(){
    	var row = $('#rtv').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to Finish this row to proceed?', function (r) {
            	if (r) {
                    $.post(base_url + '/order_management/return_to_vendor/rtv_final', {
                        id: row.id
                    }, function(result) {
                        console.log("result.success",result.success);
                        if (result.success) {
                            $('#rtv').datagrid('reload');
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
