<form id="stock_transfer_manifest_item_form" method="post" novalidate class="table_form">
    <input type="hidden" name="id" id="id">
    <input type="hidden" name="stock_transfer_manifest_id" id="stock_transfer_manifest_id">
    <table width="100%" border="0">
        <tr>
            <td width="30%">
                <strong>Item Name</strong>
            </td>
            <td width="70%">
                <input class="easyui-combobox" name="item_id" url="<?php echo site_url('master/item/get_data') ?>" method="post" 
                       valueField="id" textField="name" style="width: 100%" required="true" mode="remote" panelHeight="200" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Quantity</strong>
            </td>
            <td>
                <input type="text" name='quantity' class="easyui-textbox" style="width: 80%" />
            </td>
        </tr>
    </table>
</form>
<script>
    function stock_transfer_manifest_item_save() {
        $('#stock_transfer_manifest_item_form').form('submit', {
            url: stock_transfer_manifest_item_url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (content) {
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#stock_transfer_manifest_item_dialog').dialog('close');
                    $('#stock_transfer_manifest_item').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }
        });
    }
</script>