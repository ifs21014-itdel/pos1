<form id="recipe_input_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td width="35%"><strong>Item</strong></td>
            <td width="65%">
                <input class="easyui-combobox" id="recipe_item_list" name="item_id"
                       url="<?php echo site_url('master/item/get_data') ?>"
                       method="post" valueField="id" textField="name"
                       style="width: 100%" required="true" mode="remote" panelHeight="200"/>
            </td>
        </tr>
        <tr>
            <td><strong>Deskripsi</strong></td>
            <td>
                <input type="text" 
                       name='description'
                       class="easyui-textbox" 
                       multiline="true" 
                       required="true"  
                       style="width: 100%;height: 45px" 
                       />
            </td>
        </tr>
        <tr>
            <td><strong>Shelf Life</strong></td>
            <td>
                <input type="text" 
                       name='shelf_life'
                       class="easyui-textbox"
                       required="true"  
                       style="width: 100%;" 
                       />
            </td>
        </tr>

    </table>
</form>