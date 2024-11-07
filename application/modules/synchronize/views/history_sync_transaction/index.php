<div class="easyui-layout" data-options="fit:true">
	<div region="west" border='false'>
		<div style="padding: 15px;">
		<h2>Synchronize All Transaction (Download)</h2>
		<ul>
			<li>Stock Transfer Manifest (STM)</li>
			<li>STM Receive</li>
			<li>Purchase Order</li>
		</ul>
		<p>Click the button below to start synchronization.</p>
		<div style="margin: 20px 0;">
			<a href="#" class="easyui-linkbutton" onclick="synchronize_transaction()">Start</a>
		</div>
		<div id="prg_transaction" class="easyui-progressbar" style="width: 400px;"></div>
		<div id="status_progress_sync_transaction_parent" style="padding: 5px; display: none;">
			<div id="status_progress_sync_transaction"></div>
		</div>
		<script type="text/javascript">
		var value_prg_transaction = 0;

		function show_status(is_success){
			$("#status_progress_sync_transaction_parent").show();
            if (is_success == true) {
            	value_prg_transaction = 100;
                $("#status_progress_sync_transaction").html('Status Synchronization:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Success</span><span class="l-btn-icon icon-ok">&nbsp;</span></span>');
            }else{
            	$("#status_progress_sync_transaction").html('Status Synchronization:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Failed</span><span class="l-btn-icon icon-no">&nbsp;</span></span>');
            }
		}
		
		function synchronize_transaction(){
			value_prg_transaction = $('#prg_transaction').progressbar('getValue');
				$.post(base_url + '/synchronize/Store_factory/synchronize_transaction', {
                }, function(result) {
                    show_status(result.success);
                }, 'json');
				start();
		    };
		
		    function start(){
		         if (value_prg_transaction < 80){
		        	 value_prg_transaction += Math.floor(Math.random() * 5);
		            $('#prg_transaction').progressbar('setValue', value_prg_transaction);
		            setTimeout(arguments.callee, 100);
		         }else if(value_prg_transaction == 100){
		        	 $('#prg_transaction').progressbar('setValue', 100);
			     }else{
			    	 show_status(false);
				 }
		    };
		</script>
		</div>
	</div>
	<div region="east" id="panel_sync_result" style="width: 60%;display: none;">
			<table id="synchronized_transaction_data" 
					data-options="
	                rownumbers:true,
	                singleSelect:true,
	                autoRowHeight:false,
	                pagination:true,
	                pageList: [30, 50, 70, 90, 110]" >
             </table>
			<script type="text/javascript">
				$('#synchronized_transaction_data').datagrid({
				    columns:[[
				        {field:'table',title:'Transaction Name',width:200},
				        {field:'action',title:'Action',width:200},
				        {field:'status',title:'Status',width:150,align:'right'}
				    ]]
				});
				$('#synchronized_transaction_data').datagrid('appendRow',{
					table: 'Item',
					action: 'Updated',
					status: 'Synchronized'
				});
			</script>
	</div>
</div>
