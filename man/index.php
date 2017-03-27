<?php
/*主站 管理中心 */
header("Content-type: text/html; charset=utf-8;");
require('../ppf/360_safe3.php');  
require('../ppf/fun.php');
require('../ppf/pdo_mysql.php');
require("../ppf/pdo_template.php");
require("../ppf/browser.php");
require("./srv/RABC.class.php");
$qname=isset($_GET["t"])?$_GET["t"]:"index"; 
 
if (!session_id()) session_start(); 
$pd=new pdo_mysql();
if($qname!="login"&&$qname!="error"&&$qname!="exit"){
	chkLogin("uid","/man/?t=login");
	//检测用户是否有该页面的权限
	if(!RABC::checkUrl2("/man/?t=".$qname)){
		echo "<script language='javascript' type='text/javascript'>";
		echo "document.location='/man/?t=error'";
		echo "</script>";
	}
	$uid=$_SESSION['uid']; 
}
$T=new pdo_template('./html/'.$qname.'.htm');   
$T->SetTpl('css','css.inc');
$T->SetTpl('js','js.inc');
$T->SetTpl('ppf','ppf.inc');     
switch($qname){    
	case "login":#首页
	  if(isset($_SESSION['uid'])){
		header("Location:/man/");         
	  } 
	#检测浏览器版本针对IE
	$brow=getBrowser().getBrowserVer();
	if($brow=="ie5"||$brow=="ie6"||$brow=="ie7"||$brow=="ie8"||$brow=="ie9"){
		Header("Location: /?t=ie"); 
	}
	if(isset($_GET["url"]))
	    $T->Set("tourl",url_base64_decode($_GET["url"]));
	$request_uri_arr=explode("?",$_SERVER["REQUEST_URI"]);
	$request_uri=$request_uri_arr[1];
	$request_uri="/?".$request_uri;
    //$request_uri="/?".explode("?",$_SERVER["REQUEST_URI"])[1];//低版本报错，太长
    $tl_url=APP_LOGIN."/?t=login&url=".url_base64_encode($request_uri);
    $T->Set("tl_url",$tl_url);
	break;
  case "exit":#退出
	if(isset($_SESSION["uid"])){
		  unset($_SESSION["uid"]);
		  session_destroy();#session_unset(); 
	 }
	 
	break; 
 
  case "arts":
    $p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $cid=isset($_GET["c"])?$_GET["c"]:"";
	$state=isset($_GET["state"])?$_GET["state"]:"";
    if($p<1)$p=1;
    $wh="";  
	$wh_s1="";
	$wh_s2="";
    if(!empty($cid))$wh=$wh." and (cid=".$cid." or pid=".$cid.") ";        
    if(!empty($so))$wh=$wh." and ma.name like '%".$so."%'";
	if($state!=""){
		$wh_s1=" and `state`='".$state."'";
		$wh_s2=" and ma.`state`='".$state."'";
	};
    $rc= $T->db->query("select count(1) from `main_article` ma left join main_art_category mac on mac.id=ma.cid where ma.id>0".$wh.$wh_s1)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=arts&c=".$cid."&so=".$so);
    $T->Set("page",$page); 
    $T->SetBlock("list","select ma.*,M.truename,mac.astyle from `main_article` ma left join act_member M on M.id=ma.uid left join main_art_category mac on mac.id=ma.cid where ma.id>0".$wh.$wh_s2." order by ma.CreateTime desc limit ".(($p-1)*15).",15");
    $T->Set("so",$so);
	break;  
  case "myarts":
    $p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $cid=isset($_GET["c"])?$_GET["c"]:"";
	$state=isset($_GET["state"])?$_GET["state"]:"";
    if($p<1)$p=1;
    $wh="";  
	$wh_s1="";
	$wh_s2="";
    if(!empty($cid))$wh=$wh." and (cid=".$cid." or pid=".$cid.") ";        
    if(!empty($so))$wh=$wh." and ma.name like '%".$so."%'";
	if($state!=""){
		$wh_s1=" and `state`='".$state."'";
		$wh_s2=" and ma.`state`='".$state."'";
	};
    $rc= $T->db->query("select count(1) from `main_article` ma left join main_art_category mac on mac.id=ma.cid where ma.id>0".$wh.$wh_s1." and uid='".$uid."' ")->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=arts&c=".$cid."&so=".$so);
    $T->Set("page",$page); 
    $T->SetBlock("list","select ma.*,M.truename from `main_article` ma left join act_member M on M.id=ma.uid left join main_art_category mac on mac.id=ma.cid where ma.id>0".$wh.$wh_s2." and uid='".$uid."' order by ma.CreateTime desc limit ".(($p-1)*15).",15");
    $T->Set("so",$so);
	$T->Set("uid",$uid);
	break;  
  case "art_cate":
   /* $cate_info=$T->db->query("select id,pid,name from `main_art_category` where visible=1")->fetchAll(PDO::FETCH_ASSOC);
    $tree_arr=get_tree_arr($cate_info,0);
    
    $tree_html=get_tree_html($tree_arr);echo json_encode($cate_info);exit;
    $T->Set("tree_arr",json_encode($tree_arr));
    $T->Set("tree_html",$tree_html);
    $T->Set("tree_list",json_encode($cate_info));*/
    /*exit;
    $T->SetBlock2("category_tree_list", "select id,name from main_art_category where pid=0 order by id", array(array("block"=>"rp","pid"=>"id","sql"=>"select id,name from main_art_category where pid=?")));*/
    
    break;
  case "art_auth":
	$T->SetBlock("group_list", "select group_id,group_name from `osa_user_group` order by group_id desc");
	$T->SetBlock2("main_menu_list", "select menu_id,menu_name,father_menu from `osa_menu_url` where father_menu=0 order by odx", array(array("block"=>"include_menu_list","pid"=>"menu_id","sql"=>"select menu_id,menu_name,father_menu from `osa_menu_url` where father_menu=?"))); 
	break;
  case "art_am":
     if(!empty($_GET["id"])){
       $thumb= $T->db->query("select thumb from `main_article` where id=".$_GET["id"])->fetchColumn(0);
       $T->Set("thumb",$thumb);
     }
     break;
  case "art_myam":
     if(!empty($_GET["id"])){
       $thumb= $T->db->query("select thumb from `main_article` where id=".$_GET["id"])->fetchColumn(0);
       $T->Set("thumb",$thumb);
     }
	 $art_audit_auth=$T->db->query("select oug.art_audit_auth from `act_member` am left join osa_user_group oug on oug.group_id=am.user_group where am.id='".$uid."' ")->fetchColumn(0);
	 //判断是否有审核权限
	 if($art_audit_auth=="0"){
		$T->Set("state","2");
	 }else{
		$T->Set("state","0");
	 }
	 $T->Set("uid",$uid);
     break;
  case "consult":
    $p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $cid=isset($_GET["c"])?$_GET["c"]:""; 
    if($p<1)$p=1;
    $wh="";                                           
    if(!empty($cid))$wh=" and cid=".$cid;        
    if(!empty($so))$wh=" and title like '%".$so."%'";
    $rc= $T->db->query("select count(1) from `consult_art` where id>0".$wh)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=arts&c=".$cid."&so=".$so);
    $T->Set("page",$page); 
    $T->SetBlock("list","select T.*,M.truename from `consult_art` T left join act_member M on M.id=T.uid where T.id>0".$wh." order by T.id desc limit ".(($p-1)*15).",15",array("endtime"),array("%Y-%m-%d %H:%M"));
    $T->Set("so",$so);
	  break;
  case "consult_cate":
	 
     $T->SetBlock("list","select * from `consult_art_category` order by odx desc,id desc",array("endtime"),array("%Y-%m-%d"));
    
    break;
  case "consult_am":
	$id=isset($_GET["id"])?$_GET["id"]:""; 
	
	$des= $T->db->query("select des from `consult_art_comment` where aid={$id} order by id desc  limit 1")->fetchColumn(0);
	$T->Set("backdes",$des);
	break;
  case "videos":
    $p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $cid=isset($_GET["c"])?$_GET["c"]:"0"; 
    if($p<1)$p=1;
    $wh="";                                           
    if(!empty($cid))$wh=" and cid=".$cid;        
    if(!empty($so))$wh=" and name like '%".$so."%'";
    $rc= $T->db->query("select count(1) from `main_video` where id>0".$wh)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=videos&c=".$cid."&so=".$so);
    $T->Set("page",$page); 
    $T->SetBlock("list","select T.*,M.truename from `main_video` T left join act_member M on M.id=T.uid where T.id>0".$wh." order by T.timestamp desc limit ".(($p-1)*15).",15");
    $T->Set("so",$so);
    break;   
  case "video_cate":
    $T->SetBlock("list","select * from `main_video_category` order by odx desc");
    break;
  case "act":
    $p=isset($_GET["p"])?$_GET["p"]:"1"; 
    if($p<1)$p=1;
    $u=isset($_GET["u"])?$_GET["u"]:"";
    $n=isset($_GET["n"])?$_GET["n"]:"";
    $k=isset($_GET["k"])?$_GET["k"]:"";
    $i=isset($_GET["i"])?$_GET["i"]:"";      
    $wh="";
    if(!empty($u))$wh.=" and username like '%".$u."%'";
    if(!empty($n))$wh.=" and truename like '%".$n."%'";
    if(!empty($k))$wh.=" and nick like '%".$k."%'";
    if(!empty($i))$wh.=" and idtype = ".$i."";      
    $rc= $T->db->query("select count(1) from `act_member` where id!='' ".$wh)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=act&u=".$u."&n=".$n."&k=".$k."&i=".$i);
    $T->Set("page",$page); 
    $T->SetBlock("list","select * from act_member where id!='' ".$wh." order by timestamp desc limit ".(($p-1)*15).",15");
    break;    
  case "videos":
    $p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $cid=isset($_GET["c"])?$_GET["c"]:"0"; 
    if($p<1)$p=1;
    $wh="";                                           
    if(!empty($cid))$wh=" and cid=".$cid;        
    if(!empty($so))$wh=" and name like '%".$so."%'";
    $rc= $T->db->query("select count(1) from `main_video` where id>0".$wh)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=videos&c=".$cid."&so=".$so);
    $T->Set("page",$page); 
    $T->SetBlock("list","select T.*,M.truename from `main_video` T left join act_member M on M.id=T.uid where T.id>0".$wh." order by T.timestamp desc limit ".(($p-1)*15).",15");
    $T->Set("so",$so);
    break;   
  case "video_cate":
    $T->SetBlock("list","select * from `main_video_category` order by odx desc");
    break;
  case "admin":
    $p=isset($_GET["p"])?$_GET["p"]:"1";  
    if($p<1)$p=1; 
    $rc= $T->db->query("select count(1) from `main_member`")->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=admin");
    $T->Set("page",$page); 
    $T->SetBlock("list","select T.*,M.truename,M.nick,M.username from `main_member` T left join act_member M on M.id=T.uid order by T.timestamp desc limit ".(($p-1)*15).",15");
    break;  
	
	case "homepage_cate":
     $T->SetBlock("list","select * from `push_category` where push_type = 1 order by odx desc");
    break;
	case "groupm_cate":
     $T->SetBlock("list","select * from `push_category` where push_type = 2 order by odx desc");
    break;
	case "agency_cate":
     $T->SetBlock("list","select * from `push_category` where push_type = 3 order by odx desc");
    break;
	case "classm_cate":
     $T->SetBlock("list","select * from `push_category` where push_type = 4 order by odx desc");
    break;
	case "studio_cate":
     $T->SetBlock("list","select * from `push_category` where push_type = 5 order by odx desc");
    break;
	case "homepage":
    $p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $cid=isset($_GET["c"])?$_GET["c"]:"0"; 
    if($p<1)$p=1;
    $wh=" and push_type=1";
    if(!empty($cid))$wh.=" and cid=".$cid;        
    if(!empty($so))$wh.=" and title like '%".$so."%'";
    $rc= $T->db->query("select count(1) from `push_list` where id>0".$wh)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=homepage&c=".$cid."&so=".$so);
    $T->Set("page",$page); 
    $T->SetBlock("list","select T.*,M.truename from `push_list` T left join act_member M on M.id=T.uid where T.id>0".$wh." order by T.timestamp desc limit ".(($p-1)*15).",15");
    break;
	case "groupm":
    $p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $cid=isset($_GET["c"])?$_GET["c"]:"0"; 
    if($p<1)$p=1;
    $wh=" and push_type=2";
    if(!empty($cid))$wh.=" and cid=".$cid;        
    if(!empty($so))$wh.=" and title like '%".$so."%'";
    $rc= $T->db->query("select count(1) from `push_list` where id>0".$wh)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=homepage&c=".$cid."&so=".$so);
    $T->Set("page",$page); 
    $T->SetBlock("list","select T.*,M.truename from `push_list` T left join act_member M on M.id=T.uid where T.id>0".$wh." order by T.timestamp desc limit ".(($p-1)*15).",15");
    break;
	case "agency":
    $p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $cid=isset($_GET["c"])?$_GET["c"]:"0"; 
    if($p<1)$p=1;
    $wh=" and push_type=3";
    if(!empty($cid))$wh.=" and cid=".$cid;        
    if(!empty($so))$wh.=" and title like '%".$so."%'";
    $rc= $T->db->query("select count(1) from `push_list` where id>0".$wh)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=homepage&c=".$cid."&so=".$so);
    $T->Set("page",$page); 
    $T->SetBlock("list","select T.*,M.truename from `push_list` T left join act_member M on M.id=T.uid where T.id>0".$wh." order by T.timestamp desc limit ".(($p-1)*15).",15");
    break;
	case "classm":
    $p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $cid=isset($_GET["c"])?$_GET["c"]:"0"; 
    if($p<1)$p=1;
    $wh=" and push_type=4";
    if(!empty($cid))$wh.=" and cid=".$cid;        
    if(!empty($so))$wh.=" and title like '%".$so."%'";
    $rc= $T->db->query("select count(1) from `push_list` where id>0".$wh)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=homepage&c=".$cid."&so=".$so);
    $T->Set("page",$page); 
    $T->SetBlock("list","select T.*,M.truename from `push_list` T left join act_member M on M.id=T.uid where T.id>0".$wh." order by T.timestamp desc limit ".(($p-1)*15).",15");
    break;
	case "studio":
    $p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $cid=isset($_GET["c"])?$_GET["c"]:"0"; 
    if($p<1)$p=1;
    $wh=" and push_type=5";
    if(!empty($cid))$wh.=" and cid=".$cid;        
    if(!empty($so))$wh.=" and title like '%".$so."%'";
    $rc= $T->db->query("select count(1) from `push_list` where id>0".$wh)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=homepage&c=".$cid."&so=".$so);
    $T->Set("page",$page); 
    $T->SetBlock("list","select T.*,M.truename from `push_list` T left join act_member M on M.id=T.uid where T.id>0".$wh." order by T.timestamp desc limit ".(($p-1)*15).",15");
    break;
	
  case "tpl":
    $p=isset($_GET["p"])?$_GET["p"]:"1";                     
    $rc=$T->db->query("select count(1) from sys_tpl_index where state=2")->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=tpl");
      $T->Set("page",$page); 
      $T->SetBlock("list","select * from sys_tpl_index where state=2 limit ".(($p-1)*15).",15");  
      $T->ReadDB("select tpl from `main` where id=1");    
    break;  
  case "index": #g首页          
    $T->ReadDB("SELECT am.id,oug.group_name,am.truename from act_member am left join osa_user_group oug on oug.group_id=am.user_group where am.id='".$uid."'");
    $rabc=new RABC($_SESSION['user_group'],$pd);
    $menu_info=$rabc->getMenuInfo();
	$menu_str="";
	/*foreach($menu_info as $k=>$menu){
		if($menu['father_menu']=='0'&&$menu['is_show']=='1'){
		    $menu_str.='<li><a href="'.$menu['menu_url'].'" class="J_menuItem"><i class="fa fa-comment-o"></i><span class="nav-label">'.$menu['menu_name'].'</span><span class="fa arrow"></span></a></li>';
		}
	}*/
	foreach($rabc->getChildMenuInfo(0) as $k=>$menu){
		$menu_str.='<li><a href="'.$menu['menu_url'].'" class="J_menuItem"><i class="'.$menu['menu_icon'].'"></i><span class="nav-label">'.$menu['menu_name'].'</span><span class="fa arrow"></span></a>';
		$child_info=$rabc->getChildMenuInfo($menu['menu_id']);
		if($child_info){
			foreach($child_info as $kc=>$menuc){
				$menu_str.='<ul class="nav nav-second-level"><li><a class="J_menuItem" href="'.$menuc['menu_url'].'" data-index="0"><i class="'.$menuc['menu_icon'].'"></i>'.$menuc['menu_name'].'</a></li></ul>';
			}
		}
		$menu_str.='</li>';
	}
	$T->Set("menu_list", $menu_str);
    break; 
  case "menu_list":
	$T->SetBlock("main_menu", "select menu_id,menu_name from `osa_menu_url` where father_menu=0");
	$p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $mid=isset($_GET["mid"])?$_GET["mid"]:"";
    $ism=isset($_GET["ism"])?$_GET["ism"]:""; 
    if($p<1)$p=1;
    $wh="";                                           
    $wh.=(!empty($mid))?" and (m1.menu_id=".$mid." or m1.father_menu=".$mid.") ":"";
    if(!empty($ism)){
	    $wh.=(!empty($ism)&&$ism==1)?" and m1.is_show=1":" and m1.is_show=0";
    }   
    $wh.=(!empty($so))?" and m1.menu_name like '%".$so."%'":"";
    $rc= $T->db->query("select count(1) from `osa_menu_url` m1 where 1=1 ".$wh)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=menu_list&mid=".$mid."&ism=".$ism."&so=".$so);
    $T->Set("page",$page);
    $T->SetBlock("menu_list","select m1.*,m2.menu_name as pmenu_name from `osa_menu_url` m1 left join `osa_menu_url` m2 on m1.father_menu=m2.menu_id where 1=1 ".$wh." order by m1.menu_id,m1.father_menu limit ".(($p-1)*15).",15");
    $T->Set("so",$so);  
    $T->Set("mid",$mid);
    $T->Set("ism",$ism);
	$href_state=url_base64_encode("/man/?p=".$p."&t=menu_list&mid=".$mid."&ism=".$ism."&so=".$so);//用于修改/新增后返回原来页面状态
	$T->Set("href_state", $href_state);
	break;
  case "menu_am":
    $href_state=isset($_GET['href_state'])?url_base64_decode($_GET['href_state']):"";
    $do=isset($_GET['do'])?$_GET['do']:"a";
    $id=isset($_GET['id'])?$_GET['id']:"";
	$T->SetBlock("main_menu", "select menu_id,menu_name from `osa_menu_url` where father_menu=0");
	$T->Set("do", $do);
	$T->Set("menu_id", $id);
	$T->Set("href_state", $href_state);
    break;
  case "user_list":
	$T->SetBlock("group_list", "select group_id,group_name from `osa_user_group` order by group_id");
	$p=isset($_GET["p"])?$_GET["p"]:"1"; 
    $so=isset($_GET["so"])?$_GET["so"]:"";
    $gid=isset($_GET["gid"])?$_GET["gid"]:"";
    $state=isset($_GET["state"])?$_GET["state"]:"";
	$stype=isset($_GET["stype"])?$_GET["stype"]:"1";
    if($p<1)$p=1;
    $wh="";                                           
    $wh.=(!empty($gid))?" and a.user_group=".$gid:"";
    $wh.=($state!='')?" and a.state=".$state:"";//p($wh);  
    if(!empty($so)){
	    $wh.=($stype=='1')?" and a.username like '%".$so."%'":" and a.id=".$so;
    }   
    $rc= $T->db->query("select count(1) from `act_member` a where 1=1 ".$wh)->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=user_list&gid=".$gid."&state=".$state."&stype=".$stype."&so=".$so);
    $T->Set("page",$page);
    $T->SetBlock("user_list","select a.id,a.username,a.email,FROM_UNIXTIME(a.timestamp,'%Y-%m-%d %H:%i:%S') as regtime,FROM_UNIXTIME(a.lasttime,'%Y-%m-%d %H:%i:%S') as lasttime,a.lastip,a.state,g.group_name from `act_member` a left join `osa_user_group` g on a.user_group=g.group_id where 1=1 ".$wh." order by a.id desc limit ".(($p-1)*15).",15");
    $T->Set("so",$so);  
    $T->Set("gid",$gid);
    $T->Set("state",$state);
	$T->Set("stype",$stype); 
	$href_state=url_base64_encode("/man/?p=".$p."&t=user_list&gid=".$gid."&state=".$state."&stype=".$stype."&so=".$so);//用于修改/新增后返回原来页面状态
	$T->Set("href_state",$href_state);  
	break;
  case "user_am":
	$href_state=isset($_GET['href_state'])?url_base64_decode($_GET['href_state']):"";
	$T->Set("href_state", $href_state);
	$T->SetBlock("group_list", "select group_id,group_name from `osa_user_group` order by group_id");  
	break;
  case "user_group":
	$p=isset($_GET["p"])?$_GET["p"]:"1"; 
    if($p<1)$p=1;
    $rc= $T->db->query("select count(1) from `osa_user_group`")->fetchColumn(0);
    $page=getPageHtml_bt($rc,15,$p,"&t=user_group");
    $T->Set("page",$page);
    $T->SetBlock("group_list","select * from `osa_user_group` limit ".(($p-1)*15).",15");
	$href_state=url_base64_encode("/man/?p=".$p."&t=user_group");//用于修改/新增后返回原来页面状态
	$T->Set("href_state", $href_state);    
	break;
  case "group_am":
	$do=isset($_GET['do'])?$_GET['do']:"";
	$id=isset($_GET['id'])?$_GET['id']:"";
	$href_state=isset($_GET['href_state'])?url_base64_decode($_GET['href_state']):"";
	$T->Set("href_state", $href_state);
	$T->Set("group_id", $id);
	$T->Set("do", $do);
	break;
  case "menu_auth":
	$T->SetBlock("group_list", "select group_id,group_name from `osa_user_group` order by group_id desc");
	$T->SetBlock2("main_menu_list", "select menu_id,menu_name,father_menu from `osa_menu_url` where father_menu=0 order by odx", array(array("block"=>"include_menu_list","pid"=>"menu_id","sql"=>"select menu_id,menu_name,father_menu from `osa_menu_url` where father_menu=?")));  
	break;
  case "profile":
    $T->ReadDB("SELECT * from act_member where id='".$uid."'");
    break; 
  case "main":
	$T->ReadDB("select (select count(*) from main_article where uid='".$uid."') as total,(select count(*) from main_article where state='0' and uid='".$uid."') as dsh,(select count(*) from main_article where state='2' and uid='".$uid."') as ysh,(select count(*) from main_article where state='4' and uid='".$uid."') as hsz");
	$T->SetBlock("kjcd_list", "select * from osa_menu_url where menu_url<>'' and shortcut_allowed=1  ORDER BY odx desc");
	$T->SetBlock("yqlj_list", "select * from `links` order by odx desc");
	break;
  case "links":
    $T->SetBlock("links_list", "select * from `links` order by odx desc");
    break;
  case "sys_config":
	$T->Set("DB_DATABASE",DB_DATABASE);
	$T->Set("DB_HOST",DB_HOST);
	$T->Set("DB_PORT",DB_PORT);
	$T->Set("DB_USER",DB_USER);
	$T->Set("DB_PWD",DB_PWD);
	$T->Set("DB_NAME",DB_NAME);
	$T->Set("DB_CHARSET",DB_CHARSET);
	break;
}  
$bid=isset($_SESSION['bid'])?$_SESSION['bid']:'';
$T->Set("bid",$bid);//用于判断是否已经统一登录
$T->Set("gtitle",WEB_NAME);
$T->Set("APP_STATE",APP_STATE);// 用于判断是否开启统一登录
$T->Set("APP_ID",APP_ID); 
$T->Set("APP_URL",APP_URL); 
$T->Set("APP_LOGIN",APP_LOGIN); 
$T->clearNaN();
$T->clearNoN();     
$T->display();
$T->close();
$pd->close();	
unset($T);
unset($pd);