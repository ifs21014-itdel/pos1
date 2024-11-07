<?php
/**
 * @author Rizal Gurning
 */
class Model_menu_item extends MY_Model {

	public $table_name = "kds_menu_item";
	
    public function __construct() {
        parent::__construct();
    }

    public function getMenuItemByCurrentUser(){
    	return $this->getMenuItemByUser($this->session->userdata('username'));
    }
    
    public function getMenuItemByUser($userName){
    	$query = " select mi.id, mi.url_page, mi.name, mi.icon_class, mc.id as category_id, mi.code,
 		   			mc.name as category_name, mc.icon_class as category_icon_class, mc.code as category_code
    				from xs_menu_item mi
					inner join xs_menu_item_category mc on mc.id = mi.menu_item_category_id
					inner join xs_menu_item_permission_mask mpm on mpm.menu_item_id = mi.id
					inner join xs_permission_mask pm on pm.id = mpm.permission_mask_id
					inner join kds_role_permission_mask rpm on rpm.permission_mask_id = pm.id
					inner join kds_user_role ur on ur.role_id = rpm.role_id
					inner join kds_user u on u.id = ur.user_id
					where u.username =? and mi.active = true order by mc.sequence, mi.sequence";
		$param = array (
			$userName
		);
		$result =  $this -> execute_query($query, $param) -> result();
		$menu_item_per_category = array();
		foreach ($result as $row) {
			$menu_item = array(
				"id" => $row->id,
				"url_page" => $row->url_page,
				"name" => $row->name,
				"icon_class" => $row->icon_class,
				"category_name" => $row->category_name
			);
			
			$is_use_category = $row -> category_id > 0 ? true : false;
			$key_array_menu_item = $row->category_code;
			if(!$is_use_category){
				$key_array_menu_item = $row->code;
			}
			
			if(! isset($menu_item_per_category[$key_array_menu_item])){
				$menu_body = array(
					"is_use_category" => $is_use_category,
					"category_detail" => array(
						"category_name" => $row->category_name,
						"category_icon_class" => $row->category_icon_class
					),
					"list_menu_item" => array()
				);
				$menu_item_per_category[$key_array_menu_item] = $menu_body;
			}
			array_push($menu_item_per_category[$key_array_menu_item]['list_menu_item'], $menu_item);
		}
		return $menu_item_per_category;
    }

    function get_menu_items_with_pagination($page, $rows, $filterByName, $filterByCode){
    	$queryStruct = array(
    		"select" => " m.id,m.url_page,m.name,mc.name as category_name,m.icon_class,m.code,m.sequence,pm.code as permission_mask_code ",
    		"from" => " xs_menu_item m join xs_menu_item_category mc on mc.id = m.menu_item_category_id
						join xs_menu_item_permission_mask mpm on mpm.menu_item_id = m.id
						join xs_permission_mask pm on pm.id = mpm.permission_mask_id ",
    		"where" =>"",
    		"order_by" => " mc.name asc, m.code asc "
    	);
    	if (!empty($filterByName)) {
    		$queryStruct['where'] .= " m.name ilike '%$filterByName%' ";
    	}
    	if (!empty($filterByCode)) {
    		if(!empty($queryStruct['where'])){
    			$queryStruct['where'] .= " and ";
    		}
    		$queryStruct['where'] .= " m.code ilike '%$filterByCode%' ";
    	}
    	$param = array();
    	return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
    }
    
}
