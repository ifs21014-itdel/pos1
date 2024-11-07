<div id="user-changepassword-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#ticketdetaildialog-buttons">
    <form id="user-changepassword-form-input" method="POST" novalidate>
        <table width="100%">
            <tr>
                <td align="right"><label for="passord">Current Password :</label></td>
                <td><input type="password" name="old_password" class="easyui-validatebox" size="25" required="true" value=""/></td>
            </tr>
            <tr>
                <td align="right"><label for="passord">New Password :</label></td>
                <td><input type="password" name="password" id="e-password"class="easyui-validatebox" size="25" required="true" value=""/></td>
            </tr>
            <tr>
                <td align="right"><label for="re-passord">Re-Type New Password :</label></td>
                <td><input type="password" name="re-password" id="re-password" class="easyui-validatebox" size="25" required="true" value=""/></td>
            </tr>       
        </table>
    </form>
</div>
<div id="ticketdetaildialog-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="user_changepassword_save()">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#user-changepassword-form').dialog('close')">Batal</a>
</div>