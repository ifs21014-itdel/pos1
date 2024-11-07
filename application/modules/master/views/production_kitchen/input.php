<form id="production_kitchen_input_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td width="35%"><strong>Item</strong></td>
            <td width="65%">
                <input class="easyui-combobox" id="production_kitchen_item_list" name="item_id"
                       url="<?php echo site_url('master/recipe/get') ?>"
                       method="post" valueField="item_id" textField="name"
                       style="width: 100%" required="true" mode="remote" panelHeight="200"
                       data-options="onSelect:function(row){
                        console.log(row);
                        $('#production_kitchen_uom').textbox('setValue',row.uom);
                       }"/>
            </td>
        </tr>
        <tr>
            <td><strong>UoM</strong></td>
            <td>
                <input type="text" 
                       name='uom'
                       id="production_kitchen_uom"
                       class="easyui-textbox" 
                       readonly="true"  
                       style="width: 30%;" 
                       />
            </td>
        </tr>
        <tr>
            <td><strong>Qty</strong></td>
            <td>
                <input type="text" 
                       name='quantity'
                       class="easyui-textbox" 
                       required="true"  
                       style="width: 30%;" 
                       />
            </td>
        </tr>
        <tr>
            <td><strong>Chef</strong></td>
            <td>
                <input class="easyui-combobox" name="chef"
                       url="<?php echo site_url('accounts/user/get_data') ?>"
                       method="post" valueField="id" textField="first_name"
                       style="width: 100%" required="true" mode="remote" panelHeight="200"/>
            </td>
        </tr>
    </table>
</form>