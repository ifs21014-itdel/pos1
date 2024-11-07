<div id="production_kitchen_detail_toolbar">
    <form id="production_kitchen_detail_form_search" onsubmit="return false">
        Search <input type="text" size="15" name="q"
                      class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                                  production_kitchen_detail_search()
                              }" />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="production_kitchen_detail_search()">Find</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id='production_kitchen_detail_edit' onclick="production_kitchen_detail_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" disabled='true' plain="true" id='production_kitchen_detail_save' onclick="production_kitchen_detail_save()">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id='production_kitchen_detail_delete' onclick="production_kitchen_detail_delete()">Delete</a>
    </form>
</div>
<table id="production_kitchen_detail"
       data-options="
       url:'<?php echo site_url('master/production_kitchen/detail_get') ?>',
       method:'post',
       border:true,       
       title:'Item Detail',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       idField:'id',
       pagination:false,
       striped:true,
       toolbar:'#production_kitchen_detail_toolbar'">
    <thead>
        <tr>
            <th field="sku" width="120" halign="center">SKU</th>
            <th field="name" width="300" halign="center">Nama Item</th>
            <th field="raw_quantity" width="100" align="center" data-options="editor:{type:'numberbox'}">Raw Qty</th>
            <th field="production_quantity" width="100" align="center" data-options="editor:{type:'numberbox'}">Production Qty</th>
            <th field="defect_quantity" width="100" align="center">Defect Qty</th>
            <th field="recipe_quantity" width="100" align="center">Recipe Qty</th>
            <th field="uom" width="100" align="center">Satuan</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#production_kitchen_detail').datagrid({
            onSelect: function (value, row, index) {
//                $('#production_kitchen_detail_detail').dataproduction_kitchen_detailid('reload', {
//                    good_receive_id: row.id
//                });
            }

        });
    });
</script>
