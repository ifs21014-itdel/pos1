<div id="user_role_toolbar" style="padding-bottom: 2px;">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="user_role_add()">Add Approver in Jobtitle</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="user_role_delete()">Delete</a>
</div>
<table id="user_role"
	data-options="
       url:'<?php echo site_url('leave/approver_jobtitle/get_approver_by_jobtitle') ?>',
       method:'post',
       border:true,
       singleSelect:false,
       selectOnCheck:true,
       checkOnSelect:true,
       fit:true,
       pageSize:30,
       pageList:[10, 30, 50, 70, 100, 200],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true, 
       remoteSort:true,
       multiSort:true,
       toolbar:'#user_role_toolbar'">
	<thead>
		<tr>
			<th data-options="field:'id',checkbox:true"></th>
			<th field="jobtitle_id" hidden="true"></th>
			<th field="code" width="100" halign="center" sortable="true">Code</th>
			<th field="name" width="200" halign="center" sortable="true">Name</th>
			<th field="description" width="400" halign="center" sortable="true">Description</th>
		</tr>
	</thead>
</table>

<div id="jobtitle_dialog"></div>
<script type="text/javascript">
$(function() {
	$('#department_jobtitle').datagrid({});
});

function showFormAddJobTitleToDepartment(){
    var row = $('#department2').datagrid('getSelected');
    if (row !== null) {
		$('#jobtitle_dialog').dialog({
		    title: 'Map JobTitle to Department',
		    width: '60%',
		    height: '80%',
		    closed: false,
		    cache: false,
		    href: '<?php echo site_url("department2/department_jobtitle/view_form_add_jobtitle_to_department") ?>?department_id=' + row.id,
		    modal: true,
		    buttons: [{
				text:'Ok',
				iconCls:'icon-ok',
				handler:function(){
					submitFormAddJobTitleToDepartment();
				}
			},{
				text:'Cancel',
				handler:function(){
					closeDialogJobTitle();
				}
			}]
	    
		});
	}else{
		$.messager.alert('Warning', 'Please select Department to Continue', 'warning');
	}
}

function submitFormAddJobTitleToDepartment(){
	var department = $('#department2').datagrid('getSelected');
    var rows = $('#department_jobtitle_add').datagrid('getSelections');

	console.log(department);
	console.log(rows);
    
    if (rows !== null) {
		var param="";
	    $.each(rows, function (key, data) {
	    	param +="jobtitle_id[]="+ data.id+"&";
        });
		param += "department_id="+department.id

		console.log("param: ");
		console.log(param);
        
		$.ajax({
			  type: "GET",
			  url: "<?php echo site_url("department2/department_jobtitle/save_jobtitle_to_department")?>",
			  data: param,
			  success: function(data){
				console.log(data);
				closeDialogJobTitle();
				$('#department_jobtitle').datagrid('reload');
		      }
	     });
		
	}else{
		$.messager.alert('Warning', 'Please select atlease 1 Jobtitle to Continue', 'warning');
	}
}

function closeDialogJobTitle(){
	$('#jobtitle_dialog').dialog('close');
}

function department_jobtitle_add() {
	if(initializeComboDepartmentJobTitle()){//create combo in dialog
	    $('#department_jobtitle-form').dialog('open').dialog({'setTitle':'Add Jobtitle To Department'});
	    $('#department_jobtitle-input').form('clear');
	    url = base_url + 'department2/department_jobtitle/save';
	}
}

function department_jobtitle_delete() {
    var rows = $('#department_jobtitle').datagrid('getSelections');
    console.log(rows);
    if (rows !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
        		var param="";
        		var i=0;
        	    $.each(rows, function (key, data) {
        	    	param +="id[]="+ data.id + ( i == (rows.length - 1 ) ? "" : "&" );
        	    	i++;
                });            	
                
                $.get('<?php echo site_url("department2/department_jobtitle/deletes")?>', param ,
                 function(result) {
                    if (result.success) {
                        $('#department_jobtitle').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Warning', 'Choose Job title to Delete', 'warning');
    }
}
</script>
