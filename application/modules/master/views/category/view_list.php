<div id="category_toolbar">
	<form id="category_form_search" onsubmit="return false">
		Search : <input type="text" size="12" name="name" class="easyui-validatebox" onkeypress="if(event.keyCode==13){category_search()}" /> 
			<select id="level" class="easyui-combobox" panelHeight="auto" name= "level" data-options="onChange:function(n,o){category_search()}">
				<option value="">all</option>
				<option value="1">level 1</option>
				<option value="2">level 2</option>
				<option value="3">level 3</option>
				<option value="4">level 4</option>
			</select>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="category_search()">Find</a> 
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="category_add()">Add</a> 
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="category_edit()">Edit</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="category_delete()">Delete</a>
	</form>
</div>
<table id="category"
	data-options="
       url:'<?php echo site_url('master/category/get_categories_with_pagination') ?>',
       method:'post',
       border:true,       
       title:'List Category',
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#category_toolbar'">
	<thead>
		<tr>
			<th field="id" hidden="true"></th>
			<th field="name" width="200" halign="center">Category Name</th>
			<th field="level" width="200" halign="center">Level</th>
			<th field="parent_id" width="150" halign="center" align="right">Parent Id</th>
	</thead>
</table>
<script type="text/javascript">
    var category_url = '';
    
    $(function() {
        $('#category').datagrid({});
    });

    function category_search() {
    	$('#category').datagrid('reload', $('#category_form_search').serializeObject());
    }

    function category_input_form(type, title, row) {
    	if ($('#category_dialog')) {
    		$('#bodydata').append("<div id='category_dialog'></div>");
    	}
    	$('#category_dialog').dialog({
    		title : title,
    		width : 400,
    		height : 'auto',
    		href : base_url + '/master/category/input_form',
    		modal : false,
    		resizable : false,
    		shadow : false,
    		buttons : [ {
    			text : (type === 'edit') ? 'Update' : 'Save',
    			iconCls : 'icon-save',
    			handler : function() {
    				category_save();
    			}
    		}, {
    			text : 'Close',
    			iconCls : 'icon-remove',
    			handler : function() {
    				$('#category_dialog').dialog('close');
    			}
    		} ],
    		onLoad : function() {
    			$(this).dialog('center');
    			if (type === 'edit') {
    				$('#category_input_form').form('load', row);
    			} else {
    				$('#category_input_form').form('clear');
    			}

    		}
    	});
    }

    function category_add() {
    	category_input_form('add', 'ADD category', null);
    	category_url = base_url + '/master/category/add_category';
    }

    function category_edit() {
    	var row = $('#category').datagrid('getSelected');
    	if (row !== null) {
    		category_input_form('edit', 'Edit category', row);
    		category_url = base_url + '/master/category/update_category';
    	} else {
    		$.messager.alert('Warning', 'Please Select 1 row to proceed', 'warning');
    	}
    }

    function category_delete(){
    	var row = $('#category').datagrid('getSelected');
        if (row !== null) {
            $.messager.confirm('Confirm', 'Are you sure to remove this data?', function(r) {
                if (r) {
                    $.post(base_url + '/master/category/delete_category', {
                        id: row.id
                    }, function(result) {
                        console.log(result.success);
                        if (result.success) {
                            $('#category').datagrid('reload');
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
