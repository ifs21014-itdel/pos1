<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>POS</title> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/easyui.region.select.css"> 
        <script type="text/javascript">var base_url = '<?php echo site_url() ?>';</script>
        <script type="text/javascript" src="<?php echo base_url() ?>easyui/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>easyui/datagrid-filter.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>easyui/datagrid-detailview.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>easyui/easyui.region.select.min.js"></script>
    </head>
    <body id="bodydata" class="easyui-layout">
       <div region="west" split="true" collapsible="true" title="Main Menu" style="width: 215px;padding-left: 3px;">
            <?php if(Authority::isUserAuthenticated()){
                      if(Authority::getUserLanguage() === "english"){?>
                		<span><b>English</b></span>
                	<?php } else {?>
                		<a href="<?php echo site_url($this->config->item('PATH_URI_SWITCH_LANGUAGE'))."?l=english"?>"><b>English</b></a>
                	<?php }?>
                	&nbsp;|&nbsp;
                	<?php if(Authority::getUserLanguage() === "bahasa"){?>
                		<span><b>Bahasa</b></span>
                	<?php }else{?>
                		<a href="<?php echo site_url($this->config->item('PATH_URI_SWITCH_LANGUAGE'))."?l=bahasa";?>"><b>Bahasa</b></a>
                	<?php }
				}?>
            <br/>
            <?php echo $store_name;?>
            <br/>
            
            <ul id="left_menu" class="easyui-tree" lines='true' style="padding-left: 3px;padding-top: 5px;">
	        	<?php if(Authority::hasPermission(Permission::CASHIER_VIEW_CART)){?>
                <li iconCls="icon-sales-item" expanded="false" collapsed="false"><a onclick="openCashierWindow('<?php echo site_url("/cashier/sales/index")?>')"><b>Chasier</b> </a></li>
                <?php }?>
	            <?php foreach ($list_menu_item as $menu_item){ 
	            		if(!$menu_item['is_use_category']){ ?>
	            	<li iconCls="<?php echo $menu_item['list_menu_item'][0]['icon_class'];?>">
			    		<a onclick="addTab('<?php echo $menu_item['list_menu_item'][0]['name'];?>', '<?php echo $menu_item['list_menu_item'][0]['url_page'];?>')"><b><?php echo $menu_item['list_menu_item'][0]['name'];?></b></a>
			    	</li>
			    <?php } else { ?>
		    		<li data-options="state:'closed'" iconCls="<?php echo $menu_item['category_detail']['category_icon_class'];?>">
		    			<span style="font-size: 30px;"><b><?php echo $menu_item['category_detail']['category_name'];?></b></span>
		    		    <ul>
		    		    <?php foreach ($menu_item['list_menu_item'] as $menu_child){ ?>
		                    <li iconCls="<?php echo $menu_child['icon_class'];?>">
		                    	<a href="javascript:void(0)" onclick="addTab('<?php echo $menu_child['name'];?>','<?php echo $menu_child['url_page'];?>')"><b><?php echo $menu_child['name'];?></b></a>
		                    </li>
		    		    <?php }?>
	    				</ul>
	               </li>
			    	<?php }
			    }?>
			    <?php if(Authority::isUserAuthenticated()){?>
                <li iconCls="icon-sales-item" expanded="false" collapsed="false"><a href="<?php echo site_url("/master/version_app/getUpdate")?>"><b>Update Application</b> </a></li>
                <?php }?>
                <?php if(Authority::isUserAuthenticated()){?>
                <li iconCls="icon-sales-item" expanded="false" collapsed="false"><a href="<?php echo site_url("/master/db_version/UpdateDb")?>"><b>Update DB</b> </a></li>
                <?php }?>
			    <?php if(Authority::isUserAuthenticated()){?>
                <li iconCls="icon-change-password"><a href="<?php echo site_url($this->config->item('PATH_URI_LOGOUT'))?>"><b>Logout</b> </a></li>
                <li iconCls="icon-change-password">
                	<span><a href="javascript:window.location.href='/closekiosk';"><b>[Exit Window]</b> </a></span>
                </li>
                <?php }?>
            </ul>
        </div>
    	<div region="center" data-options="region:'center',iconCls:'icon-ok'" border="false">
            <div id="main-tab" class="easyui-tabs" data-options="fit:true,tabHeight:20">
                <div title="Home">
                
                </div>                
            </div>
        </div>
        <div region='south' split="true" border="true" style="height: 3%;">
            <center>@Bezmart 2015</center>
        </div>
        <div id="global_dialog"></div> 
        <script type="text/javascript" src="<?php echo base_url() ?>js/global.js"></script>
        <iframe name="box_iframe" width="1" height="1"></iframe>
        <script type="text/javascript">
			function openCashierWindow(url){
				window.location.href = url;
				
// 				window.open(url,'NewWindow','width='+screen.availWidth-10+',height='+screen.availHeight-55+
// 						',status=yes,menubar=yes,scrollbars=yes,resizable=yes,toolbar=no,screenX=0,screenY=0,left=0,top=0');
			}
        </script>
    
    </body>
</html>
