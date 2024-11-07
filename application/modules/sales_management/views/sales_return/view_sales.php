<div id="sales_return_toolbar" style="padding-bottom: 2px;">
	No. Faktur : <input type="text" id="reference_ID" size="20" class="easyui-validatebox" onkeypress="if(event.keyCode==13){sales_return_search()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="sales_return_search()"> Search</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="sales_return_add()">Add</a> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" id="broken_stock_print" plain="true" onclick="sales_return_print()">Print</a>
</div>
<table id="sales_return"
	data-options="
       url:'<?php echo site_url('sales_management/sales_return/get_sales_return_with_pagination') ?>',
       method:'post',
       border:true,
       fit:true,
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:true,
       pageSize:30,
       pageList:[30, 50, 70, 100, 200],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true, 
       remoteSort:true,
       multiSort:true,
       toolbar:'#sales_return_toolbar'">
	<thead>
		<tr>
            <th field="id" hidden="true"></th>
            <th field="reference" width="100" halign="center">No Faktur/Struk</th>
            <th field="sku" width="100" halign="center">SKU</th>
            <th field="item_name" width="200" halign="center">Nama Barang</th>    
            <th field="uom_code" width="80" halign="center" align="center">UOM</th>
            <th field="quantity" width="100" halign="center" align="right" >Quantity</th>
            <th field="price" width="120" halign="center" align="right" formatter="formatPrice">Price</th>
            <th field="description" width="220" halign="center">Description</th>
            <th field="created_date" width="220" halign="center">Tanggal</th>
        </tr>
	</thead>
</table>
<script type="text/javascript">
	var sales_return_url = '';
	
	$(function() {
		$('#sales_return').datagrid({
			onSelect : function( index, sales ){
// 				reloadSalesDetail( sales.id );
	        }
		});
	});

// 	function user_mapping_to_role_search() {
// 	    var sales_id_Value = $('#sales_ID').val();
// 	    $('#user_mapping_to_role').datagrid('reload', {
// 	    	sales_id: sales_id_Value
// 	    });
// 	}

// 	function reloadSalesDetail(sales_id){
// 		$('#sales_detail').datagrid('reload', {
// 			sales_id: sales_id
// 	    });
// 	}
	
	function sales_return_search() {
    	$('#sales_return').datagrid('reload', $('#sales_return_form_search').serializeObject());
    }
	function sales_return_input_form(type, title, row) {
    	if ($('#sales_return_dialog')) {
    		$('#bodydata').append("<div id='sales_return_dialog'></div>");
    	}
    	$('#sales_return_dialog').dialog({
    		title : title,
    		width : 500,
    		height : 'auto',
    		href : base_url + '/sales_management/sales_return/input_form',
    		modal : false,
    		resizable : false,
    		shadow : false,
    		buttons : [ {
    			text : (type === 'edit') ? 'Update' : 'Save',
    			iconCls : 'icon-save',
    			handler : function() {
    				sales_return_save();
    			}
    		}, {
    			text : 'Close',
    			iconCls : 'icon-remove',
    			handler : function() {
    				$('#sales_return_dialog').dialog('close');
    			}
    		} ],
    		onLoad : function() {
    			$(this).dialog('center');
    			if (type === 'edit') {
    				$('#sales_return_input_form').form('load', row);
    			} else {
    				$('#sales_return_input_form').form('clear');
    			}

    		}
    	});
    }

	function sales_return_add() {
		sales_return_input_form('add', 'ADD Item to Return Sales', null);
		sales_return_url = base_url + '/sales_management/sales_return/add_sales_return';
    }

	function sales_return_print() {
        var row = $('#sales_return').datagrid('getSelected');

        if ($('#sales_return_dialog')) {
    		$('#bodydata').append("<div id='sales_return_dialog'></div>");
    	}
    	
    	$('#sales_return_dialog').dialog({
    		title : 'PRINT',
    		width : 300,
    		height : 'auto',
    		href : base_url + '/sales_management/sales_return/print_form',
    		modal : false,
    		resizable : false,
    		shadow : false,
    		buttons : [ {
    			text : 'Print',
    			iconCls : 'icon-print',
    			handler : function() {    				
        			if($('#print_input_form').form('validate')){
            			var start_date = $('#print_input_form input[name="start-date"]').val();
            			var end_date = $('#print_input_form input[name="end-date"]').val();
        				popupCenter(base_url + '/sales_management/sales_return/prints/' + start_date+'/'+end_date, 'PRINT', 800, 600);
        			}
    			}
    		}, {
    			text : 'Close',
    			iconCls : 'icon-remove',
    			handler : function() {
    				$('#sales_return_dialog').dialog('close');
    			}
    		} ],
    		onLoad : function() {
    			$(this).dialog('center');
    		}
    	});
    }
	
</script>
