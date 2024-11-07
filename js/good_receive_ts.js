/**
 * 
 */
var gr_ts_url = '';
function gr_ts_search() {
	$('#gr_ts').datagrid('reload', $('#gr_ts_form_search').serializeObject());
}

function gr_ts_print(){
	var row = $('#gr_ts').datagrid('getSelected');
	if (row !== null) {
		popupCenter(base_url + '/order_management/Good_receive_ts/prints/' + row.id,'PRINT STM RECEIVING',800,600);
	}
	else{
		$.messager.alert('Good Receive not Selected', 'Please select STM to print', 'warning');
	}
}

//Tombol receive transfer stock
function gr_ts_receive(){
	var row = $('#gr_ts').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Apakah anda ingin menerima barang ini?', function(r) {
            if (r) {
                $.post(base_url + '/order_management/Good_receive_ts/gr_ts_receive', {
                    id: row.id
                },function(content) {
        			console.log(content);
                	var result = eval('(' + content + ')');
        			if (result.success === true) {
        				$('#gr_ts').datagrid('reload');
        				$('#gr_ts_receive').linkbutton('disable'); 
        				$('#gr_ts_print').linkbutton('enable'); 
        			} else {
        				$.messager.alert('Error', result.msg, 'error');
        			}
        		});
            }
        });
    } else {
        $.messager.alert('Good Receive not Selected', 'Select Good Receive', 'warning');
    }
}
// Detail item gr
function gr_ts_item_search() {
	$('#detail_gr_ts').datagrid('reload', $('#item_gr_ts_form_search').serializeObject());
}

function stock_transfer_manifest_print(){
	var row = $('#stock_transfer_manifest').datagrid('getSelected');
	if (row !== null) {
		popupCenter(base_url + '/order_management/Stock_transfer_manifest/prints/' + row.id,'PRINT STM',800,600);
	}
	else{
		$.messager.alert('Transfer Stock was not Selected', 'Please select Transfer Stock to print', 'warning');
	}
}