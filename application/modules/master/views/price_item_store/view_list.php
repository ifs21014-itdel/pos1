<div id="price_item_store_toolbar">
    <form id="price_item_store_form_search" onsubmit="return false">
        Search : <input type="text" size="18" name="search"
                        class="easyui-validatebox"
                        onkeypress="if (event.keyCode == 13) {
                                    price_item_store_search()
                                }"
                        /> 

        <select id="store_id" class="easyui-combobox" panelWidth="auto" panelHeight="auto" name= "store_id" data-options="onChange:function(n,o){price_item_store_search()}">
            <option value="">ALL</option>
            <?php
            foreach ($store as $result) {
                echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
            }
            ?>

        </select>
        <!--                         
        <!--  			<select id="store_id" class="easyui-combobox" panelWidth="auto" panelHeight="auto" name= "store_id" data-options="onChange:function(n,o){price_item_store_search()}"> -->
        <!-- 				<option value="">all</option> -->
        <!-- 				<option value="1">Net Paramount Plaza</option> -->
        <!-- 				<option value="2">Net SOHO Park</option> -->
        <!-- 			</select> -->
        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-search" plain="true" onclick="stock_item_search()"
           >Find</a> 
        <!--                        <a href="javascript:void(0)" class="easyui-linkbutton"
                                iconCls="icon-build" plain="true" onclick="store_paramount()"
                                >Net Paramount Plaza</a> 
                                <a href="javascript:void(0)" class="easyui-linkbutton"
                                iconCls="icon-build" plain="true" onclick="store_soho()"
                                >Net SOHO Park</a>  -->
        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-add" plain="true" onclick="price_item_store_add()"
           >Add New Price</a>
<!--        <a href="javascript:void(0)" class="easyui-linkbutton"
           iconCls="icon-edit" plain="true" onclick="price_item_store_edit()"
           >Edit</a>-->
    </form>
</div>
<table id="price_item_store"
       data-options="
       url:'<?php echo site_url('master/price_item_store/get_price_item_store_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'Price Item Store',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#price_item_store_toolbar'"
       >
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="sku" width="50" halign="center">SKU</th>
            <th field="barcode" width="100" halign="center">Barcode</th>
            <th field="item_name" width="200" halign="center">Nama</th>
            <th field="store_name" width="250" halign="center">Store</th>
            <th field="retail_price" width="150" halign="center" align="right" formatter="formatPrice">Price</th>
            <th field="cost" width="100" halign="center" align="right" formatter="formatPrice">Cost</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    var price_item_store_url = '';

    $(function () {
        $('#price_item_store').datagrid({});
    });

    function price_item_store_search() {
        $('#price_item_store').datagrid('reload', $('#price_item_store_form_search').serializeObject());
    }

//     function stock_item_bom(itemid) {
//         if ($('#stock_item_dialog')) {
//             $('#bodydata').append("<div id='stock_item_dialog'></div>");
//         }
//         $('#stock_item_dialog').dialog({
//             title: 'Bill Of Material',
//             width: 700,
//             height: 500,
//             closed: false,
//             cache: false,
//             href: base_url + '/master/Item/bom/' + itemid,
//             modal: true,
//             border:false,
//             resizable: true,
//             buttons: [
//                 {
//                     text: 'Close',
//                     iconCls: 'icon-remove',
//                     handler: function () {
//                         $('#item_dialog').dialog('close');
//                     }
//                 }
//             ],
//             onLoad: function () {
//                 $(this).dialog('center');
//                 $('#purchaserequest-input').form('clear');
//             }
//         });
//     }

//     function skuFormatter(value, row) {
//         var temp = value;
//         if (row.bom_status === 't') {
//             temp = '<a href="javascript:item_bom(' + row.id + ')">' + value + '</a>';
//         }
//         return temp;
//     }

    function price_item_store_input_form(type, title, row) {
        if ($('#price_item_store_dialog')) {
            $('#bodydata').append("<div id='price_item_store_dialog'></div>");
        }
        $('#price_item_store_dialog').dialog({
            title: title,
            width: 400,
            height: 'auto',
            href: base_url + '/master/price_item_store/input_form',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: (type === 'edit') ? 'Update' : 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        price_item_store_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#price_item_store_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                if (type === 'edit') {
                    var datas = [{item_id: row.item_id, name: row.item_name}];

                    // var data = [{item_id : 'sss',name : 'dddd'}];

                    setTimeout(function () {
                        $('#item_id').combobox('loadData', datas);
                        $('#item_id').combobox('select', row.item_name);
                        $('#item_id').combobox('setValue', row.item_id);
                    }, 1000);

                    $('#price_item_store_input_form').form('load', row);
                    // console.log(data);
//                     $('#item_id').combobox('loadData',data);
//                     $('#price_item_store_input_form').form('load', row);
//                 	 	$('#item_id').combobox('setText',row.item_name);

//                 	    $('#item_id').combobox({
//                 	        valueField:'id',
//                 	        textField:'text',
//      						data : datas
//                 	    });



                } else {
                    $('#price_item_store_input_form').form('clear');
                }

            }
        });
    }

    function price_item_store_add() {
        price_item_store_input_form('add', 'ADD New Price (kosongkan store untuk update semua store)', null);
        price_item_store_url = base_url + '/master/price_item_store/add_price_item_store';
    }

    function price_item_store_edit() {
        var row = $('#price_item_store').datagrid('getSelected');
        if (row !== null) {
            price_item_store_input_form('edit', 'Edit Item Price', row);
            price_item_store_url = base_url + '/master/price_item_store/update_price_item_store';
        } else {
            $.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
        }
    }

    function price_item_store_delete() {
        var row = $('#price_item_store').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
                if (r) {
                    $.post(base_url + '/master/price_item_store/delete_price_item_store', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#price_item_store').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('Warning', 'Please select at least 1 row to proceed', 'warning');
        }
    }

</script>
