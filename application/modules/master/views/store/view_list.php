<div id="store_toolbar">
	<form id="store_form_search" onsubmit="return false">
		Search: 
		<input type="text" size="12" name="name" class="easyui-validatebox" onkeypress="if(event.keyCode==13){store_search()}" /> 
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="store_search()">Find</a> 
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="store_add()">Add</a> 
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="store_edit()">Edit</a>
	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="store_delete()">Delete</a>
	</form>
</div>
<table id="store"
	data-options="
       url:'<?php echo site_url('/master/store/get_stores_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List store',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#store_toolbar'">
	<thead>
		<tr>
			<th field="id" hidden="true"></th>
			<th field="code" width="90" halign="center">Code</th>
			<th field="name" width="200" halign="center">Name</th>
			<th field="address" width="300" halign="center">Address</th>
			<th field="serial_number" width="300" halign="center">Serial Number</th>
		</tr>
	</thead>
</table>
<script type="text/javascript">
	var store_url = '';

    $(function() {
        $('#store').datagrid({});
    });

    function store_search() {
    	$('#store').datagrid('reload', $('#store_form_search').serializeObject());
    }

    function store_input_form(type, title, row) {
    	if ($('#store_dialog')) {
    		$('#bodydata').append("<div id='store_dialog'></div>");
    	}
    	$('#store_dialog').dialog({
    		title : title,
    		width : 400,
    		height : 'auto',
    		href : base_url + '/master/store/input_form',
    		modal : false,
    		resizable : false,
    		shadow : false,
    		buttons : [ {
    			text : (type === 'edit') ? 'Update' : 'Save',
    			iconCls : 'icon-save',
    			handler : function() {
    				store_save();
    			}
    		}, {
    			text : 'Close',
    			iconCls : 'icon-remove',
    			handler : function() {
    				$('#store_dialog').dialog('close');
    			}
    		} ],
    		onLoad : function() {
    			$(this).dialog('center');
    			if (type === 'edit') {
    				$('#store_input_form').form('load', row);
    			} else {
    				$('#store_input_form').form('clear');
    			}

    		}
    	});
    }

    function store_add() {
    	store_input_form('add', 'Add Store', null);
    	store_url = base_url + '/master/store/add_store';
    }

    function store_edit() {
    	var row = $('#store').datagrid('getSelected');
    	if (row !== null) {
    		store_input_form('edit', 'Edit store', row);
    		store_url = base_url + '/master/store/update_store';
    	} else {
    		$.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
    	}
    }

    function store_delete(){
    	var row = $('#store').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function(r) {
                if (r) {
                    $.post(base_url + '/master/store/delete_store', {
                        id: row.id
                    }, function(result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#store').datagrid('reload');
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
