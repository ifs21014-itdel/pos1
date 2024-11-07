<div id="detail_gr_toolbar">
	<form id="item_gr_form_search" onsubmit="return false">
		<a href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-complete" plain="true" onclick="gr_terima()">Terima Barang</a>
	</form>
</div>
<table id="detail_gr"
	data-options="
       url:'<?php echo site_url('/master/good_receive/item_get') ?>',
       method:'post',
       border:true,       
       title:'List Item',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       enableCellEditing:true,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#detail_gr_toolbar'">
	<thead>
		
		<tr>
			<th field="id" width="90" halign="center" hidden="true"></th>
			<th field="item_code" width="90" halign="center">Kode Barang</th>
			<th field="item_name" width="250" halign="center" align="center">Nama Barang</th>
			<th field="unit_code" width="90" halign="center" align="center">Satuan</th>
			<th field="quantity" width="150" halign="center" editor="text" align="right">Jumlah Pesanan</th>
<!-- 			<th data-options="field:'quantity',width:'150',height:'center',editor:'text'">Jumlah Pesanan</th> -->
			
			<th field="total_receive" width="100" halign="center" data>Jumlah Diterima</th>
		</tr>
	</thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#detail_gr').datagrid({
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
