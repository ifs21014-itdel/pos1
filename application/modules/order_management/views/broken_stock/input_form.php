<form id="broken_stock_input_form" method="post" novalidate class="table_form">
	<input type="hidden" name="id">
	<table width="100%" border="0">
		<tr>
            <td width="30%">
                <strong>Item Name</strong>
            </td>
            <td width="70%">
                <input class="easyui-combobox" name="item_id" url="<?php echo site_url('master/item/get_data') ?>" method="post" 
                       valueField="id" textField="name" style="width: 100%" required="true" mode="remote" panelHeight="200" 
                       data-options="onSelect: function(row){
				            $('#brk_stock_uom_id').combobox('setValue', row.uom_id);
				        }"
			     />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Quantity</strong>
            </td>
            <td>
                <input type="text" name='quantity' class="easyui-textbox" style="width: 40%" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>UOM</strong>
            </td>
            <td><input class="easyui-combobox" id="brk_stock_uom_id" name="uom_id"
				url="<?php echo site_url('master/UOM/get') ?>"
				method="post" valueField="id" textField="code"
				readonly="readonly"
				data-options="formatter: unitformat"
				style="width: 50%" required="true" mode="remote" panelHeight="auto"/>
				<script type="text/javascript">
                    function unitformat(row) {
                        return '<span style="font-weight:bold;">' + row.code + '</span><br/>' +
                                '<span style="color:#888">Desc: ' + row.name + '</span>';
                    }
                </script>
            </td>
        </tr>
         <tr>
            <td>
                <strong>Description</strong>
            </td>
            <td>
                <input data-options="multiline:true" name='description' class="easyui-textbox" style="width:90%;height:50px" />
            </td>
        </tr>
	</table>
</form>

<script>
	function broken_stock_save() {
		$('#broken_stock_input_form').form('submit', {
			url : broken_stock_url,
			onSubmit : function() {
				return $(this).form('validate');
			},
			success : function(content) {
				console.log(content);
				var result = eval('(' + content + ')');
				if (result.success) {
					$('#broken_stock_dialog').dialog('close');
					$('#broken_stock').datagrid('reload');
				} else {
					$.messager.alert('Error', result.msg, 'error');
				}
			}
		});
	}
</script>