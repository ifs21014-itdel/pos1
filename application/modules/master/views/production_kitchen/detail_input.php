<form id="production_kitchen_detail_input_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td width="35%"><strong>Item</strong></td>
            <td width="65%">
                <input class="easyui-combobox" id='production_kitchen_detail_item_list' name="item_id"
                       url="<?php echo site_url('master/item/get_data') ?>"
                       method="post" valueField="id" textField="name"
                       style="width: 100%" required="true" mode="remote" panelHeight="200"
                       data-options="onSelect:function(row){
                       $('#uom_rd_input').textbox('setValue',row.uom_code);
                       //console.log(row);
                       }"/>
            </td>
        </tr>
        <tr>
            <td><strong>UoM</strong></td>
            <td>
                <input type="text" 
                       name='uom'
                       id='uom_rd_input'
                       class="easyui-textbox"
                       readonly="true"
                       style="width: 20%;" 
                       />
            </td>
        </tr>
        <tr>
            <td><strong>Qty</strong></td>
            <td>
                <input type="text" 
                       name='quantity'
                       class="easyui-numberbox"
                       required="true"
                       precision="2"
                       groupSeparator=","
                       decimalSeparator="."
                       style="width: 50%;" 
                       />
            </td>
        </tr>
        <tr>
            <td><strong>Status Active</strong></td>
            <td>
                <select name="status" style="width: 50%" class="easyui-combobox" panelHeight="auto" required="true">
                    <option value="t">Yes</option>
                    <option value="f">No</option>
                </select>
            </td>
        </tr>
    </table>
</form>