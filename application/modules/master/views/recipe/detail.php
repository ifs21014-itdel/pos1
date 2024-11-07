<div id="recipe_detail_toolbar">
    <form id="recipe_detail_form_search" onsubmit="return false">
        Search <input type="text" size="15" name="q"
                      class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                          recipe_detail_search();
                              }" />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="recipe_detail_search()">Find</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="recipe_detail_add()">Add</a>  
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="recipe_detail_edit()">Edit</a>  
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="recipe_detail_delete()">Delete</a>
    </form>
</div>
<table id="recipe_detail"
       data-options="
       url:'<?php echo site_url('master/recipe/detail_get') ?>',
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
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#recipe_detail_toolbar'">
    <thead>
        <tr>
            <th field="type" width="100" halign="center" formatter="recipe_detail_type_format">Type</th>
            <th field="sku" width="120" halign="center">SKU</th>
            <th field="name" width="300" halign="center">Nama Item</th>
            <th field="quantity" width="100" align="center">Qty / Recipe</th>
            <th field="uom" width="100" align="center">Satuan</th>
            <th field="cost_per_unit" width="100" halign="center" align="right" formatter="formatPrice">Cost / Unit</th>
            <th field="price_cost" width="100" halign="center" align="right" formatter="formatPrice">Price Cost</th>
            <th field="status" width="100" align="center" formatter='recipe_detail_status_format'>Status</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#recipe_detail').datagrid({
            onSelect: function (value, row, index) {
//                $('#recipe_detail_detail').datarecipe_detailid('reload', {
//                    good_receive_id: row.id
//                });
            }

        });
    });

    function recipe_detail_status_format(val, row) {
        if (val === 't') {
            return 'Yes';
        } else {
            return 'No';
        }
    }
    
    function recipe_detail_type_format(value,row){
        if(value === '1'){
            return 'Material';
        }else if(value === '2'){
            return 'Sub Recipe';
        }else{
            return 'Packaging';
        }
    }
</script>
