<div class="easyui-layout" data-options="fit:true" style="border: none">        
	<div region="center"
		 style="height:50%"
		 collapsible="false"
		 split="true"
		 title="Sales"
		 href="<?php echo site_url('sales_management/sales/sales_view') ?>">                
	</div>
	<div region="south"
		 style="height:50%"
		 collapsible="true"
		 split="true"
		 title="List of Items per Sales"
		 href="<?php echo site_url('sales_management/sales_detail/sales_detail_view') ?>">
	</div>
</div>
