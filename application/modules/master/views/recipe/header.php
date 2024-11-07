<div id="recipe_toolbar">
    <form id="recipe_form_search" onsubmit="return false">
        Search <input type="text" size="15" name="q"
                      class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                          recipe_search();
                              }" />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="recipe_search()">Find</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="recipe_add()">Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="recipe_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="recipe_delete()">Delete</a>
    </form>
</div>
<table id="recipe"
       data-options="
       url:'<?php echo site_url('master/recipe/get') ?>',
       method:'post',
       border:true,       
       title:'Recipe',
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
       toolbar:'#recipe_toolbar'">
    <thead>
        <tr>
            <th field="sku" width="80" halign="center">SKU</th>
            <th field="name" width="150" halign="center">Nama</th>
            <th field="description" width="300" halign="center">Deskripsi</th>
            <th field="material_cost" width="100" halign="center" align="right" formatter="formatPrice">Material Cost</th>
            <th field="packaging_cost" width="100" halign="center" align="right" formatter="formatPrice">Packing Cost</th>
            <th field="total_cost" width="100" halign="center" align="right" formatter="formatPrice">Total Cost</th>
            <th field="created_date" width="100" align="center" formatter="myFormatDate">Tanggal</th>
            <th field="shelf_life" width="150" halign="center">Shelf Life</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#recipe').datagrid({
            onSelect: function (value, row, index) {
                $('#recipe_detail').datagrid('reload', {
                    recipe_id: row.id
                });
            }

        });
    });
</script>
