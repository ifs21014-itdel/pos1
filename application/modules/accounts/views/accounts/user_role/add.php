<div id="department_jobtitle-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#dialog-button">
    <form id="department_jobtitle-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right">Job Title :</td>
                <td>
                	<input id="department_jobtitle-id" name="jobtitle_id" style="width: 150px" class="easyui-validatebox" required="true">
                </td>
            </tr>
        </table>        
    </form>
</div>
<div id="dialog-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="department_jobtitle_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#department_jobtitle-form').dialog('close')">Cancel</a>
</div>

<script type="text/javascript">

function initializeJobTitleGrid(){
	
}

function initializeComboDepartmentJobTitle(){
    var department = $('#department2').datagrid('getSelected');
    console.log(department);
    if(department != null && department != 'undefined'){
		$('#department_jobtitle-id').combogrid({
		    panelWidth:500,
		    url: '<?php echo site_url("department2/department_jobtitle/get_combo?department_id=") ?>'+department.id,
		    idField:'id',
		    textField:'name',
		    mode:'remote',
		    fitColumns:true,
		    columns:[[
		        {field:'code',title:'Code',width:150},
		        {field:'name',title:'Name',width:150}
		    ]]
		});
		return true;
    }else{
    	$.messager.alert('Warning','Please select 1 row in Department Grid!','error');
    }
    return false;
}

function department_jobtitle_save() {
	var department = $('#department2').datagrid('getSelected');
	console.log("departmedfasdf");
	console.log(department);
	
    $('#department_jobtitle-input').form('submit', {
        url: '<?php echo site_url("department2/department_jobtitle/save?department_id=")?>'+department.id,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            console.log(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#department_jobtitle-form').dialog('close');
                $('#department_jobtitle').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

</script>