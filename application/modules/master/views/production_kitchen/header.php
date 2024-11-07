<div id="production_kitchen_toolbar">
    <form id="production_kitchen_form_search" onsubmit="return false">
        Search <input type="text" size="15" name="q"
                      class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                                  production_kitchen_search();
                              }" />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="production_kitchen_search()">Find</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="production_kitchen_add()">Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id='production_kitchen_confirm' plain="true" onclick="production_kitchen_confirm()">Confirm</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id='production_kitchen_delete' plain="true" onclick="production_kitchen_delete()">Delete</a>
    </form>
</div>
<table id="production_kitchen"
       data-options="
       url:'<?php echo site_url('master/production_kitchen/get') ?>',
       method:'post',
       border:true,       
       title:'Production Kitchen',
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
       toolbar:'#production_kitchen_toolbar'">
    <thead>
        <tr>
            <th field="sku" width="120" halign="center">SKU</th>
            <th field="name" width="200" halign="center">Nama</th>
            <th field="quantity" width="80" align="center">Qty</th>
            <th field="uom" width="70" halign="center">UoM</th>
            <th field="first_name" width="150" halign="center">Chef</th>
            <th field="created_date" width="100" align="center" formatter="myFormatDate">Tanggal</th>
            <th field="confirm" width="150" halign="center" formatter="production_kitchen_status_format">Status</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#production_kitchen').datagrid({
            onSelect: function (value, row, index) {
                $('#production_kitchen_detail').datagrid('reload', {
                    production_kitchen_id: row.id
                });
                if (row.confirm === 'f') {
                    $('#production_kitchen_confirm').linkbutton('enable');
                    $('#production_kitchen_detail_edit').linkbutton('enable');
                    $('#production_kitchen_detail_delete').linkbutton('enable');
                    $('#production_kitchen_delete').linkbutton('enable');

                } else {
                    $('#production_kitchen_confirm').linkbutton('disable');
                    $('#production_kitchen_detail_edit').linkbutton('disable');
                    $('#production_kitchen_detail_delete').linkbutton('disable');
                    $('#production_kitchen_delete').linkbutton('disable');
                }
                $('#production_kitchen_detail_save').linkbutton('disable');
            },
            rowStyler: function (index, row) {
                if (row.confirm === 'f') {
                    return 'background-color:#FFA1A1;';
                }
            }

        });
    });

    function production_kitchen_status_format(value, row) {
        if (value === 'f') {
            return 'Draft';
        } else {
            return 'Confirm';
        }
    }
</script>
