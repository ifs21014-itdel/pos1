<div id="stock_item_toolbar">
    <form id="stock_item_form_search" onsubmit="return false">
        Search : <input type="text" size="18" name="search"
                        class="easyui-validatebox"
                        onkeypress="if (event.keyCode == 13) {
                        	stock_item_search()
                                }"
                        /> 
			<select id="store_id" class="easyui-combobox" panelWidth="auto" panelHeight="auto" name= "store_id" data-options="onChange:function(n,o){stock_item_search()}">
				<option value="">ALL</option>
				<?php 
				foreach ($store as $result){
					echo "<option value='".$result->id."'>".$result->name."</option>";
				}
				?>
				
			</select>
                      <a href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-search" plain="true" onclick="stock_item_search()"
                        >Find</a> 
<!--                        <a href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-build" plain="true" onclick="store_paramount()"
                        >Net Paramount Plaza</a> 
                        <a href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-build" plain="true" onclick="store_soho()"
                        >Net SOHO Park</a> 
                       <a href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-add" plain="true" onclick="item_add()"
                        >Add</a><a href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-edit" plain="true" onclick="item_edit()"
                        >Edit</a> -->
<!--                          <a href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-remove" plain="true" onclick="item_delete()"
                        >Delete</a> -->
    </form>
</div>
<table id="stock_item"
       data-options="
       url:'<?php echo site_url('master/stock_item/get_stock_item_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List Stock Item',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#stock_item_toolbar'"
       >
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="sku" width="50" halign="center">SKU</th>
            <th field="barcode" width="100" halign="center">Barcode</th>
            <th field="item_name" width="200" halign="center">Nama</th>
            <th field="store_name" width="250" halign="center" align="center">Store</th>
            <th field="stock" width="150" halign="center" align="right">Stock</th>
            <th field="minimum" width="100" halign="center" align="right">Minimum</th>
            <th field="maximum" width="100" halign="center" align="right">Maximum</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    var stock_item_url = '';

    $(function () {
        $('#stock_item').datagrid({});
    });

    function stock_item_search() {
        $('#stock_item').datagrid('reload', $('#stock_item_form_search').serializeObject());
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

//     function item_input_form(type, title, row) {
//         if ($('#item_dialog')) {
//             $('#bodydata').append("<div id='item_dialog'></div>");
//         }
//         $('#item_dialog').dialog({
//             title: title,
//             width: 600,
//             height: 'auto',
//             href: base_url + '/master/item/input_form',
//             modal: false,
//             resizable: false,
//             shadow: false,
//             buttons: [{
//                     text: (type === 'edit') ? 'Update' : 'Save',
//                     iconCls: 'icon-save',
//                     handler: function () {
//                         item_save();
//                     }
//                 }, {
//                     text: 'Close',
//                     iconCls: 'icon-remove',
//                     handler: function () {
//                         $('#item_dialog').dialog('close');
//                     }
//                 }],
//             onLoad: function () {
//                 $(this).dialog('center');
//                 if (type === 'edit') {
//                     $('#item_input_form').form('load', row);
//                     $('#cat1').combo('readonly', true);
//                     $('#cat2').combo('readonly', true);
//                     $('#cat3').combo('readonly', true);
//                     $('#cat4').combo('readonly', true);
//                 } else {
//                     $('#item_input_form').form('clear');
//                 }

//             }
//         });
//     }

//     function item_add() {
//         item_input_form('add', 'ADD Item', null);
//         item_url = base_url + '/master/item/add_item';
//     }

//     function item_edit() {
//         var row = $('#item').datagrid('getSelected');
//         if (row !== null) {
//             item_input_form('edit', 'Edit Item', row);
//             item_url = base_url + '/master/item/update_item';
//         } else {
//             $.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
//         }
//     }

//     function item_delete() {
//         var row = $('#item').datagrid('getSelected');
//         if (row !== null) {
//             $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
//                 if (r) {
//                     $.post(base_url + '/master/item/delete_item', {
//                         id: row.id
//                     }, function (result) {
//                         console.log(result.success);
//                         if (result.success) {
//                             $('#item').datagrid('reload');
//                         } else {
//                             $.messager.alert('Error', result.msg, 'error');
//                         }
//                     }, 'json');
//                 }
//             });
//         } else {
//             $.messager.alert('Warning', 'Please select at least 1 row to proceed', 'warning');
//         }
//     }

</script>
