<div id="sales_return_detail_toolbar" style="padding-bottom: 2px;">
	Barcode : <input type="text" id="item_barcode_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){sales_return_detail_search()}" />
	Item Name : <input type="text" id="item_name_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){sales_return_detail_search()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="sales_return_detail_search()"> Search</a>
</div>
<table id="sales_detail"
	data-options="
       url:'<?php echo site_url('sales_management/sales_detail/get_sales_detail_with_pagination') ?>',
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
       toolbar:'#sales_detail_toolbar'">
	<thead>
		<tr>
            <th field="id" hidden="true"></th>
            <th field="item_barcode" width="200" halign="center">Barcode</th>    
            <th field="item_name" width="250" halign="center">Item Name</th> 
            <th field="quantity" width="100" halign="center">Quantity</th> 
            <th field="discount" width="100" halign="center">Discount(%)</th> 
            <th field="sub_total_price" width="100" halign="center">Sub Total Price</th> 
            <th field="discount_update_by" width="250" halign="center">Discount Update by</th> 
        </tr>
	</thead>
</table>

<script type="text/javascript">
	$(function() {
		$('#sales_detail').datagrid({});
	});
	
	function sales_detail_search() {
	    var item_barcodeValue = $('#item_barcode_ID').val();
	    var item_nameValue = $('#item_name_ID').val();
	    $('#sales_detail').datagrid('reload', {
	    	item_barcode: item_barcodeValue,
	    	item_name: item_nameValue
	    });
	}

	function sales_return_detail_search() {

	    var row = $('#gr').datagrid('getSelected');
// 	    if (row !== null) {
	        $('#global_dialog').dialog({
	            title: 'New Goods Receive',
	            width: 700,
	            height: 500,
	            closed: false,
	            cache: true,
	            href: base_url + '/order_management/Good_receive/detail_input/' + 'null',
	            modal: true,
	            resizable: true,
	            buttons: [{
	                    text: 'Save',
	                    iconCls: 'icon-save',
	                    handler: function () {
	                        if (index_e !== null) {
	                            $('#gr_detail_dialog').datagrid('endEdit', index_e);
	                            $('#gr_detail_dialog').datagrid('checkRow', index_e);
	                            index_e = null;
	                        }

	                        $('#gr_detail_dialog').datagrid('acceptChanges');
	                        var rows = $('#gr_detail_dialog').datagrid('getChecked');

	                        if (rows.length !== 0) {
	                            var arr_po_detail_id = new Array();
	                            var arr_item_id = new Array();
	                            var arr_uom_id = new Array();
	                            var arr_unit_conversion = new Array();
	                            var arr_qty_receive = new Array();

	                            for (var i = 0; i < rows.length; i++) {
	                                if (rows[i].qty_receive !== "") {
	                                    arr_po_detail_id.push(rows[i].id);
	                                    arr_item_id.push(rows[i].item_id);
	                                    arr_uom_id.push(rows[i].uom_id);
	                                    arr_unit_conversion.push(rows[i].unit_conversion);
	                                    arr_qty_receive.push(rows[i].qty_receive);
	                                }
	                            }
	                            if (arr_po_detail_id.length > 0) {
	                                $.post(base_url + '/order_management/Good_receive/detail_save', {
	                                    good_received_id: row.id,
	                                    po_detail_id: arr_po_detail_id,
	                                    item_id: arr_item_id,
	                                    uom_id: arr_uom_id,
	                                    unit_conversion: arr_unit_conversion,
	                                    qty_receive: arr_qty_receive
	                                }, function (content) {
	                                    var result = eval('(' + content + ')');
	                                    if (result.success) {
	                                        $('#global_dialog').dialog('close');
	                                        $('#gr_detail').datagrid('reload');
	                                    } else {
	                                        $.messager.alert('Error', result.msg, 'error');
	                                    }
	                                });
	                            } else {
	                                $.messager.alert('Warning', 'Nothing to save', 'warning');
	                            }
	                        } else {
	                            $.messager.alert('Warning', 'Nothing to save', 'warning');
	                        }
	                    }
	                }, {
	                    text: 'Close',
	                    iconCls: 'icon-remove',
	                    handler: function () {
	                        $('#global_dialog').dialog('close');
	                    }
	                }],
	            onLoad: function () {
	                $(this).dialog('center');
	            }
	        });
// 	    } else {
// 	        $.messager.alert('No Goods Receive Selected', 'Please Goods Receive', 'warning');
// 	    }
	}
</script>
