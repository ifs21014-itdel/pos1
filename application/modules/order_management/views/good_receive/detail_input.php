<div id="gr_detail_dialog_toolbar" style="padding-bottom: 2px;">
    <form id='gr_detail_dialog_search_form' onsubmit="return false" style="margin: 0;">
        <span style="display: inline-block">
            P.O 
            <input type="text" name="q" class="easyui-validatebox" style="width: 100px" onkeyup="if (event.keyCode === 13) {
                        $('#gr_detail_dialog').datagrid('reload', $('#gr_detail_dialog_search_form').serializeObject());
                    }"/>
        </span>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="$('#gr_detail_dialog').datagrid('reload', $('#gr_detail_dialog_search_form').serializeObject());"></a>
        </span>
    </form>
</div>
<table id="gr_detail_dialog" data-options="
       url:'<?php echo site_url('order_management/Purchase_order/get_item_available_to_receive/' . $vendor_id) ?>',
       method:'post',
       border:false,
       singleSelect:false,
       fit:true,
       autoRowHeight:false,
       rownumbers:true,
       fitColumns:true,
       remoteSort:true,
       multiSort:true,
       pagination:true,
       nowrap:true,
       checkOnSelect: false,
       selectOnCheck: false,
       toolbar:'#gr_detail_dialog_toolbar'">
    <thead>
        <tr>
            <th field="gr_detail_dialog" checkbox='true' halign="center"></th>
            <th field="reference" width="90" halign="center">P.O No.</th>
            <th field="sku" width="50" halign="center">SKU</th>
            <th field="item_code" width="90" halign="center">Barcode</th>
            <th field="item_name" width="170" halign="center">Nama Barang</th>
            <th field="unit_code" width="50" halign="center" align="center">Satuan</th>
            <th field="quantity" width="100" halign="center" align="right">Jumlah Order</th>
            <th field="qty_receive" width="100" halign="center" align="right" data-options="editor:{type:'numberbox',options:{precision:1}}">Jumlah Terima</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $.extend($.fn.datagrid.methods, {
        editCell: function (jq, param) {
            return jq.each(function () {
                var opts = $(this).datagrid('options');
                var fields = $(this).datagrid('getColumnFields', true).concat($(this).datagrid('getColumnFields'));
                for (var i = 0; i < fields.length; i++) {
                    var col = $(this).datagrid('getColumnOption', fields[i]);
                    col.editor1 = col.editor;
                    if (fields[i] != param.field) {
                        col.editor = null;
                    }
                }
                $(this).datagrid('beginEdit', param.index);
                var ed = $(this).datagrid('getEditor', param);
                if (ed) {
                    if ($(ed.target).hasClass('textbox-f')) {
                        $(ed.target).textbox('textbox').focus();
                    } else {
                        $(ed.target).focus();
                    }
                }
                for (var i = 0; i < fields.length; i++) {
                    var col = $(this).datagrid('getColumnOption', fields[i]);
                    col.editor = col.editor1;
                }
            });
        },
        enableCellEditing: function (jq) {
            return jq.each(function () {
                var dg = $(this);
                var opts = dg.datagrid('options');
                opts.oldOnClickCell = opts.onClickCell;
                opts.onClickCell = function (index, field) {
                    if (opts.editIndex != undefined) {
                        if (dg.datagrid('validateRow', opts.editIndex)) {
                            dg.datagrid('endEdit', opts.editIndex);
                            opts.editIndex = undefined;
                        } else {
                            return;
                        }
                    }
                    dg.datagrid('selectRow', index).datagrid('editCell', {
                        index: index,
                        field: field
                    });
                    opts.editIndex = index;
                    opts.oldOnClickCell.call(this, index, field);
                }
            });
        }
    });

    var index_e = null;

    $(function () {
        $('#gr_detail_dialog').datagrid({
            onSelect: function (index, row) {
                if (index_e !== null) {
                    $(this).datagrid('checkRow', index_e);
                }
                index_e = index;
            }
        }).datagrid('enableCellEditing');
    });
</script>

