<div id="accounts_permission_mask_toolbar" style="padding-bottom: 2px;">            
    Permission Name : 
    <input type="text" id="permission_mask_code_ID" size="10" class="easyui-validatebox" name="name" onkeypress="if(event.keyCode==13){permission_mask_search()}" />
    Group Code
    <input type="text" id="permission_mask_group_code_ID" size="10" class="easyui-validatebox" name="name" onkeypress="if(event.keyCode==13){permission_mask_search()}" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="permission_mask_search()"> Search</a>
</div>
<table id="accounts_permission_mask" data-options="
       url:'<?php echo site_url('accounts/permission_mask/get_permission_masks_with_pagination') ?>',
       method:'post',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [10, 30, 50, 70, 100, 200],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       toolbar:'#accounts_permission_mask_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="code" width="300" halign="center">Code</th>
            <th field="description" width="500" halign="center">Description</th>
            <th field="group_code" width="200" halign="center">Group Code</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
    	$('#accounts_permission_mask').datagrid({});
    });

    function permission_mask_search() {
	    var permission_mask_code = $('#permission_mask_code_ID').val();
	    var permission_mask_group_code = $('#permission_mask_group_code_ID').val();
	    $('#accounts_permission_mask').datagrid('reload', {
	    	code: permission_mask_code,
	    	group_code : permission_mask_group_code
	    });
	}
</script>
