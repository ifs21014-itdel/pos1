<form id="goodreceive_input_form" method="post" novalidate style="margin: 3px;">
    <table width="100%" class="table_form">
        <tr>
            <td width="30%"><strong>Tanggal </strong></td>
            <td width="70%">
                <input type="text" size="15" class="easyui-datebox" required="true" name="date" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr>
        <tr>
            <td ><strong>Vendor </strong></td>
            <td>
                <input type="text" 
                       name="vendor_id" 
                       panelWidth="300" 
                       class="easyui-combobox" 
                       data-options="
                       valueField: 'id',
                       textField: 'vendor_name',
                       url: '<?php echo site_url('order_management/Purchase_order/get_vendor_ots_delivery') ?>'" 
                       mode="remote" 
                       style="width: 100%"
                       panelHeight="250"
                       />

        </tr>
        <tr>
            <td ><strong>No. Surat Jalan </strong></td>
            <td><input type="text" class="easyui-validatebox" name="no_sj"  required="true" style="width: 300px"/></td>
        </tr>
        <tr>
            <td ><strong>Tanggal Surat Jalan </strong></td>
            <td>
                <input type="text" size="15" class="easyui-datebox" name="do_date" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr>
        <tr>
            <td ><strong>Keterangan</strong></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width:100%;height: 40px"></textarea>
            </td>
        </tr>            
    </table>        
</form>