<div id="transfer_stock_request_toolbar">
    <form id="transfer_stock_request_form_search" onsubmit="return false">
        Search : <input type="text" size="12" name="q"
                        class="easyui-validatebox" onkeypress="if (event.keyCode === 13) {
                                    transfer_stock_request_search()
                                }" /> 
        Type : 
        <select name='type' class="easyui-combobox" style="width: 100px" 
                panelHeight='auto' editable='false' data-options='onSelect:function(rec){transfer_stock_request_search()}'>
            <option value="">All</option>
            <option value="incoming">Incoming</option>
            <option value="outgoing">Outgoing</option>
        </select>
        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-search" plain="true" onclick="transfer_stock_request_search()">Find</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-add" plain="true" onclick="transfer_stock_request_add()">Add</a>

        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-edit" plain="true" onclick="transfer_stock_request_edit()">Edit</a>

        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-remove" plain="true" onclick="transfer_stock_request_delete()">Delete</a>

        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-arrow-up" plain="true" onclick="transfer_stock_request_confirm()">Confirm</a>

        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-upload" plain="true" onclick="transfer_stock_request_upload()">Upload</a>

        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-transfer" plain="true" onclick="transfer_stock_create_transfer()">Transfer</a>

    </form>
</div>
<table id="transfer_stock_request"
       data-options="
       url:'<?php echo site_url('/order_management/transfer_stock_request/get') ?>',
       method:'post',
       border:true,       
       title:'Transfer Stock Request',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       idField:'id',
       toolbar:'#transfer_stock_request_toolbar'">
    <thead>
        <tr>
            <th field="code" width="120" halign="center" >ID</th>
            <th field="store_source_name" width="150" halign="center" >Request To</th>
            <th field="store_destination_name" width="150" halign="center" >Destination</th>
            <th field="request_by" width="150" halign="center">Request By</th>
            <th field="description" width="250" halign="center" >Description</th>
            <th field="expected_receive_date" width="100" halign="center" formatter="myFormatDate" align="center">Exp. Receive Date</th>
            <th field="created_date" width="100" halign="center" formatter="myFormatDateTime">Input Time</th>
            <th field="status" width="50" halign="center" data-options="formatter:function(val,row){if(val==='0'){return 'Draft';}else{return 'Cofirm';}}">Status</th>
            <th field="is_synchronized" width="100" halign="center" data-options="formatter:function(val,row){if(val==='t'){return 'SYNCRONIZE';}else{return 'NOT SYNC';}}">SYN Status</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    var my_store_id = '<?php echo $store_id ?>';
    $(function () {
        $('#transfer_stock_request').datagrid({
            onSelect: function (value, row, index) {
                $('#transfer_stock_request_detail').datagrid('reload', {
                    transfer_stock_request_id: row.id
                });
                if (row.status === '1') {
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_edit()"]').linkbutton('disable');
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_delete()"]').linkbutton('disable');
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_confirm()"]').linkbutton('disable');

                    $('#transfer_stock_request_detail_form_search a[onclick="transfer_stock_request_detail_add()"]').linkbutton('disable');
                    $('#transfer_stock_request_detail_form_search a[onclick="transfer_stock_request_detail_edit()"]').linkbutton('disable');
                    $('#transfer_stock_request_detail_form_search a[onclick="transfer_stock_request_detail_delete()"]').linkbutton('disable');
                    if (row.is_synchronized === 't') {
                        $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_upload()"]').linkbutton('disable');
                    } else {
                        $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_upload()"]').linkbutton('enable');
                    }
                } else {
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_upload()"]').linkbutton('disable');
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_edit()"]').linkbutton('enable');
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_delete()"]').linkbutton('enable');
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_confirm()"]').linkbutton('enable');

                    $('#transfer_stock_request_detail_form_search a[onclick="transfer_stock_request_detail_add()"]').linkbutton('enable');
                    $('#transfer_stock_request_detail_form_search a[onclick="transfer_stock_request_detail_edit()"]').linkbutton('enable');
                    $('#transfer_stock_request_detail_form_search a[onclick="transfer_stock_request_detail_delete()"]').linkbutton('enable');
                }

                if (row.store_destination_id === my_store_id) {
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_create_transfer()"]').linkbutton('disable');
                    if (row.status === '1') {
                        if (row.is_synchronized === 't') {
                            $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_upload()"]').linkbutton('disable');
                        } else {
                            $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_upload()"]').linkbutton('enable');
                        }
                    }
                } else {
//                    console.log('tes');
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_edit()"]').linkbutton('disable');
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_delete()"]').linkbutton('disable');
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_confirm()"]').linkbutton('disable');

                    $('#transfer_stock_request_detail_form_search a[onclick="transfer_stock_request_detail_add()"]').linkbutton('disable');
                    $('#transfer_stock_request_detail_form_search a[onclick="transfer_stock_request_detail_edit()"]').linkbutton('disable');
                    $('#transfer_stock_request_detail_form_search a[onclick="transfer_stock_request_detail_delete()"]').linkbutton('disable');
                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_request_upload()"]').linkbutton('disable');

                    $('#transfer_stock_request_form_search a[onclick="transfer_stock_create_transfer()"]').linkbutton('enable');
                }
            },
            rowStyler: function (index, row) {
                if (row.status === '0') {
                    return 'background-color:#FFA1A1;color:#000;';
                }
            }
        });
    });
</script>
