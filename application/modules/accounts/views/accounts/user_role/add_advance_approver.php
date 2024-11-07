<div style="padding: 5px 5px">
	<form id="advance_approver_form" method="post" novalidate>
		<table width="100%" border="0" style="float: left;">
			<tr>
				<td colspan="3" style="padding: 2px;padding-bottom: 7px;">
					Generally, advance approver will approve leave of employee with top level of jobtitle like Manager.
				</td>
			</tr>
			
			<tr>
				<td align="right">
					<label for="name">Approver</label>
				</td>
				<td>:</td>
				<td>
					<select id="approved_by" name="approved_by" style="width: 156px;" valueField="id" textField="name" required="true"></select>
				</td>
			</tr>
			<tr>
				<td align="right">
					<label for="sequnce">Sequence</label>
				</td>
				<td>:</td>
				<td>
					<input class="easyui-textbox" name="sequence" style="width: 40px" id="sequence" required="tue">
				</td>
			</tr>
		</table>
	</form>
</div>
<script type="text/javascript">
$(function() {
	$("#approved_by").combogrid({
	    panelWidth:450,
	    url: '<?php echo site_url("leave/apply/active_employees/false")?>',
	    idField:'id',
		textField:'name',
	    mode:'post',
	    fitColumns:true,
	    columns:[[
	        {field:'id',title:'NIP',width:40},
	        {field:'name',title:'Name',align:'left',width:80},
	        {field:'department',title:'Department',align:'left',width:80},
	        {field:'job_title',title:'JobTitle',align:'left',width:80}
	    ]]
	});
});

function apply_mass_leave() {
    $('#advance_approver_form').form('submit', {
        url: base_url + 'leave/apply/save_mass_leave',
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            console.log(content);
            var result = eval('(' + content + ')');
            if (result.success) {
            	$.messager.alert('Informasi','Cuti bersama berhasil diajukan!','info');
            	closeMassLeaveFormDialog();
            	reloadLeaveTrackPositionGrid();
            } else {
                $.messager.alert('Warning','Cuti bersama gagal dibuat, silahkan cek log atau hubungi Admin!','error');
            }
        }
    });
}

function closeAdvanceApproverLeaveFormDialog(){
	console.log($('#dd').dialog());
	$('#dd').dialog('close');
}
</script>
