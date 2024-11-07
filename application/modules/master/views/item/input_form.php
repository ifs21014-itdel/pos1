<form id="item_input_form" method="post" novalidate class="table_form">
	<input type="hidden" name="id">
	<table width="100%" border="0">
		<tr valign="top">
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td width="40%"><strong>SKU</strong></td>
						<td width="60%"><input id="sku" type="text" name='sku'
							class="easyui-validatebox" required="true" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Nama Barang</strong></td>
						<td><input id="nama" type="text" name='name'
							class="easyui-validatebox" style="width: 98%" /></td>
					</tr>
					<tr>
						<td width="25%"><strong>Barcode</strong></td>
						<td width="75%"><input id="barcode" type="text" name='barcode'
							class="easyui-validatebox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td width="25%"><strong>Harga Pokok Pembelian</strong></td>
						<td width="75%"><input id="hrg_pokok" type="text" name='cost'
							class="easyui-validatebox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Harga Jual</strong></td>
						<td><input id="hrg_jual" type="text" name='retail_price'
							class="easyui-validatebox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>Trading Price</strong></td>
						<td><input id="trading_price" type="text" name='trading_price'
							class="easyui-validatebox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>BKP</strong></td>
						<td><select id="bkp" type="text" name='taxed'
							class="easyui-combobox" style="width: 50%" panelHeight="auto">
								<option value="t">YES</option>
								<option value="f">NO</option>
						</select></td>
					</tr>
					<tr>
						<td><strong>Consignment</strong></td>
						<td><select id="consignment" type="text" name='consignment'
							class="easyui-combobox" style="width: 50%" panelHeight="auto">
								<option value="t">YES</option>
								<option value="f">NO</option>
						</select></td>
					</tr>
					<tr>
						<td><strong>Status SKU</strong></td>
						<td><select id="status_sku_input" type="text" name='status_sku'
							class="easyui-combobox" style="width: 50%" panelHeight="auto">
								<option value="ACTIVE">ACTIVE</option>
								<option value="INACTIVE">INACTIVE</option>
								<option value="DISCONTINUE">DISCONTINUE</option>
						</select></td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table width="100%" border="0">
					<tr>
						<td width="40%"><strong>Kategori LVL 1</strong></td>
						<td><input name="category1" method="post" id="cat1" style="width: 100%" required="true" /></td>
					</tr>
					<tr>
						<td><strong>Kategori LVL 2</strong></td>
						<td><input name="category2" method="post" id="cat2" style="width: 100%" required="true" /></td>
					</tr>
					<tr>
						<td width="25%"><strong>Kategori LVL 3</strong></td>
						<td><input name="category3" method="post" id="cat3" style="width: 100%" required="true" /></td>
					</tr>
					<tr>
						<td><strong>Kategori LVL 4</strong></td>
						<td><input name="category4" method="post" id="cat4" style="width: 100%" required="true" /></td>
					</tr>
					<tr>
						<td><strong>Satuan</strong></td>
						<td><input id="satuan" class="easyui-combobox" name="uom_id"
							url="<?php echo site_url('master/UOM/get') ?>" method="post"
							valueField="id" textField="code"
							data-options="formatter: unitformat" style="width: 100%"
							required="true" mode="remote" panelHeight="auto" /> <script
								type="text/javascript">
                    function unitformat(row) {
                        return '<span style="font-weight:bold;">' + row.code + '</span><br/>' +
                                '<span style="color:#888">Desc: ' + row.name + '</span>';
                    }
                </script></td>
					</tr>
					<tr>
						<td><strong>BOM ?</strong></td>
						<td><select id="bom" type="text" name='bom_status'
							class="easyui-combobox" style="width: 50%">
								<option value="t">YES</option>
								<option value="f">NO</option>
						</select></td>
					</tr>
					<tr>
						<td width="25%"><strong>Type</strong></td>
						<td width="75%"><select id="type" type="text" name='type'
							class="easyui-combobox" style="width: 50%" panelHeight="auto">
								<option value="1">Retail</option>
								<option value="2">Material</option>
								<option value="3">Trading</option>
						</select></td>
					</tr>
					<tr>
						<td width="25%"><strong>CARTON</strong></td>
						<td width="75%"><input id="carton" type="text" name='carton'
							class="easyui-validatebox" style="width: 50%" /></td>
					</tr>
					<tr>
						<td><strong>INNER</strong></td>
						<td><input id="inner" type="text" name='inner'
							class="easyui-validatebox" style="width: 50%" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
		   function initCombo1(){
            	var deferredObject= $.Deferred();
            	$('#cat1').combobox({
            		url: "<?php echo site_url('master/category/get_data/1') ?>",
            		valueField: "id", 
            		textField: "name",
            		panelHeight: "auto",
            		mode: "remote",
            		onSelect: function(row){
            			$('#cat2').combobox('reload',base_url + '/master/item/get_category2/'+row.id);
            		},
            		onLoadSuccess: function(){
            			deferredObject.resolve();
                    }
            	});
        		return deferredObject.promise();
          }

          function initCombo2(){
            	var deferredObject= $.Deferred();
            	$('#cat2').combobox({
            		url: "<?php echo site_url('/master/category/get_data/2') ?>",
            		valueField: "id", 
            		textField: "name",
            		panelHeight: "auto",
            		mode: "remote",
            		onSelect: function(row){
            			$('#cat3').combobox('reload',base_url + '/master/item/get_category3/'+row.id);
            		},
            		onLoadSuccess: function(){
            			deferredObject.resolve();
                    }
            	});
        		return deferredObject.promise();
          }

          function initCombo3(){
          	var deferredObject= $.Deferred();
          	$('#cat3').combobox({
          		url: "<?php echo site_url('/master/category/get_data/3') ?>",
          		valueField: "id", 
          		textField: "name",
          		panelHeight: "auto",
          		mode: "remote",
          		onSelect: function(row){
          			$('#cat4').combobox('reload',base_url + '/master/item/get_category4/'+row.id);
          		},
          		onLoadSuccess: function(){
          			deferredObject.resolve();
                }
          	});
      		return deferredObject.promise();
        }

          function initCombo4(){
            	var deferredObject= $.Deferred();
            	$('#cat4').combobox({
            		url: "<?php echo site_url('/master/category/get_data/4') ?>",
            		valueField: "id", 
            		textField: "name",
            		panelHeight: "auto",
            		mode: "remote",
            		onLoadSuccess: function(){
            			deferredObject.resolve();
                    }
            	});
        		return deferredObject.promise();
          }

          function populateEditForm(){
              if (editItemFlag == "edit") {
                	 $('#bom').combo('readonly', true);
               		 $('#cat1').combo('readonly', true);
                     $('#cat2').combo('readonly', true);
                     $('#cat3').combo('readonly', true);
                     $('#cat4').combo('readonly', true);
                  if($('#status_sku_input').combobox('getValue') == 'DISCONTINUE'){
              		$('#status_sku_input').combo('readonly', true);
              		$('#bkp').combo('readonly', true);
              		$('#consignment').combo('readonly', true);
              		$('#satuan').combo('readonly', true);
              		$('#type').combo('readonly', true);
              		document.getElementById("trading_price").readOnly = true;
              		document.getElementById("sku").readOnly = true;
              		document.getElementById("nama").readOnly = true;
              		document.getElementById("barcode").readOnly = true;
              		document.getElementById("hrg_pokok").readOnly = true;
              		document.getElementById("hrg_jual").readOnly = true;
              		document.getElementById("carton").readOnly = true;
              		document.getElementById("inner").readOnly = true;
              	}
              }
          }
          
    jQuery(document).ready(function(){
 	var row = $('#item').datagrid('getSelected');
	$('#item_input_form').form('load', row);
    	
    	var initCombo1promise= initCombo1();
    	initCombo1promise.done(function(){
    		console.log("promise 1 finish");
        	var initCombo2promise= initCombo2();
        	initCombo2promise.done(function(){
        		console.log("promise 2 finish");
        		var initCombo3promise= initCombo3();
        		initCombo3promise.done(function(){
            		console.log("promise 3 finish");
            		var initCombo4promise= initCombo4();
            		initCombo4promise.done(function(){
                		console.log("promise 4 finish");
                		populateEditForm();
                    });
                });
            });
        });
        
    });
</script>

<script>
	function item_save() {
		$('#item_input_form').form('submit', {
			url : item_url,
			onSubmit : function() {
				return $(this).form('validate');
			},
			success : function(content) {
				console.log(content);
				var result = eval('(' + content + ')');
				if (result.success) {
					$('#item_dialog').dialog('close');
					$('#item').datagrid('reload');
				} else {
					$.messager.alert('Error', result.msg, 'error');
				}
			}
		});
	}
</script>