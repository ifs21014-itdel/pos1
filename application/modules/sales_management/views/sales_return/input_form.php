<form id="sales_return_input_form" method="post" novalidate class="table_form">
	<input type="hidden" name="id">
	<table width="100%" border="0">
		<tr>
            <td width="30%">
                <strong>No Faktur / Struk</strong>
            </td>
            <td width="70%">
                <input class="easyui-combobox" name="sales_id" url="<?php echo site_url('sales_management/sales/get_data') ?>" method="post" 
                       valueField="id" textField="reference" style="width: 100%" required="true" mode="remote" panelHeight="200" 
                       data-options="onSelect: function(row){
				            $('#sales_return_item_id').combobox('reload', '<?php echo site_url('sales_management/sales_detail/get_data_by_sales_id') ?>?sales_id=' + row.id);
				        }"
			     />
            </td>
        </tr>
		<tr>
            <td width="30%">
                <strong>Item Name</strong>
            </td>
            <td width="70%">
                <input class="easyui-combobox" id="sales_return_item_id" name="item_id" url="<?php echo site_url('sales_management/sales_detail/get_data_by_sales_id') ?>" method="post" 
                       valueField="item_id" textField="item_name" style="width: 100%" required="true" mode="remote" panelHeight="200" 
                       data-options="onSelect: function(row){
                       console.log('row',row);
				            $('#sales_return_uom_id').combobox('setValue', row.uom_id);
				            $('#quantity_return_item').textbox('setText',row.quantity);
				            $('#quantity_return_item').textbox('setValue', row.quantity);
				            $('#price_return_item').textbox('setText', row.price_total);
				            $('#price_return_item').textbox('setValue', row.price_total);
				            
				            $('#quantity_return_item_default').val(row.quantity);
				            $('#price_return_item_default').val(row.price_total);
				        }"
			     />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Quantity</strong>
            </td>
            <td>
            	<input type="hidden" id="quantity_return_item_default">
                <input type="text" id="quantity_return_item" name='quantity' class="easyui-textbox" style="width: 10%" data-options="onChange:function(oldValue, newValue){
                	populateQuantity(newValue, oldValue);
                }"/>
            </td>
        </tr>
        <tr>
            <td>
                <strong>UOM</strong>
            </td>
            <td><input class="easyui-combobox" id="sales_return_uom_id" name="uom_id"
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
                <strong>Price</strong>
            </td>
            <td>
            	<input type="hidden" id="price_return_item_default">
                <input type="text" id="price_return_item" name='price' class="easyui-textbox" style="width: 40%" readonly/>
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
	function sales_return_save() {
		$('#sales_return_input_form').form('submit', {
			url : sales_return_url,
			onSubmit : function() {
				return $(this).form('validate');
			},
			success : function(content) {
				console.log(content);
				var result = eval('(' + content + ')');
				if (result.success) {
					$('#sales_return_dialog').dialog('close');
					$('#sales_return').datagrid('reload');
				} else {
					$.messager.alert('Error', result.msg, 'error');
				}
			}
		});
	}

	function populateQuantity(newValue, oldValue){
		console.log("oldValue: ", oldValue);
		console.log("newValue: ", newValue);
		
		if(newValue != undefined && newValue != ""){
			var quantity_default = parseInt( $('#quantity_return_item_default').val() );
			var price_default = parseInt( $('#price_return_item_default').val() );
	
			console.log("quantity_default: ", quantity_default);
			console.log("price_default: ", price_default);
			
			var new_quantity = parseInt(  $('#quantity_return_item').textbox("getValue") );
			var price = parseInt( $('#price_return_item').textbox("getValue") );
			var new_price = 0;
			if(new_quantity > 0 && new_quantity <= quantity_default){
				new_price = (price_default / quantity_default) * new_quantity;
				$('#quantity_return_item').textbox('setText',new_quantity);
		        $('#price_return_item').textbox('setValue',new_price);
			}else{
				$('#quantity_return_item').textbox('setText',quantity_default);
				$('#quantity_return_item').textbox('setValue',quantity_default);
				$('#price_return_item').textbox('setText',price_default);
		        $('#price_return_item').textbox('setValue',price_default);
				$.messager.alert('Warning','Quantity tidak boleh lebih kecil dari 0 dan lebih besar dari quantity yang telah di beli yaitu ['+quantity_default+']');				
			}
		}
	}

</script>