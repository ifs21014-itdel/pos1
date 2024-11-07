<form id="price_item_store_input_form" method="post" novalidate class="table_form">
    <input type="hidden" name="id">
	<table width="100%" border="0">
		<tr>
            <td width="30%">
                <strong>Item Name</strong>
            </td>
            <td width="70%">
                <input class="easyui-combobox" id="item_id" name="item_id" url="<?php echo site_url('master/item/get_data') ?>" method="post" 
                       valueField="id" textField="name" style="width: 100%" required="true" mode="remote" panelHeight="200" 
			     />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Store</strong>
            </td>
                <td width="70%">
                <input class="easyui-combobox" name="store_id" url="<?php echo site_url('master/store/get_stores') ?>" method="post" 
                       valueField="id" textField="name" style="width: 100%" mode="remote" panelHeight="auto" 
			     />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Retail Price</strong>
            </td>
            <td>
                <input type="text" name="retail_price" class="easyui-textbox" style="width: 40%" />
            </td>
        </tr>
         <tr>
            <td>
                <strong>Cost</strong>
            </td>
            <td>
                <input type="text" name="cost" class="easyui-textbox" style="width: 40%" />
            </td>
        </tr>
	</table>
</form>

<script>
	function price_item_store_save() {
		$('#price_item_store_input_form').form('submit', {
			url : price_item_store_url,
			onSubmit : function() {
				return $(this).form('validate');
			},
			success : function(content) {
				console.log(content);
				var result = eval('(' + content + ')');
				if (result.success) {
					$('#price_item_store_dialog').dialog('close');
					$('#price_item_store').datagrid('reload');
				} else {
					$.messager.alert('Error', result.msg, 'error');
				}
			}
		});
	}
</script>