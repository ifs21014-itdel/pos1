<form id="print_input_form" method="post" novalidate class="table_form">
	<input type="hidden" name="id">
	<table width="100%" border="0">
		<tr>
            <td>Start Date:</td>
            <td>
                <input class="easyui-datebox" required="required" name="start-date" data-options="formatter:myformatter,parser:myparser">
            </td>
        </tr>
        <tr>
        	<td>End Date:</td>
            <td>
                <input class="easyui-datebox" required="required" name="end-date" data-options="formatter:myformatter,parser:myparser">
            </td>
        </tr>
	</table>
</form>

