<?php 
header("Content-type: text/html; charset=utf-8;"); 
require '../../ppf/fun.php';
require '../../ppf/pdo_mysql.php';

if (!session_id()) session_start(); 
chkLoginNoJump("uid");  
$uid= $_SESSION["uid"];
 
$pd=new pdo_mysql();
switch($_POST["tpl"]){
   case "get_usrs":
      $u=$_POST["u"];
      $t=$_POST["t"];
      $s=$_POST["s"];
      $wh="";
      if(!empty($u))$wh.=" and username='".$u."'";
      if(!empty($t))$wh.=" and truename like '%".$t."%'";
      $rs=$pd->query("select id,truename from act_member where idtype=2 and school=".$s.$wh." limit 30");
		  echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));	
      break; 
    case "get_artcate":
      $result = $pd->query("select id,name,pid from main_art_category order by odx desc")->fetchAll(PDO::FETCH_ASSOC);  
      $result = get_showc($pd,$result);
      echo get_str($result,0,-1);
      break;
    case "get_artcate_name":
    	$rs=$pd->query("select id,name from main_art_category order by odx desc");
		  echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));	
      break;
    case "get_consult_artcate":
      $result = $pd->query("select id,name,pid from consult_art_category order by odx desc")->fetchAll(PDO::FETCH_ASSOC);  
      $result = get_showc($pd,$result);
      echo get_str($result,0,-1);
      break;
    case "get_consult_artcate_name":
    	$rs=$pd->query("select id,name from consult_art_category order by odx desc");
		  echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));	
      break;
    case "get_videocate":
      $result = $pd->query("select id,name,pid from main_video_category order by odx desc")->fetchAll(PDO::FETCH_ASSOC);  
      echo get_str($pd,$result,0,-1);	
      break;
    case "get_videocate_name":
    	$rs=$pd->query("select id,name from main_video_category order by odx desc");
		  echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));	
      break;
  	case "getaddr2": #��ַ 2
  		$rs=$pd->query("select id,name,names from sys_addr where pid=".$_POST["id"]." order by odx asc");
  		echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));	
  		break;
    case "get_addr_sch":
  		$rs=$pd->query("select id,name from school where addr=".$_POST["id"]." order by name");
  		echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));	
  		break;  
    case "get_sch_s":
  		echo $pd->query("select name from school where id=".$_POST["id"])->fetchColumn(0);		
  		break;  
    case "get_addr_s":  #nouse
  		echo $pd->query("select names from sys_addr where id=".$_POST["id"])->fetchColumn(0);		
  		break;  
	case "get_blog_cate":
		$rs=$pd->query("SELECT id,name from push_category where push_type='".$_POST["push_type"]."' order by odx desc");
		echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));	
		break; 
	case "get_user_groups":
	    $rs=$pd->query("select group_id,group_name from `osa_user_group` order by group_id");
		echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
	    break;
	case "get_group_auth":#获取用户组后台功能权限列表
	    $gid=isset($_POST['gid'])?$_POST['gid']:"";
		if(!empty($gid)){
			$group_role_list=$pd->query("select group_role from `osa_user_group` where group_id=".$gid)->fetchColumn(0);
			$group_role_list=explode(",", $group_role_list);
			echo json_encode($group_role_list);
		}
	    break;
	case "get_cate_list":#获取文章栏目信息
	    $cate_info=$pd->query("select id,pid,name,odx,visible,odb,scend,isatc,type,iscst,cstyle,isast,astyle from `main_art_category` order by odx")->fetchAll(PDO::FETCH_ASSOC);
	    $root=array('id'=>'0','name'=>'根目录','iconOpen'=>"/widget/zTree/css/zTreeStyle/img/diy/1_open.png",'iconClose'=>"/widget/zTree/css/zTreeStyle/img/diy/1_close.png");
	    array_unshift($cate_info,$root);
	    echo json_encode($cate_info);
	    break;
	case "getAll_group_art_auth":
	    $rs=$pd->query("select group_id,art_publish_auth,art_audit_auth from `osa_user_group`");
		echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
	    break;
	case "get_artcate_new":
		$result = $pd->query("select id,name,pid from main_art_category order by odx asc")->fetchAll(PDO::FETCH_ASSOC); 
		$tree_arr=get_tree_arr($result,0);
		$tree_html=get_tree_html($tree_arr,$html="");
		echo $tree_html;
		break;
	case "get_artcate_mynew":
		$uid=isset($_POST['uid'])?$_POST['uid']:"";
		if(!empty($uid)){
			$art_publish_auth=$pd->query("select oug.art_publish_auth from act_member am LEFT JOIN osa_user_group oug on am.user_group=oug.group_id where am.id='".$uid."'")->fetchColumn(0);
		}
		$result = $pd->query("select id,name,pid from main_art_category where id in (".$art_publish_auth.") order by odx asc")->fetchAll(PDO::FETCH_ASSOC); 
		$tree_arr=get_tree_arr($result,0);
		$tree_html=get_tree_html($tree_arr,$html="");
		echo $tree_html;
		break;
}		

function get_showc($pd,$result){
  $cate = array();
  $art = $pd->query("select GROUP_CONCAT(aid) from main_art_type_permission where tid=".$_SESSION["idtype"])->fetchColumn(0);
  if(strpos($art,",") == true){     
    $artarr = explode(',',$art);
  }else{
    $artarr = array($art);  
  }
  
  $i=0;                  
  foreach($result as $v){
    if(in_array($v["id"],$artarr)){
      $cate[$i] = $v;
      $i++;
    }
  }
  return get_pid($pd,$cate,$i);    
}

function get_pid($pd,$cate,$p){
  foreach($cate as $k=>$v){
    $pid=$pd->query("select pid from main_art_category where id=".$v["id"])->fetchColumn(0);
    if(!empty($pid)){
      $result = $pd->query("select id,name,pid from main_art_category where id=".$pid."")->fetch(PDO::FETCH_ASSOC);  
      $cate[$p] = $result;
      $p++; 
    }
  }
  return array_unique_fb($cate);
}


function array_unique_fb($array2D){
 foreach ($array2D as $k=>$v){
  $v=join(',',$v); 
  $temp[$k]=$v;
 }
 $temp=array_unique($temp); 
 foreach ($temp as $k => $v){
    $temp[$k]=explode(',',$v);
 }
  $keys = array('id','name','pid');
  foreach($temp as $key=>$val)
  {
      foreach($val as $k=>$v)
      {
          $temp[$key][$keys[$k]] = $v;
          unset($temp[$key][$k]);
      }
  }
  return $temp;
}

function get_str($result,$id = 0,$count = -1) {
    $count++;
    $str = "";
    $disStr = " ";
    if(count($result)>0){
        foreach($result as $k=>$v) { 
            if($v['pid'] != $id) {
               continue;
            }
            foreach($result as $tmpk => $tmp) {
               if($tmp['pid'] == $v['id']) {
                  $disStr = "disabled=\"disabled\" ";
                  break;
               }
            }
                 
            $str.= "<option {$disStr} value=". $v['id'] .">";
            $disStr = " ";
            $str.= str_repeat("&nbsp;&nbsp;&nbsp;",$count);
            $str.="|--". $v['name'] . "</option>"; 
            $str.= get_str($result,$v['id'],$count); 
        }  
    }      
    return $str;
}



$pd->close();
unset($pd);
unset($rs);