<div id="report_sales_percashier_toolbar">
	<form id="report_sales_percashier_form" onsubmit="return false">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="print_report_sales_percashier()">Print</a>
	</form>
</div>
<table id="report_sales_percashier"
	data-options="
       url:'<?php echo site_url('report/Sales_PerCashier/get_sales_percashier_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List Sales Per Cashier',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#report_sales_percashier_toolbar'">
	<thead>
		<tr>
			<th field="sku" width="200" halign="center">SKU</th>
			<th field="name" width="200" halign="center">Name</th>
			<th field="quantity" width="200" halign="center">Quantity</th>
			<th field="price" width="150" halign="center" align="right">Price</th>
		</tr>
	</thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#report_sales_percashier').datagrid({});
    });
</script>
