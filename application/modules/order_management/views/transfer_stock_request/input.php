<form id="transfer_stock_request_input_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td width="35%"><strong>Request to Store</strong></td>
            <td width="65%">
                <input class="easyui-combobox" name="store_source_id" url="<?php echo site_url('/master/Store/get_store_exclude_self') ?>"
                       method="post" valueField="id" textField="name" style="width: 100%" required="true" mode="remote" panelHeight="auto"/>
            </td>
        </tr>
        <tr>
            <td><strong>Expected Receive Date</strong></td>
            <td>
                <input type="text" 
                       name='expected_receive_date'
                       class="easyui-datebox"
                       required="true"  
                       style="width: 100%;" 
                       data-options="formatter:myformatter,parser:myparser"
                       />
            </td>
        </tr>

        <tr>
            <td><strong>Description</strong></td>
            <td>
                <input type="text" 
                       name='description'
                       class="easyui-textbox" 
                       multiline="true" 
                       required="true"  
                       style="width: 100%;height: 60px" 
                       />
            </td>
        </tr>

    </table>
</form>