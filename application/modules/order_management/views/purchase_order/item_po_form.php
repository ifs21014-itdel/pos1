<form id="item_po_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td width="35%"><strong>Item</strong></td>
            <td width="65%">
                <input class="easyui-combobox" id='item_id_89' name="item_id"
                       url="<?php echo site_url('master/item/get_data') ?>"
                       method="post" valueField="id" textField="name"
                       style="width: 100%" required="true" mode="remote" panelHeight="200"
                       data-options="onSelect: function(row){
				            $('#item_price_id').textbox('setValue', row.cost);
				        }"/></td>
        </tr>
        <tr>
            <td><strong>UoM</strong></td>
            <td>
                <select id="cc" class="easyui-combobox" name="uom_id" panelHeight='auto' style="width:100%;"
                        required="true" data-options="onSelect:function(row){
                            //console.log('Uom: '+n);
                            if(row.value === '3'){
                                var item_id = $('#item_id_89').combobox('getValue');
                                var row_item = $('#item_id_89').combobox('getData');
                                $.each(row_item, function (index, row) {
                                    console.log(row);
                                    if(item_id === row.id){
                                        $('#unit_conversion_').val(row.carton);
                                    }
                                });
                            }else if(row.value === '4'){
                                var item_id_ = $('#item_id_89').combobox('getValue');
                                var row_item_ = $('#item_id_89').combobox('getData');
                                $.each(row_item_, function (index, row) {
                                    console.log(row);
                                    if(item_id_ === row.id){
                                        $('#unit_conversion_').val(row.inner);
                                    }
                                });
                            }else{
                                $('#unit_conversion_').val(1);
                                console.log(1);
                            }
                        }">
                    <option value="1">PCS</option>
                    <option value="2">KG</option>
                    <option value="3">CTN</option>
                    <option value="4">INR</option>
                </select>
            </td>
        </tr>
        <tr>
            <td ><strong>Conversion Unit</strong></td>
            <td><input type="text" name='unit_conversion'
                       class="easyui-validatebox" id='unit_conversion_' style="width:30px" readonly=""/></td>
        </tr>
        <tr>
            <td ><strong>Quantity</strong></td>
            <td><input type="text" name='quantity'
                       class="easyui-numberbox" required="true" groupSeparator="," style="width: 100%" /></td>
        </tr>
        <tr>
            <td><strong>Price</strong></td>
            <td><input type="text" id="item_price_id" name='price'
                       class="easyui-numberbox" required="true" decimalSeparator="." groupSeparator=","  style="width: 100%" /></td>
        </tr>
           <tr>
            <td><strong>TRADE STATUS</strong></td>
            <td> <select id="ts" class="easyui-combobox" name="ts_id" panelHeight='auto' style="width:100%;"required="true" editable="false">
                    <option value="TRADE" >TRADE</option>
                    <option value="NON TRADE">NON TRADE</option>
                </select>
            </td>
        </tr>
    </table>
</form>