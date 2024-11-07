<div class="easyui-layout" data-options="fit:true">
    <div region="west" border='false'>
        <div style="padding: 15px;">
            <h2>Download All Master & Transaction</h2>
            Master
            <ul>
                <li>Item</li>
                <li>Category</li>
                <li>Bank</li>
                <li>Customer</li>
                <li>User</li>
                <li>Promotion</li>
                <li>Store</li>
                <li>UOM</li>
                <li>Vendor</li>
            </ul>
            Transaction
            <ul>
                <li>Stock Transfer Manifest (STM)</li>
                <li>STM Received</li>
                <li>Purchase Order</li>
            </ul>
            <p>Click the button below to start synchronization.</p>
            <div style="margin: 20px 0;">
                <a href="#" id="start_button" class="easyui-linkbutton" onclick="synchronize_download()">Start</a>
            </div>

            <div id="temp_progress_download"  style="width: 400px;"></div>

            <div id="status_progress_download" style="padding: 5px; display: none;">
                <div id="status_progress_downloaded_data"></div>
            </div>
            <script type="text/javascript">
                var value_prg_download = 0;

                function show_status(is_success) {
                    $('#progress_download').hide();
                    $('#start_button').show();
                    $("#status_progress_download").show();
                    if (is_success === true) {
                        value_prg_download = 100;
                        $("#status_progress_downloaded_data").html('Status Download:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Success</span><span class="l-btn-icon icon-ok">&nbsp;</span></span>');
                    } else {
                        $("#status_progress_downloaded_data").html('Status Download:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Failed</span><span class="l-btn-icon icon-no">&nbsp;</span></span>');
                    }
                }

                function synchronize_download() {
                    $.messager.confirm('Confirm', 'Pastikan tidak ada transaksi yang dilakukan untuk memulai Download.<br/>Lanjutkan?', function (r) {
                        if (r) {
                            $('#start_button').hide();
                            //$('#progress_download').show();

                            $('#temp_progress_download').html("<img src='<?php echo base_url("assets/images/loader.gif"); ?>'>");

                            //value_prg_download = $('#prg_download').progressbar('getValue');
                            $.post(base_url + '/synchronize/Store_factory/synchronize_master_and_transaction', {
                            }, function (result) {
                                if (result.success) {
                                    $('#temp_progress_download').html('Status Download:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Success</span><span class="l-btn-icon icon-ok">&nbsp;</span></span>');
                                } else {
                                    $('#temp_progress_download').html('Status Download:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Failed</span><span class="l-btn-icon icon-no">&nbsp;</span></span>');
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
                    if (value_prg_download < 80) {
                        value_prg_download += Math.floor(Math.random() * 10);
                        $('#prg_download').progressbar('setValue', value_prg_download);
                        setTimeout(arguments.callee, 100);
                    } else if (value_prg_download == 100) {
                        $('#prg_download').progressbar('setValue', 100);
                    } else {
                        show_status(false);
                    }
                }
                ;
            </script>

        </div>
    </div>
</div>
