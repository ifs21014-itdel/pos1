<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>POS</title> 
        <link rel="stylesheet" type="text/css" href="easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="css/style.css"> 
        <link rel="stylesheet" type="text/css" href="css/easyui.region.select.css"> 
        <script type="text/javascript">var base_url = '<?php echo base_url() ?>index.php';</script>
        <script type="text/javascript" src="easyui/jquery.min.js"></script>
        <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="easyui/datagrid-filter.js"></script>
        <script type="text/javascript" src="easyui/datagrid-detailview.js"></script>
        <script type="text/javascript" src="easyui/easyui.region.select.min.js"></script>
    </head>
    <body id="bodydata" class="easyui-layout">
        <!--        <div region="north" border='false' style="width: 20%;background:#d3e1f1;">
                    &nbsp;
                </div>-->
        <div region="west" split="true" collapsible="true" title="Main Menu" style="width: 15%;padding-left: 3px;">
            <span style="font-size: 12px;font-weight: bold;">Box Living</span>
            <ul class="easyui-tree" lines='true' style="padding-left: 3px;padding-top: 5px;">
                <li iconCls="icon-change-password"><a onclick="openCashierWindow('./index.php/cashier/sales/index')"><b>Chasier</b> </a></li>                         
                <li iconCls="icon-main-menu"><span style="font-size: 30px;"><b>Order Management</b></span>
                    <ul>
                        <li iconCls="icon-user"><a href="javascript:void(0)" onclick="addTab('Barang', '/master/item')"><b>Barang</b></a></li>
                        <li iconCls="icon-user"><a href="javascript:void(0)" onclick="addTab('Satuan', '/master/unit')"><b>Satuan</b></a></li>
                        <li iconCls="icon-user"><a href="javascript:void(0)" onclick="addTab('Kategori', '/master/category')"><b>Kategori</b></a></li>
						<li iconCls="icon-user"><a href="javascript:void(0)" onclick="addTab('Purchase Order', '/master/po')"><b>Purchase Order</b></a></li>
						<li iconCls="icon-user"><a href="javascript:void(0)" onclick="addTab('Supplier', '/master/supplier')"><b>Supplier</b></a></li>
						<li iconCls="icon-user"><a href="javascript:void(0)" onclick="addTab('Vendor Item', '/master/vendor_item')"><b>Vendor Item</b></a></li>
                    </ul>
                </li>                
                <li iconCls="icon-change-user"><a href="javascript:void(0)" onclick="changepassword()"><b>Change Password</b> </a></li>
                <li iconCls="icon-change-password"><a href="./home/logout"><b>Logout</b> </a></li>
            </ul>
        </div>
        <div region="center" data-options="region:'center',iconCls:'icon-ok'" border="false">
            <div id="main-tab" class="easyui-tabs" data-options="fit:true,tabHeight:20">
                <div title="Home">

                </div>                
            </div>
        </div>
        <div region='south' split="true" border="true" style="height: 3%;">
            <center>Create By PT. Karya Data Solusi 2015</center>
        </div>
        <div id="global_dialog"></div>    
        <script type="text/javascript" src="js/global.js"></script>
        <iframe name="box_iframe" width="1" height="1"></iframe>
        <script type="text/javascript">
			function openCashierWindow(url){
				window.open(url,'NewWindow','width='+screen.availWidth-10+',height='+screen.availHeight-55+
						',status=yes,menubar=yes,scrollbars=yes,resizable=yes,toolbar=no,screenX=0,screenY=0,left=0,top=0');
			}
        </script>
    </body>
</html>