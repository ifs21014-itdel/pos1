<form id="transfer_stock_request_detail_input_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td width="30%">
                <strong>Item Name</strong>
            </td>
            <td width="70%">
                <input type="hidden" name="id" id="id">
                <input class="easyui-combobox" id="transfer_stock_request_detail_item_list" name="item_id" url="<?php echo site_url('master/item/get_data') ?>" method="post" 
                       valueField="id" textField="name" style="width: 100%" required="true" mode="remote" panelHeight="200" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Quantity</strong>
            </td>
            <td>
                <input type="text" name='quantity' class="easyui-numberbox" precision="5" style="width: 50%" />
            </td>
        </tr>
    </table>
</form>