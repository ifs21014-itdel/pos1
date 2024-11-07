<div id="item_bom_toolbar">
    <form id="item_gr_form_search" onsubmit="return false">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="item_bom_add">Add</a>
        <script type="text/javascript">
            $('#item_bom_add').click(function () {
                if ($('#item_bom_dialog')) {
                    $('#bodydata').append("<div id='item_bom_dialog'></div>");
                }
                $('#item_bom_dialog').dialog({
                    title: 'Add Item',
                    width: 400,
                    height: 'auto',
                    closed: false,
                    cache: false,
                    href: base_url + '/master/Item/bom_input',
                    modal: true,
                    border: false,
                    resizable: true,
                    buttons: [
                        {
                            text: 'Save',
                            iconCls: 'icon-save',
                            handler: function () {
                                $('#item_bom_input_form').form('submit', {
                                    url: base_url + '/master/Item/bom_save/<?php echo $itemid ?>/0',
                                    onSubmit: function () {
                                        return $(this).form('validate');
                                    },
                                    success: function (content) {
                                        console.log(content);
                                        var result = eval('(' + content + ')');
                                        if (result.success) {
                                            $('#item_bom_dialog').dialog('close');
                                            $('#item_bom').datagrid('reload');
                                        } else {
                                            $.messager.alert('Error', result.msg, 'error');
                                        }
                                    }
                                });
                            }
                        },
                        {
                            text: 'Close',
                            iconCls: 'icon-remove',
                            handler: function () {
                                $('#item_bom_dialog').dialog('close');
                            }
                        }
                    ],
                    onLoad: function () {
                        $(this).dialog('center');
                        $('#item_bom_input_form').form('clear');
                    }
                });
            })
        </script>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="item_bom_edit">Edit</a>
        <script type="text/javascript">
            $('#item_bom_edit').click(function () {
                var row = $('#item_bom').datagrid('getSelected');
                if (row !== null) {
                    if ($('#item_bom_dialog')) {
                        $('#bodydata').append("<div id='item_bom_dialog'></div>");
                    }
                    $('#item_bom_dialog').dialog({
                        title: 'Edit Item',
                        width: 400,
                        height: 'auto',
                        closed: false,
                        cache: false,
                        href: base_url + '/master/Item/bom_input',
                        modal: true,
                        border: false,
                        resizable: true,
                        buttons: [
                            {
                                text: 'Save',
                                iconCls: 'icon-save',
                                handler: function () {
                                    $('#item_bom_input_form').form('submit', {
                                        url: base_url + '/master/Item/bom_save/0/' + row.id,
                                        onSubmit: function () {
                                            return $(this).form('validate');
                                        },
                                        success: function (content) {
                                            console.log(content);
                                            var result = eval('(' + content + ')');
                                            if (result.success) {
                                                $('#item_bom_dialog').dialog('close');
                                                $('#item_bom').datagrid('reload');
                                            } else {
                                                $.messager.alert('Error', result.msg, 'error');
                                            }
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Close',
                                iconCls: 'icon-remove',
                                handler: function () {
                                    $('#item_bom_dialog').dialog('close');
                                }
                            }
                        ],
                        onLoad: function () {
                            $(this).dialog('center');
                            $('#item_bom_input_form').form('load', row);
                        }
                    });
                } else {
                    $.messager.alert('Item Belum Dipilih', 'Silahkan Pilih Salah Satu Item Yang Akan Di Edit', 'warning')
                }
            });
        </script>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="item_bom_delete">Delete</a>
        <script type="text/javascript">
            $('#item_bom_delete').click(function () {
                var row = $('#item_bom').datagrid('getSelected');
                if (row !== null) {
                    $.messager.confirm('Confirm', 'Data Yang dihapus tidak akan bisa dikembalikan. Anda Yakin?', function (r) {
                        if (r) {
                            $.post(base_url + '/master/Item/bom_delete', {
                                id: row.id
                            }, function (result) {
                                if (result.success) {
                                    $('#item_bom').datagrid('reload');
                                } else {
                                    $.messager.alert('Error', result.msg, 'error');
                                }
                            }, 'json');
                        }
                    });
                } else {
                    $.messager.alert('Item Belum Dipilih', 'Silahkan Pilih Salah Satu Item Yang Akan Di Hapus', 'warning')
                }
            });
        </script>
    </form>
</div>
<table id="item_bom"
       data-options="
       url:'<?php echo site_url('/master/Item/bom_get/' . $itemid) ?>',
       method:'post',
       border:false,
       singleSelect:true,
       selectOnCheck:true,
       checkOnSelect:false,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       pageList: [30, 50, 70, 90, 110],
       toolbar:'#item_bom_toolbar'">
    <thead>
        <tr>
            <th field="sku" width="90" halign="center">SKU</th>
            <th field="barcode" width="90" halign="center">Barcode</th>
            <th field="name" width="250" halign="center">Nama Barang</th>
            <th field="qty" width="80" halign="center" align="right">Jumlah</th>
            <th field="unit_code" width="90" halign="center" align="center">Satuan</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#item_bom').datagrid({});
    });
</script>
