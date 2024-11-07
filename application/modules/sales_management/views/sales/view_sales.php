<div id="sales_toolbar" style="padding-bottom: 2px;">
    No. Faktur : <input type="text" id="reference_ID" size="10" class="easyui-validatebox" onkeypress="if (event.keyCode == 13) {
                user_mapping_to_role_search()
            }" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="user_mapping_to_role_search()"> Search</a>
    &nbsp;
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="rePrintReceived()">Re-Print Received</a> 
    &nbsp;&nbsp;&nbsp;
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="cashier_report_print()">Cashier Report Print</a> 
</div>
<table id="sales"
       data-options="
       url:'<?php echo site_url('sales_management/sales/get_sales_with_pagination') ?>',
       method:'post',
       border:true,
       fit:true,
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:true,
       pageSize:30,
       pageList:[30, 50, 70, 100, 200],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true, 
       remoteSort:true,
       multiSort:true,
       toolbar:'#sales_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="reference" width="120" halign="center">No. Faktur</th>
            <th field="customer_name" width="100" halign="center">Customer Name</th>    
            <th field="total_price" width="60" halign="center">Total Price</th>
            <th field="total_quantity" width="90" halign="center">Total Quantity</th>
            <th field="total_cash" width="60" halign="center">Total Cash</th>
            <th field="amount_pay_cash" width="60" halign="center">Cash</th>
            <th field="credit_card_number" width="120" halign="center">Credit Card Number</th>
            <th field="amount_pay_cash_credit_card" width="120" halign="center">Pay via Credit Card</th>
            <th field="debit_card_number" width="120" halign="center">Debit Card Number</th>
            <th field="amount_pay_cash_debit_card" width="120" halign="center">Pay via Credit Card</th>
            <th field="voucher_number" width="120" halign="center">Voucher Number</th>
            <th field="amount_pay_cash_voucher" width="120" halign="center">Pay via Voucher</th>
            <th field="credit_card_type" width="120" halign="center">Credit Card Type</th>
            <th field="debit_card_type" width="120" halign="center">Debit Card Type</th>
            <th field="sales_date" width="70" halign="center">Sales Date</th>
            <th field="cashier_name" width="40" halign="center">Cashier</th>
        </tr>
    </thead>
</table>
<div id="print_content" style="display: none;"></div>
<script type="text/javascript">
    var rootUrl = "<?php echo site_url() ?>";
    $(function () {
        $('#sales').datagrid({
            onSelect: function (index, sales) {
                reloadSalesDetail(sales.id);
            }
        });
    });

    function user_mapping_to_role_search() {
        var sales_id_Value = $('#sales_ID').val();
        $('#user_mapping_to_role').datagrid('reload', {
            sales_id: sales_id_Value
        });
    }

    function reloadSalesDetail(sales_id) {
        $('#sales_detail').datagrid('reload', {
            sales_id: sales_id
        });
    }

    function rePrintReceived() {
        var row = $('#sales').datagrid('getSelected');
        if (row !== null) {
            var showPrintView = function () {
                try {
                    var url = rootUrl + "/cashier/sales/rePrintReceived";
                    $("#print_content").html('<iframe src="' + url + '" width="400" height="400" style="border:none"></iframe>');
                    $("#print_content").hide();
                    setTimeout(function () {
                        $("#print_content").empty();
                    }, 1000);
                } catch (e) {
                }
            }
            var param = {"salesId": row.id};
            $.ajax({
                type: "POST",
                url: rootUrl + "/cashier/sales/getReceivedData",
                data: param,
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.success == true) {
                        localStorage.removeItem('order');
                        localStorage.setItem("order", JSON.stringify(response.data));
                        showPrintView();
                    } else {
                        alert("Transaksi gagal dilakukan, silahkan hubungi Support! " + response.data);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    alert("Transaksi gagal dilakukan, silahkan hubungi Support!");
                }
            });
        } else {
            $.messager.alert('Warning', 'Please select at least 1 row to proceed', 'warning');
        }
    }

    function cashier_report_print() {

        if ($('#cashier_report_dialog')) {
            $('#bodydata').append("<div id='cashier_report_dialog'></div>");
        }

        $('#cashier_report_dialog').dialog({
            title: 'PRINT',
            width: 300,
            height: 'auto',
            href: base_url + '/sales_management/sales/print_form',
            modal: false,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: 'Print',
                    iconCls: 'icon-print',
                    handler: function () {
                        if ($('#print_input_form').form('validate')) {
                            var report_date = $('#print_input_form input[name="report_date"]').val();
                            popupCenter(base_url + '/sales_management/sales/prints/' + report_date , 'PRINT', 800, 600);
                        }
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#broken_stock_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
            }
        });
    }

</script>
