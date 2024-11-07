<div id="toolbar_approver_leave" style="padding-top: 5px; padding-bottom: 10px; height: auto; background-color: white;">
	<span style="padding-top: 50px; font-size: 14px;">Approver that you selected will approve leave of jobtitle(s) [
	<span id="approver_jobtitle_info" style="font-weight: bold;font-size: 12px;"></span> ]</span>
	<br/>
	<br/>
	<br/>
	<span style="padding-top: 50px; font-size: 14px;">
		List Active Employees Department of : [ <label style="font-weight: bold;font-size: 15px;"><?php echo $department_name; ?></label> ] </span>
</div>

<table id="approver_leave"></table>
<script type="text/javascript">
$(function(){
	displayApproverLeaveInfo();//tampilkan info di toolbar
	var department = $('#department2').datagrid('getSelected');
    $('#approver_leave').datagrid({
    	url:'<?php echo site_url('leave/approver_leave/get_employee_by_department?department_id=')?>'+department.id,
        method:'get',
        border:true,       
        singleSelect:false,
        selectOnCheck:true,
        checkOnSelect:true,
        fit:true,
        pageSize:30,
        rownumbers:true,
        fitColumns:false,
        pagination:false,
        toolbar:'#toolbar_approver_leave',
 	    columns:[[
 		  		{field:'id',checkbox:true},
 		  		{field:'sequence',title:'Sequence', width:80,
 		  			formatter: function(value,row,index){
 		  					return '<input style="width:50px" id="row'+row.id+'" type="text" value="">';
 		  			}
 		  		},
 		  		{field:'employee_name',title:'Employee Name', width:'100',halign:'center'},
 		  		{field:'jobtitle_code',title:'JobTitle Code', width:'100',halign:'center'},
 		  		{field:'jobtitle_name',title:'JobTitle Name', width:'200',halign:'center'}
 		  	]]
 		}).datagrid('getPager').pagination({            
 	       pageList: [30,50,70,90,110]
 		});

});

	function displayApproverLeaveInfo(){
		var jobtitles = $('#department_jobtitle').datagrid('getSelections');
		var info = "";
		var i=1;
		$.each(jobtitles, function (key, data) {
	    	info += data.name + (i==jobtitles.length ? "" : ", "); 
	    	i++;
	    });
		$("#approver_jobtitle_info").text(info);
	}
</script>