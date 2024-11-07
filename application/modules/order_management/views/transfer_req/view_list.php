<div id="transfer_req_toolbar">
    <form id="transfer_req_form_search" onsubmit="return false">
        No Transfer Request : <input type="text" size="12" name="no_tr"
                                     class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                                }" /> <a
                                     href="javascript:void(0)" class="easyui-linkbutton"
                                     iconCls="icon-search" plain="true" onclick="transfer_req_search()">Find</a> <a
                                     href="javascript:void(0)" class="easyui-linkbutton"
                                     iconCls="icon-add" plain="true" onclick="transfer_req_add()">Add</a>
        <a
            href="javascript:void(0)" class="easyui-linkbutton"
            iconCls="icon-print" plain="true" onclick="transfer_req_print()">Print</a> 
    </form>
</div>
<table id="transfer_req"
       data-options="
       url:'<?php echo site_url('/master/transfer_req/get') ?>',
       method:'post',
       border:true,       
       title:'List Transfer Request',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#transfer_req_toolbar'">
    <thead>
        <tr>
            <th field="id" width="90" halign="center" hidden="true"></th>
            <th field="store_requester" width="120" halign="center" >Id TR</th>
            <th field="user_requester" width="90" halign="center" >Store Requester</th>
            <th field="request_to_store" width="90" halign="center" align="center">User Requester</th>
            <th field="request_to_store" width="90" halign="center" >Request TO</th>
            <th field="date_received_est" width="120" halign="center" align="center">Tanggal Pengiriman</th>
            <th field="date_received_est" width="120" halign="center" >Time Stamp</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#transfer_req').datagrid({
//          view: detailview,
            onCheck: function (index, row) {
            },
            onSelect: function (index, row) {
                $('#detail_tr').datagrid('reload', {
                    id: row.id
                });
//              if (row.status === '0' || row.status === '2' || row.status === '3') {//New PO
//                  if(row.status === '0' || row.status === '3'){
//                      $('#po_open').linkbutton('enable');
//                  }else{
//                      $('#po_open').linkbutton('disable');
//                  }
//                  $('#po_close').linkbutton('disable');                    
//              }else if (row.status === '1') {// PO Open
//                  $('#po_close').linkbutton('enable');
//                  $('#po_open').linkbutton('disable');
//              } 
            },
//             onSelect: function(index,row){
//             },
//             onUnselect: function(index,row){
//             },
//             onSelectAll : function(row){
//             },
//             onUnselectAll : function(row){
//             },
            detailFormatter: function (rowIndex, rowData) {
                return '<table><tr>' +
                        '<td style="vertical-align: text-top; padding: 10px;">Remark <span style="font-style: italic;font-size: 10px;">(*optional)</span></td><td style="border:0">' +
                        '<textarea data-id="' + rowData.sku + '" data-name="approval-remark" rows="2" cols="80" name="remark[]"></textarea>' +
                        '</td>' +
                        '</tr></table>';
            }

        });
    });
</script>
