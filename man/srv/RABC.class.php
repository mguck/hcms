<?php
/*权限控制*/

class RABC{
	public $pd;//数据库连接
	public $gid;
	public $group_info;
	public $menu_info;
	
	function __construct($id,$pd){
		$this->gid=$id;
		$this->pd=$pd;
		$this->group_info=$this->getGroupInfoById();
	}
	//获取该用户的用户组信息
	public function getGroupInfoById(){
		$group_info=$this->pd->query("select * from `osa_user_group` where group_id=".$this->gid)->fetch(PDO::FETCH_ASSOC);
		return $group_info;
	}
	//获取该用户的权限功能信息
	public function getMenuInfo(){
		$auth_id_list=$this->group_info['group_role'];
		$menu_info=$this->pd->query("select * from `osa_menu_url` where menu_id in (".$auth_id_list.") order by odx")->fetchAll(PDO::FETCH_ASSOC);
		$this->menu_info=$menu_info;
		return $menu_info;
	}
	//获取该用户的权限功能url列表
	public function getMenuUrl(){
		$auth_id_list=$this->group_info['group_role'];
		$menu_url_list=$this->pd->query("select GROUP_CONCAT(menu_url) from `osa_menu_url` where menu_id in (".$auth_id_list.")")->fetchColumn(0);
		return explode(",",$menu_url_list);
	}
	//判断该url是否在该用户权限功能列表中
	public function checkUrl($url){
		$auth_id_arr=explode(",", $this->group_info['group_role']);
		$men_url_arr=$this->getMenuUrl(); 
		if($men_url_arr){
			if(in_array($url, $men_url_arr)){
				return true;
			}
		}			
		return false;
	}
	public static function checkUrl2($url){
		$men_url_arr=$_SESSION['rabc_url'];//获取存入session的url列表 
		if($men_url_arr){
			if(in_array($url, $men_url_arr)){
				return true;
			}
		}			
		return false;
	}
	//根据跟菜单id获取子菜单信息
	public function getChildMenuInfo($fatherId){
		$child_menu_arr=array();
		foreach($this->menu_info as $k=>$menu){
			if($menu['father_menu']==$fatherId&&$menu['is_show']=='1'){
				$child_menu_arr[]=$menu;
			}
		}
		return $child_menu_arr;
	}
	
}



?>