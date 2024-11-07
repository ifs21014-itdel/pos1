<div id="customer_toolbar">
    <form id="customer_form_search" onsubmit="return false">
        Search : <input type="text" size="12" name="name" class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                    customer_search()
                }" />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="customer_search()">Find</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="customer_add()">Add</a> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="customer_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="customer_delete()">Delete</a>
    </form>
</div>
<table id="customer"
       data-options="
       url:'<?php echo site_url('master/customer/get_customer_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List Customer',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#customer_toolbar'">
    <thead>
        <tr>
            <th field="customer_type_name" width="100" halign="center">Type</th>
            <th field="barcode" width="120" halign="center">Card Number</th>
            <th field="name" width="200" halign="center">Name</th>
            <th field="date_of_birth" width="100" align="center" formatter='myFormatDate'>DoB</th>
            <th field="gender" width="60" align="center">Gender</th>
            <th field="religion" width="100" halign="center">Religion</th>
            <th field="occupation" width="100" halign="center">Occupation</th>
            <th field="address" width="350" halign="center">Address</th>
            <th field="state" width="100" halign="center">Province/State</th>
            <th field="city" width="100" halign="center">City</th>
            <th field="region" width="100" halign="center">Region</th>
            <th field="phone_number" width="100" halign="center">Phone No.</th>
            <th field="email" width="180" halign="center">Email</th>
            <th field="point" width="80" align="center">Point</th>
            <th field="discount" width="80" align="center">Discount</th>
            <th field="status" width="80" align="center" data-options="formatter:function(value){if(value=='t'){return 'Active'}else{return 'Non Active'}}">Status</th>
    </thead>
</table>
<script type="text/javascript">
    var customer_url = '';

    $(function () {
        $('#customer').datagrid({});
    });

    function customer_search() {
        $('#customer').datagrid('reload', $('#customer_form_search').serializeObject());
    }

    function customer_input_form(type, title, row) {
        if ($('#customer_dialog')) {
            $('#bodydata').append("<div id='customer_dialog'></div>");
        }
        $('#customer_dialog').dialog({
            title: title,
            width: 400,
            height: 'auto',
            href: base_url + '/master/customer/input_form',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: (type === 'edit') ? 'Update' : 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        customer_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#customer_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                if (type === 'edit') {
                    $('#customer_input_form').form('load', row);
                }

            }
        });
    }

    function customer_add() {
        customer_input_form('add', 'ADD Customer', null);
        customer_url = base_url + '/master/customer/add_customer';
    }

    function customer_edit() {
        var row = $('#customer').datagrid('getSelected');
        if (row !== null) {
            customer_input_form('edit', 'Edit Customer', row);
            customer_url = base_url + '/master/customer/update_customer';
        } else {
            $.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
        }
    }

    function customer_delete() {
        var row = $('#customer').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
                if (r) {
                    $.post(base_url + '/master/customer/delete_customer', {
                        id: row.id
                    }, function (result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#customer').datagrid('reload');
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
