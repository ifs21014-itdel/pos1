<div id="gr_ts_toolbar">
	<form id="gr_ts_form_search" onsubmit="return false">
		Good Receive ID <input type="text" size="15" name="transfer_stock_code"
			class="easyui-validatebox" onkeypress="if(event.keyCode==13){}" />
			<a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-search" plain="true" onclick="gr_ts_search()">Find</a>
			<a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-download" plain="true" id="gr_ts_receive" onclick="gr_ts_receive()">Receive</a>  
			<a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-print" plain="true" id="gr_ts_print" onclick="gr_ts_print()">Print</a> 
	</form>
</div>
<table id="gr_ts"
	data-options="
       url:'<?php echo site_url('order_management/Good_receive_ts/get') ?>',
       method:'post',
       border:true,       
       title:'List Good Receive TS',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       idField:'id',
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#gr_ts_toolbar'">
	<thead>
		<tr>
			<th field="id" width="90" halign="center" hidden="true"></th>
			<th field="code" width="120" halign="center" >NO Transfer Stock</th>
			<th field="status" width="90" halign="center" align="center"data-options="formatter: function(value,row,index){
				if (value == '1'){
					return 'DRAFT';
				} if (value == '2'){
					return 'OPEN';
				} if (value == '3'){
					return 'RECEIVED';
				} else {
					return 'Cancel';
				}
				}">Status</th>
			<th field="store" width="150" halign="center" >Asal Toko</th>
			<th field="ship_date" width="150" halign="center" align="center">Tanggal Pengiriman</th>
			<th field="user_id" width="100" halign="center" align="center">Dikirim Oleh</th>
			<th field="dst_store" width="150" halign="center" >Dikirim ke</th>
			<th field="received_date" width="150" halign="center" align="center">Tanggal Penerimaan</th>
			<th field="received_name" width="100" halign="center" align="center">Diterima Oleh</th>
			<th field="dst_address" width="200" halign="center" >Alamat</th>
			
	</thead>
</table>

<script type="text/javascript">
    $(function() {
        $('#gr_ts').datagrid({
        	rowStyler: function(index, row){
        		if(row.status == '1'){
        			return 'background-color:#FFA1A1;color:#000;';
                }if(row.status == '2'){
        			return 'background-color:#A6FFA1;color:#000;';
                }
//                 else {
//                 	return 'background-color:#fff;color:#000;';
//                 }
        	},
//             view: detailview,
            onCheck: function(index,row){
            },
            onSelect: function(value, row, index){
            	$('#detail_gr_ts').datagrid('reload', {
            		stock_transfer_manifest_id : row.id
                });
                if ( row.status === '3') {
                    $('#gr_ts_receive').linkbutton('disable');
                    $('#gr_ts_print').linkbutton('enable');                      
                }else {// PO Open
                    $('#gr_ts_receive').linkbutton('enable');
                    $('#gr_ts_print').linkbutton('disable');  
                } 
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
