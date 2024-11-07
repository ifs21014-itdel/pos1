<div id="item_toolbar">
    <form id="item_form_search" onsubmit="return false">
        Search : <input type="text" size="12" name="search"
                        class="easyui-validatebox"
                        onkeypress="if (event.keyCode == 13) {
                                    item_search()
                                }"
                        /> 
            <select id="status_sku" class="easyui-combobox" panelHeight="auto" name= "status_sku" data-options="onChange:function(n,o){item_search()}">
				<option value="">ALL</option>
				<option value="ACTIVE">ACTIVE</option>
				<option value="INACTIVE">INACTIVE</option>
				<option value="DISCONTINUE">DISCONTINUE</option>
			</select>
			
			<a href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-search" plain="true" onclick="item_search()"
                        >Find</a> <a href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-add" plain="true" onclick="item_add()"
                        >Add</a><a href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-edit" plain="true" onclick="item_edit()"
                        >Edit</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" id="export_excel" plain="true" onclick="export_to_excel()">Export to Excel</a>

<!--                          <a href="javascript:void(0)" class="easyui-linkbutton"
                        iconCls="icon-remove" plain="true" onclick="item_delete()"
                        >Delete</a> -->
    </form>
</div>
<table id="item"
       data-options="
       url:'<?php echo site_url('master/item/get_item_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List Item',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       striped:true,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#item_toolbar'"
       >
    <thead data-options="frozen:true">
        <tr>
            <th field="id" hidden="true"></th>
            <th field="sku" width="50" halign="center" formatter="skuFormatter">SKU</th>
            <th field="barcode" width="100" halign="center">Barcode</th>
            <th field="name" width="200" halign="center">Nama</th>
        </tr>
    </thead>
    <thead>
        <tr>
            <th field="unit_code" width="50" halign="center" align="center">Satuan</th>
            <th field="cost" width="150" halign="center" align="right"
                formatter="formatPrice"
                >Harga Pokok Pembelian</th>
            <th field="retail_price" width="100" halign="center" align="right" formatter="formatPrice">Harga
                Jual</th>
            <th field="trading_price" width="100" halign="center" align="right" formatter="formatPrice">Trading
                Price</th>
            <th field="type" width="50" halign="center" align="center"
                data-options="formatter: function(value,row,index){
                if (value == '1'){
                return 'Retail';
                } else if (value == '2') {
                return 'Material';
                } else {
                return 'Trading';
                }
                }"
                >Type</th>
            <th field="gp" width="50" halign="center" align="center">GP (%)</th>
            <th field="bkp" width="50" halign="center" align="center">BKP</th>
            <th field="bom_status" width="50" halign="center" align="center" 
                data-options="formatter: function(value,row,index){
                if (value == 'f'){
                return 'NO';
                } else{
                return 'YES';
                }
                }"	
                >BOM ?</th>
            <th field="carton" width="50" halign="center" align="center">CARTON</th>
            <th field="inner" width="50" halign="center" align="center">INNER</th>
            <th field="category1_name" width="100" halign="center" align="center">Kategori
                1</th>
            <th field="category2_name" width="150" halign="center" align="center">Kategori
                2</th>
            <th field="category3_name" width="150" halign="center" align="center">Kategori
                3</th>
            <th field="category4_name" width="150" halign="center" align="center">Kategori
                4</th>
            <th field="status_sku" width="150" halign="center" align="center">Status SKU</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    var item_url = '';
    var editItemFlag = "";

    $(function () {
        $('#item').datagrid({});
    });

    function item_search() {
        $('#item').datagrid('reload', $('#item_form_search').serializeObject());
    }

    function item_bom(itemid) {
        if ($('#item_dialog')) {
            $('#bodydata').append("<div id='item_dialog'></div>");
        }
        $('#item_dialog').dialog({
            title: 'Bill Of Material',
            width: 700,
            height: 500,
            closed: false,
            cache: false,
            href: base_url + '/master/Item/bom/' + itemid,
            modal: true,
            border:false,
            resizable: true,
            buttons: [
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#item_dialog').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $(this).dialog('center');
                $('#purchaserequest-input').form('clear');
            }
        });
    }

    function skuFormatter(value, row) {
        var temp = value;
        if (row.bom_status === 't') {
            temp = '<a href="javascript:item_bom(' + row.id + ')">' + value + '</a>';
        }
        return temp;
    }

    function item_input_form(type, title, row) {
    	editItemFlag = type;
        if ($('#item_dialog')) {
            $('#bodydata').append("<div id='item_dialog'></div>");
        }
        $('#item_dialog').dialog({
            title: title,
            width: 600,
            height: 'auto',
            href: base_url + '/master/item/input_form',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: (type === 'edit') ? 'Update' : 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        item_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#item_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
//                 $('#item_input_form').form('load', row);
                if (type != 'edit') {
                   $('#item_input_form').form('clear');
                }

            }
        });
    }

    function item_add() {
        item_input_form('add', 'ADD Item', null);
        item_url = base_url + '/master/item/add_item';
    }

    function item_edit() {
        var row = $('#item').datagrid('getSelected');
        if (row !== null) {
            item_input_form('edit', 'Edit Item', row);
            item_url = base_url + '/master/item/update_item';
        } else {
            $.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
        }
    }
    
    function export_to_excel() {
        //$.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
        //item_input_form('edit', 'Edit Item', row);
        window.location = (base_url + '/master/Item/export_to_excel');
    }
    
    

    function item_delete() {
        var row = $('#item').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
                if (r) {
                    $.post(base_url + '/master/item/delete_item', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#item').datagrid('reload');
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

    $('#status_sku').combobox({
    	onBeforeLoad: function(param){
    		$("#status_sku").combobox("setValue", "ACTIVE");
    	}
    });

</script>
