<form id="stock_transfer_manifest_item_form_barcode" method="post" novalidate class="table_form">
    <input type="hidden" name="id" id="id">
    <input type="hidden" name="stock_transfer_manifest_id" id="stock_transfer_manifest_id">
    <table width="100%" border="0">
        <tr>
            <td width="30%">
                <strong>Barcode</strong>
            </td>
            <td width="70%">
                <input class="easyui-validatebox" onkeypress="javascript:if(event.keyCode == 13)barcode_item_search(this.value)" name="barcode" id="barcode" style="width: 40%" required="true"/>
            </td> 
        </tr>
        <tr>
            <td width="30%">
                <strong>Item Name</strong>
            </td>
            <td width="70%">
                <input class="easyui-textbox" name="item_id" id="item_id_barcode" method="post" valueField="id" textField="name" style="width: 100%" required="true" mode="remote"readonly="readonly"/>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Quantity</strong>
            </td>
            <td>
                <input type="text" name='quantity' id="qty" class="easyui-textbox" style="width: 40%" />
            </td>
        </tr>
    </table>
</form>
<script>
	var res;
	function barcode_item_search(key){
		//barcode_item_url = base_url + '/master/item/get_data';
		//console.log("asdfasdfasd:",key);
		 $.post(base_url + '/master/item/get_data_by_barcode', {
			 barcode : key
         }, function (result) {
        	 res = result;
        	 console.log("res: ",res[0]);
        	 
             //console.log("result.success: ",result.success);
             if (typeof res[0] === "undefined") {
            	 $.messager.alert('Error', 'NO DATA', 'error');
            	 $('#item_id_barcode').textbox('setValue','');
             } else {
            	 $('#item_id_barcode').textbox('setValue',res[0].id);
            	 $('#item_id_barcode').textbox('setText',res[0].name);
             }
         }, 'json');
	}
	
    function stock_transfer_manifest_item_save_barcode() {
        $('#stock_transfer_manifest_item_form_barcode').form('submit', {
            url: stock_transfer_manifest_item_barcode_url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (content) {
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#stock_transfer_manifest_item_dialog_barcode').dialog('close');
                    $('#stock_transfer_manifest_item').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }
        });
    }
</script>