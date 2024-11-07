<div id="accounts_menu_item_toolbar" style="padding-bottom: 2px;">            
    Name
    <input type="text" id="menu_item_name_ID" size="10" class="easyui-validatebox" name="name" onkeypress="if(event.keyCode==13){menu_item_search()}" />
    Code : 
    <input type="text" id="menu_item_code_ID" size="10" class="easyui-validatebox" name="name" onkeypress="if(event.keyCode==13){menu_item_search()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="menu_item_search()"> Search</a>
</div>
<table id="accounts_menu_item" data-options="
       url:'<?php echo site_url('accounts/menu_item/get_menu_items_with_pagination') ?>',
       method:'post',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [10, 30, 50, 70, 100, 200],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       toolbar:'#accounts_menu_item_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="name" width="150" halign="center">Menu Name</th>
            <th field="category_name" width="150" halign="center">Category/Module</th>
            <th field="code" width="200" halign="center">Code</th>
            <th field="icon_class" width="100" halign="center">Icon Class</th>
            <th field="permission_mask_code" width="300" halign="center">Permission</th>
            <th field="url_page" width="300" halign="center">URL Page</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
    	$('#accounts_menu_item').datagrid({});
    });

    function menu_item_search() {
	    var menu_item_name = $('#menu_item_name_ID').val();
	    var menu_item_code = $('#menu_item_code_ID').val();
	    $('#accounts_menu_item').datagrid('reload', {
	    	name : menu_item_name,
	    	code: menu_item_code
	    });
	}
</script>
