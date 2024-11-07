<div class="easyui-layout" data-options="fit:true">
	<div region="west" border='false'>
		<div style="padding: 15px;">
		<h2>Synchronize All Master (Download)</h2>
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
			<li>STM Receive</li>
			<li>Purchase Order</li>
		</ul>
		<p>Click the button below to start synchronization.</p>
		<div style="margin: 20px 0;">
			<a href="#" class="easyui-linkbutton" onclick="synchronize_master()">Start</a>
		</div>
		<br/>
		Download Master
		<div id="prg_master" class="easyui-progressbar" style="width: 400px;"></div>
		<div id="status_progress_sync_master_parent" style="padding: 5px; display: none;">
			<div id="status_progress_sync_master"></div>
		</div>
		
		<br/>
		Download Transaction
		<div id="prg_transaction" class="easyui-progressbar" style="width: 400px;"></div>
		<div id="status_progress_sync_transaction_parent" style="padding: 5px; display: none;">
			<div id="status_progress_sync_transaction"></div>
		</div>
		<script type="text/javascript">
			//master
			var value_prg_master = 0;
			function show_status_master(is_success){
				$("#status_progress_sync_master_parent").show();
           	 if (is_success == true) {
           			value_prg_master = 100;
          	     	$("#status_progress_sync_master").html('Status Synchronization:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Success</span><span class="l-btn-icon icon-ok">&nbsp;</span></span>');
          	     	synchronize_transaction();
         	   }else{
         		   	$("#status_progress_sync_master").html('Status Synchronization:&nbsp;<span class="l-btn-left l-btn-icon-left"><span class="l-btn-text">Failed</span><span class="l-btn-icon icon-no">&nbsp;</span></span>');
         	   }
			}
			function synchronize_master(){
				value_prg_master = $('#prg_master').progressbar('getValue');
					$.post(base_url + '/synchronize/Store_factory/synchronize_master', {
             	   }, function(result) {
            	    	show_status_master(result.success);
            	    }, 'json');
					start_master();
		    };
		    function start_master(){
		         if (value_prg_master < 80){
		        	 value_prg_master += Math.floor(Math.random() * 10);
		            $('#prg_master').progressbar('setValue', value_prg_master);
		            setTimeout(arguments.callee, 100);
		         }else if(value_prg_master == 100){
		        	 $('#prg_master').progressbar('setValue', 100);
			     }else{
			    	 show_status_master(false);
				 }
		    };

		    //transaction
		    var value_prg_transaction = 0;
			function show_status_transaction(is_success){
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
	                    show_status_transaction(result.success);
	                }, 'json');
					start_transaction();
			    };
		    function start_transaction(){
		         if (value_prg_transaction < 80){
		        	 value_prg_transaction += Math.floor(Math.random() * 5);
		            $('#prg_transaction').progressbar('setValue', value_prg_transaction);
		            setTimeout(arguments.callee, 100);
		         }else if(value_prg_transaction == 100){
		        	 $('#prg_transaction').progressbar('setValue', 100);
			     }else{
			    	 show_status_transaction(false);
				 }
		    };
		</script>
		</div>
	</div>
</div>
