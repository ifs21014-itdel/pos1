<form id="good_receive_detail_edit_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td width="35%"><strong>Item</strong></td>
            <td width="65%">
                <input type="hidden" name="id" />
                <input class="easyui-combobox" name="item_id"
                       url="<?php echo site_url('master/item/get_data') ?>"
                       method="post" valueField="id" textField="name"
                       style="width: 100%" required="true" mode="remote" panelHeight="200"
                       readonly=""/></td>
        </tr>
        <tr>
            <td><strong>UOM</strong></td>
            <td>
                <select class="easyui-combobox" name="uom_id" style="width:200px;" readonly>
                    <option value="1">PCS</option>
                    <option value="2">KG</option>
                    <option value="3">CTN</option>
                    <option value="4">INR</option>
                </select>
            </td>
        </tr>
        <tr>
            <td ><strong>Quantity</strong></td>
            <td><input type="text" name='quantity' class="easyui-textbox" required="true" groupSeparator="," style="width: 50%" /></td>
        </tr>
    </table>
</form>