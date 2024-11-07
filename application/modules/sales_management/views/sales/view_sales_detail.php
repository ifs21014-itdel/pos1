<div id="sales_detail_toolbar" style="padding-bottom: 2px;">
	Barcode : <input type="text" id="item_barcode_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){sales_detail_search()}" />
	Item Name : <input type="text" id="item_name_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){sales_detail_search()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="sales_detail_search()"> Search</a>
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
            <th field="discount" width="100" halign="center">Discount</th> 
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

</script>
