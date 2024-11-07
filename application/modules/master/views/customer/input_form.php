<form id="customer_input_form" method="post" novalidate class="table_form">
    <input type="hidden" name="id">
    <table width="100%" border="0">
        <tr valign="top">
            <td width="50%">
                <table width="100%" border="0">
                    <tr>
                        <td width="25%"><strong>Type</strong></td>
                        <td width="75%">
                            <select class="easyui-combobox" name="customer_type_id" editable='false' required="true" panelHeight='auto' style="width: 150px">
                                <option></option>
                                <?php
                                foreach ($customer_type as $result) {
                                    ?>
                                    <option value="<?php echo $result->id ?>"><?php echo $result->name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><input type="text" name='name'
                                   class="easyui-textbox" style="width: 100%" required="true" /></td>
                    </tr>
                    <tr>
                        <td><strong>DoB</strong></td>
                        <td><input type="text" name='date_of_birth'
                                   class="easyui-datebox" style="width: 150px" data-options="formatter:myformatter,parser:myparser"/></td>
                    </tr>
                    <tr>
                        <td><strong>Gender</strong></td>
                        <td>
                            <select class="easyui-combobox" name="gender" editable='false' panelHeight='auto' style="width: 150px">
                                <option></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Religion</strong></td>
                        <td>
                            <select class="easyui-combobox" name="religion" editable='false' panelHeight='auto' style="width: 150px">
                                <option></option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Others">Others</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Occupation</strong></td>
                        <td>
                            <input type="text" name='occupation'
                                   class="easyui-textbox" style="width: 100%"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><input name='address' class="easyui-textbox" multiline="true" style="width: 100%;height: 45px"/></textarea></td>
                    </tr>
                    <tr>
                        <td><strong>Province / State</strong></td>
                        <td>
                            <input type="text" name='state'
                                   class="easyui-textbox" style="width: 100%"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td>
                            <input type="text" name='city'
                                   class="easyui-textbox" style="width: 100%"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Region</strong></td>
                        <td>
                            <input type="text" name='region'
                                   class="easyui-textbox" style="width: 100%"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td>
                            <input type="text" name='phone_number'
                                   class="easyui-textbox" style="width: 100%"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>
                            <input type="text" name='email'
                                   class="easyui-textbox" style="width: 100%"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Point</strong></td>
                        <td>
                            <input type="text" name='point'
                                   class="easyui-numberbox" precision='2' style="width: 80px"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Discount</strong></td>
                        <td><input type="text" name='discount'
                                   class="easyui-numberbox" precision='2' style="width: 80px" /></td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>
                            <select class="easyui-combobox" name="status" editable='false' panelHeight='auto' style="width: 150px">
                                <option value="t">Active</option>
                                <option value="f">Non Active</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>

<script>
    function customer_save() {
        $('#customer_input_form').form('submit', {
            url: customer_url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (content) {
                console.log(content);
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#customer_dialog').dialog('close');
                    $('#customer').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }
        });
    }
</script>