<form id="item_bom_input_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td width="35%"><strong>Item</strong></td>
            <td width="65%">
                <input class="easyui-combobox" id='item_id_89' name="raw_item_id"
                       url="<?php echo site_url('master/item/get_data') ?>"
                       method="post" valueField="id" textField="name"
                       style="width: 100%" required="true" mode="remote" panelHeight="200"
                       data-options="onSelect: function(row){
                       $('#item_price_id').textbox('setValue', row.cost);
                       }"/>
            </td>
        </tr>
        <tr>
            <td><strong>UoM</strong></td>
            <td>
                <select id="cc" class="easyui-combobox" name="uom_id" panelHeight='auto' style="width:100%;"
                        required="true">
                    <option value="1">PCS</option>
                </select>
            </td>
        </tr>
        <tr>
            <td ><strong>Quantity</strong></td>
            <td><input type="text" name='qty'
                       class="easyui-textbox" required="true" groupSeparator="," style="width: 100%" /></td>
        </tr>
    </table>
</form>