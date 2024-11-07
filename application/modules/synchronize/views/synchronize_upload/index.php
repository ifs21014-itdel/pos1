<div class="easyui-layout" data-options="fit:true">
    <div region="west" border='false'>
        <div style="padding: 15px;">
            <h2>Upload All Master & Transaction</h2>
            <ul>
                <li>Sales</li>
                <li>Sales Item</li>
                <li>Stock Item</li>
                <li>Stock Transfer Manifest</li>
                <li>Broken Stock</li>
                <li>Sales Return</li>
                <li>Returned To Vendor</li>
                <li>Returned To Vendor Item</li>
                <li>Good Receive</li>
                <li>Good Receive Item</li>
            </ul>
            <p>Click the button below to start upload data.</p>
            <div style="margin: 20px 0;">
                <a href="#" id="start_button" class="easyui-linkbutton" onclick="synchronize_upload()">Start</a>
            </div>

            <div id="temp_progress_upload"  style="width: 400px;"></div>

            <div id="status_progress_upload" style="padding: 5px; display: none;">
                <div id="status_progress_uploaded_data"></div>
            </div>
            <script type="text/javascript">
                var value_prg_upload = 0;

                function show_status(is_success) {
                    $('#progress_upload').hide();
                    $('#start_button').show();
                    $("#status_progress_upload").show();
                    if (is_success === true) {
                        value_prg_upload = 100;
                        $("#status_progress_uploaded_data").html('Status Upload:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Success</span><span class="l-btn-icon icon-ok">&nbsp;</span></span>');
                    } else {
                        $("#status_progress_uploaded_data").html('Status Upload:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Failed</span><span class="l-btn-icon icon-no">&nbsp;</span></span>');
                    }
                }

                function synchronize_upload() {
                    $.messager.confirm('Confirm', 'Pastikan tidak ada transaksi yang dilakukan untuk memulai upload.<br/>Lanjutkan?', function (r) {
                        if (r) {
                            $('#start_button').hide();
                            //$('#progress_upload').show();

                            $('#temp_progress_upload').html("<img src='<?php echo base_url("assets/images/loader.gif"); ?>'>");

                            //value_prg_upload = $('#prg_upload').progressbar('getValue');
                            $.post(base_url + '/synchronize/Store_factory/upload_all_master_and_transaction', {
                            }, function (result) {
                                if (result.success) {
                                    $('#temp_progress_upload').html('Status Upload:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Success</span><span class="l-btn-icon icon-ok">&nbsp;</span></span>');
                                } else {
                                    $('#temp_progress_upload').html('Status Upload:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Failed</span><span class="l-btn-icon icon-no">&nbsp;</span></span>');
                                }
                                $('#start_button').show();
                                //show_status(result.success);
                            }, 'json');
                        }
                    });

                    //start();
                }
                ;

                function start() {
                    if (value_prg_upload < 80) {
                        value_prg_upload += Math.floor(Math.random() * 10);
                        $('#prg_upload').progressbar('setValue', value_prg_upload);
                        setTimeout(arguments.callee, 100);
                    } else if (value_prg_upload == 100) {
                        $('#prg_upload').progressbar('setValue', 100);
                    } else {
                        show_status(false);
                    }
                }
                ;
            </script>
        </div>
    </div>
    <div region="east" id="panel_sync_result" style="width: 60%;display: none;">
        <table id="synchronized_master_data" 
               data-options="
               rownumbers:true,
               singleSelect:true,
               autoRowHeight:false,
               pagination:true,
               pageList: [30, 50, 70, 90, 110]" >
        </table>
        <script type="text/javascript">
            $('#synchronized_master_data').datagrid({
                columns: [[
                        {field: 'table', title: 'Master Name', width: 200},
                        {field: 'action', title: 'Action', width: 200},
                        {field: 'status', title: 'Status', width: 150, align: 'right'}
                    ]]
            });
            $('#synchronized_master_data').datagrid('appendRow', {
                table: 'Item',
                action: 'Updated',
                status: 'Synchronized'
            });
        </script>
    </div>
</div>
