<div id="UOM_toolbar">
	<form id="UOM_form_search" onsubmit="return false">
		Search : 
		<input type="text" size="12" name="code_or_name" class="easyui-validatebox" onkeypress="if(event.keyCode==13){UOM_search()}" />
		 
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="UOM_search()">Find</a> 
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="UOM_add()">Add</a> 
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="UOM_edit()">Edit</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="UOM_delete()">Delete</a>
	</form>
</div>
<table id="UOM"
	data-options="
       url:'<?php echo site_url('/master/UOM/get') ?>',
       method:'post',
       border:true,       
       title:'List UOM',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#UOM_toolbar'">
	<thead>
		<tr>
			<th field="id" width="90" halign="center" hidden="true"></th>
			<th field="code" width="90" halign="center">Kode</th>
			<th field="name" width="100" halign="center">Nama</th>
		</tr>
	</thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#UOM').datagrid({});
    });
</script>
