<div id="detail_gr_ts_toolbar">
	<form id="item_gr_ts_form_search" onsubmit="return false">
	</form>
</div>
<table id="detail_gr_ts"
	data-options="
       url:'<?php echo site_url('/order_management/stock_transfer_manifest/get_stock_transfer_manifest_items_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List Item',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#detail_gr_ts_toolbar'">
	<thead>
		
		<tr>
			<th field="id" width="90" halign="center"hidden="false">ID</th>
			<th field="sku" width="100" halign="center" align="left">SKU</th>
			<th field="barcode" width="100" halign="center" align="left">Barcode</th>
			<th field="item_name" width="300" halign="center" align="left">Nama Barang</th>
			<th field="uom_code" width="50" halign="center" align="center">Satuan</th>
			<th field="quantity" width="100" halign="center" align="right">Jumlah Barang</th>
		</tr>
	</thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#detail_gr_ts').datagrid({
//             view: detailview,
            onCheck: function(index,row){
            },
            onSelect: function(index,row){
            },
            onUnselect: function(index,row){
            },
            onSelectAll : function(row){
            },
            onUnselectAll : function(row){
            },
            detailFormatter: function(rowIndex, rowData){
                return '<table><tr>' +
                    '<td style="vertical-align: text-top; padding: 10px;">Remark <span style="font-style: italic;font-size: 10px;">(*optional)</span></td><td style="border:0">' +
                    '<textarea data-id="'+rowData.sku+'" data-name="approval-remark" rows="2" cols="80" name="remark[]"></textarea>' +
                    '</td>' +
                    '</tr></table>';
            }
        
        });
    });
</script>
