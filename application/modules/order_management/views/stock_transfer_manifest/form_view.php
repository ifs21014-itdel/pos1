<form id="stock_transfer_manifest_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr valign="top">
            <td width="50%">
                <table width="100%" border="0">
                        <!--<tr>
                                <td><strong>Transfer Stock ID</strong></td>
                                <td><input type="text" name='code' class="easyui-texbox" style="width: 98%" /></td>
                        </tr>-->
                    <tr>
                        <td><strong>Store Destination</strong></td>
                        <td>
                            <input class="easyui-combobox" name="store_destination" url="<?php echo site_url('/master/Store/get_store_exclude_self') ?>"
                                   method="post" valueField="id" textField="name" style="width: 100%" required="true" mode="remote" panelHeight="auto"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Ship Date</strong></td>
                        <td>
                            <input type="text" name='ship_date' data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width: 50%" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
<script>
    function stock_transfer_manifest_save() {
        $('#stock_transfer_manifest_form').form('submit', {
            url: stock_transfer_manifest_url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (content) {
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#stock_transfer_manifest_dialog').dialog('close');
                    $('#stock_transfer_manifest').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }
        });
    }
</script>