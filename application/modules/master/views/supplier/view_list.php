<div id="supplier_toolbar">
	<form id="supplier_form_search" onsubmit="return false">
		Supplier ID <input type="text" size="12" name="supplier_id"
			class="easyui-validatebox" onkeypress="if(event.keyCode==13){}" />
		 Nama Supplier<input type="text" size="12" name="nama"
			class="easyui-validatebox" onkeypress="if(event.keyCode==13){}" /><a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-search" plain="true" onclick="supplier_search()">Find</a>
		<a href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-add" plain="true" onclick="supplier_add()">Add</a> <a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-edit" plain="true" onclick="supplier_edit()">Edit</a> <a
			href="javascript:void(0)" class="easyui-linkbutton"
			iconCls="icon-remove" plain="true" onclick="supplier_delete()">Delete</a>
	</form>
</div>
<table id="supplier"
	data-options="
       url:'<?php echo site_url('master/supplier/get') ?>',
       method:'post',
       border:true,       
       title:'List supplier',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#supplier_toolbar'">
	<thead data-options="frozen:true">
		<tr>
			<th field="id" hidden="true"></th>
			<th field="supplier_id" width="100" halign="right" align="right">Supplier
				ID</th>
			<th field="nama" width="200" halign="center" align="left">Nama
				Supplier</th>
	
	</thead>
	<thead>
		<tr>
			<th field="npwp" width="100" halign="center" align="center">NPWP</th>
			<th field="telepon" width="150" halign="center" align="center">Telp</th>
			<th field="kontak_nama" width="200" halign="center" align="left">Kontak
				Nama</th>
			<th field="nomor_kontak" width="100" halign="center" align="center">Nomor Kontak</th>
			<th field="diskon" width="150" halign="center" align="right">Diskon
				Reguler (%)</th>
			<th field="diskon_promo" width="150" halign="center" align="right">Diskon
				Promo (%)</th>
			<th field="alamat" width="300" halign="center" align="center">Alamat</th>
			<th field="term_of_payment" width="50" halign="center" align="center">TOP</th>
			<th field="pkp" width="100" halign="center" align="center" data-options="formatter: function(value,row,index){
				if (value == 't'){
					return 'YA';
				} else {
					return 'TIDAK';
				}
			}">PKP Status</th>
		</tr>
	</thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#supplier').datagrid({
//             view: detailview,
            onCheck: function(index,row){
            },
            onSelect: function(index,row){
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
