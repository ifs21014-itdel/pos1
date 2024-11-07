<div id="detail_tr_toolbar">
	<form id="item_tr_form_search" onsubmit="return false">
		Search : <input type="text" size="12" name="code_or_name"
			class="easyui-validatebox" onkeypress="if(event.keyCode==13){}" /> <a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-search" plain="true" onclick="tr_item_search()">Find</a> <a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-add" plain="true" onclick="tr_item_add()">Add</a> <a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-edit" plain="true" onclick="tr_item_edit()">Edit</a>
			<a href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-remove" plain="true" onclick="tr_item_delete()">Delete</a>
	</form>
</div>
<table id="detail_tr"
	data-options="
       url:'<?php echo site_url('/master/transfer_req/item_get') ?>',
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
       toolbar:'#detail_tr_toolbar'">
	<thead>
		
		<tr>
			<th field="id" width="90" halign="center" hidden="true"></th>
			<th field="sku" width="90" halign="center">Kode Barang</th>
			<th field="item_name" width="250" halign="center" align="center">Nama Barang</th>
			<th field="uom" width="250" halign="center" align="right">Satuan</th>
			<th field="qty" width="150" halign="center" align="right">Jumlah Satuan</th>
		</tr>
	</thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#detail_tr').datagrid({
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
