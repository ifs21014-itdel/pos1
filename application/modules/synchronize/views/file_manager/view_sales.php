<div id="sales_toolbar" style="padding-bottom: 2px;">
	No. Faktur : <input type="text" id="reference_ID" size="10" class="easyui-validatebox" onkeypress="if(event.keyCode==13){user_mapping_to_role_search()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="user_mapping_to_role_search()"> Search</a>
</div>
<table id="sales"
	data-options="
       url:'<?php echo site_url('sales_management/sales/get_sales_with_pagination') ?>',
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
       toolbar:'#sales_toolbar'">
	<thead>
		<tr>
            <th field="id" hidden="true"></th>
            <th field="reference" width="220" halign="center">No. Faktur</th>
            <th field="customer_name" width="220" halign="center">Customer Name</th>    
            <th field="total_price" width="220" halign="center">Total Price</th>
            <th field="total_cash" width="220" halign="center">Total Cash</th>
            <th field="amount_pay_cash" width="220" halign="center">Cash</th>
            <th field="credit_card_number" width="220" halign="center">Credit Card Number</th>
            <th field="amount_pay_cash_credit_card" width="220" halign="center">Pay via Credit Card</th>
            <th field="debit_card_number" width="220" halign="center">Debit Card Number</th>
            <th field="amount_pay_cash_debit_card" width="220" halign="center">Pay via Credit Card</th>
            <th field="voucher_number" width="220" halign="center">Voucher Number</th>
            <th field="amount_pay_cash_voucher" width="220" halign="center">Pay via Voucher</th>
            <th field="credit_card_type" width="220" halign="center">Credit Card Type</th>
            <th field="debit_card_type" width="220" halign="center">Debit Card Type</th>
            <th field="total_quantity" width="220" halign="center">Total Quantity</th>
            <th field="sales_date" width="220" halign="center">Sales Date</th>
            <th field="cashier_name" width="220" halign="center">Cashier</th>
        </tr>
	</thead>
</table>
<script type="text/javascript">
	$(function() {
		$('#sales').datagrid({
			onSelect : function( index, sales ){
				reloadSalesDetail( sales.id );
	        }
		});
	});

	function user_mapping_to_role_search() {
	    var sales_id_Value = $('#sales_ID').val();
	    $('#user_mapping_to_role').datagrid('reload', {
	    	sales_id: sales_id_Value
	    });
	}

	function reloadSalesDetail(sales_id){
		$('#sales_detail').datagrid('reload', {
			sales_id: sales_id
	    });
	}
	
</script>
