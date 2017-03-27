<?php 
/*set do
*/
header("Content-type: text/html; charset=utf-8;"); 
require '../../ppf/fun.php';
require '../../ppf/pdo_mysql.php';
date_default_timezone_set('PRC');

if (!session_id()) session_start();  
chkLoginNoJump("uid"); 
$uid=$_SESSION['uid'];

$pd=new pdo_mysql();
switch($_POST["tpl"]){
 case "chkreg":
    $u=$_POST["u"];
    /*$t=$_POST["t"];
    $m=$_POST["m"];
    $e=$_POST["e"];*/ 
    /*$rs=$pd->prepare("select count(1) from act_member where username=?");  
	$rs->execute(array($u));*/
	$rs=$pd->query("select count(1) from act_member where username='".$u."'");
    if($rs->fetchColumn(0))
      echo $rs->fetchColumn(0);
    else  
      echo "0";     
    break;    
  case "set_tpl":		 
		$pd->exec("update `main` set tpl='". $_POST['data']."' where id=1");	
    echo "ok";
		break;        
 case "aud_active": #
    $pd->exec("update activity set state=2,status=1 where id=".$_POST["id"]);
    echo "ok";  
    break;  
 case "del_sch_depart": #
    $pd->exec("delete from `sch_department` where id='".$_POST["id"]."'");
      echo "ok";  
    break;  
 case "del_topic": #
      $pd->exec("delete from `sch_topic` where id='".$_POST["id"]."'");
      echo "ok";  
    break; 
  case "del_admin": #
      $pd->exec("delete from `main_member` where id='".$_POST["id"]."'");
      echo "ok";  
    break; 
	    case "audit_advers": 
      $pd->exec("update `main_topic` set state=2  where id=".$_POST["id"]);
        echo "ok";  
    break;
  case "ad_man":#添加管理员
    $u=$_POST["u"];
    $txt=$_POST["txt"];     
    $s=$_POST["s"];
    $nid=$pd->genid("sch_admin");
    $pd->exec("insert into sch_admin(id,sid,uid,intro,timestamp) values(".$nid.",".$s.",'".$u."','".$txt."',UNIX_TIMESTAMP())");
    echo "ok";   
    break;
  case "del_clsman": #
      $pd->exec("delete from `cls_member` where id='".$_POST["id"]."' and isman=2");
      echo "ok";  
    break;
  case "ad_clsman":#添加班级管理员
    $u=$_POST["u"];
    $txt=$_POST["txt"];     
    $c=$_POST["c"];
    $rs=$pd->query("select count(1) from cls_member where isman=2 and cid=".$c." and uid='".$u."'")->fetchColumn(0);
		if($rs==0){
      $nid=$pd->genid("cls_member");
      $pd->exec("insert into cls_member(id,uid,cid,idtype,intro,isman,timestamp,lastdo) values(".$nid.",'".$u."',".$c.",2,'".$txt."',2,UNIX_TIMESTAMP(),UNIX_TIMESTAMP())");
    }else{
      $pd->exec("update `cls_member` set isman=2  where cid=".$c." and uid='".$u."'");
    }
    echo "ok";   
    break; 
  case "m_clsman":#修改班级管理员
    $id=$_POST["id"];
    $txt=$_POST["txt"];
    $pd->exec("update `cls_member` set intro='".$txt."'  where id=".$id." ");
    echo "ok";   
    break;
  case "del_grpman": #
      $pd->exec("delete from `grp_member` where id='".$_POST["id"]."' and isman=2");
      echo "ok";  
    break;
  case "ad_grpman":#添加群组管理员
    $u=$_POST["u"];
    $txt=$_POST["txt"];     
    $g=$_POST["g"];
    $rs=$pd->query("select count(1) from grp_member where isman=2 and gid=".$g." and uid='".$u."'")->fetchColumn(0);
		if($rs==0){
      $nid=$pd->genid("grp_member");
      $pd->exec("insert into grp_member(id,uid,gid,intro,isman,timestamp,lastsay) values(".$nid.",'".$u."',".$g.",'".$txt."',2,UNIX_TIMESTAMP(),UNIX_TIMESTAMP())");
    }else{
      $pd->exec("update `grp_member` set isman=2  where gid=".$g." and uid='".$u."'");
    }
    echo "ok";   
    break; 
  case "m_grpman":#修改群组管理员
    $id=$_POST["id"];
    $txt=$_POST["txt"];
    $pd->exec("update `grp_member` set intro='".$txt."'  where id=".$id." ");
    echo "ok";   
    break;
  case "del_famman": #删除名师管理员
      $pd->exec("delete from `famous_member` where id='".$_POST["id"]."' and isman=2");
      echo "ok";  
    break;
  case "ad_famman":#添加名师管理员
    $u=$_POST["u"];
    $txt=$_POST["txt"];     
    $f=$_POST["f"];
    $rs=$pd->query("select count(1) from famous_member where isman=2 and fid=".$f." and uid='".$u."'")->fetchColumn(0);
		if($rs==0){
      $nid=$pd->genid("famous_member");
      $pd->exec("insert into famous_member(id,uid,fid,intro,isman,timestamp) values(".$nid.",'".$u."',".$f.",'".$txt."',2,UNIX_TIMESTAMP())");
    }else{
      $pd->exec("update `famous_member` set isman=2  where fid=".$f." and uid='".$u."'");
    }
    echo "ok";   
    break; 
  case "m_famman":#修改群组管理员
    $id=$_POST["id"];
    $txt=$_POST["txt"];
    $pd->exec("update `famous_member` set intro='".$txt."'  where id=".$id." ");
    echo "ok";   
    break;
   
  
    case "del_art": #
      $pd->exec("delete from `sch_art` where id=".$_POST["id"]);
      echo "ok";  
    break; 
  case "aud_fam": 
      $pd->exec("update `famous` set state=2  where id=".$_POST["id"]);
        echo "ok";  
    break;
    case "del_fam": #
      $pd->exec("update `famous` set state=4  where id=".$_POST["id"]);
      echo "ok";  
    break; 
  case "aud_sub": 
      $pd->exec("update `subject` set state=2  where id=".$_POST["id"]);
        echo "ok";  
    break;
    case "del_sub": #
      $pd->exec("update `subject` set state=4  where id=".$_POST["id"]);
      echo "ok";  
    break; 
  case "aud_grp": 
      $pd->exec("update `group` set state=2  where id=".$_POST["id"]);
        echo "ok";  
    break;
    case "del_grp": #
      $pd->exec("update `group` set state=4  where id=".$_POST["id"]);
      echo "ok";  
    break;           
  case "aud_cls": #
      $pd->exec("update `class` set state=2  where id=".$_POST["id"]);
        echo "ok";  
    break;
    
  case "aud_art": 
      $pd->exec("update `main_article` set state=2  where id=".$_POST["id"]);
        echo "ok";  
    break;  

   case "del_act": 
      $pd->exec("delete from `act_member` where id='".$_POST["id"]."'");
      $pd->exec("delete from `cls_member` where uid='".$_POST["id"]."'");
      $pd->exec("delete from `grp_member` where uid='".$_POST["id"]."'");
      $pd->exec("delete from `act_school` where uid='".$_POST["id"]."'");
      $pd->exec("delete from `sch_admin` where uid='".$_POST["id"]."'");
      echo "ok";  
    break;  
  case "admin_user": 
      if($pd->query("select count(1) from main_member where uid='".$_POST["id"]."'")->fetchColumn(0))
        echo "err用户已经是管理员";
      else{
        $nid=$pd->genid("main_member");
        $pd->exec("insert into main_member(id,uid,timestamp) values(".$nid.",'".$_POST["id"]."',UNIX_TIMESTAMP())");
        echo "ok";  
      }
    break;
	case "aud_push_list": 
		$pd->exec("update `push_list` set state=2  where id=".$_POST["id"]);
        echo "ok";  
		break;
	case "set_consult_art_comment":
		$time=time();
		if($pd->query("select count(1) from consult_art_comment where aid=".$_POST["aid"])->fetchColumn(0)){
			$pd->exec("update `consult_art_comment` set `des`='{$_POST["content"]}' where aid=".$_POST["aid"]);
		}else{
			$pd->exec("insert into consult_art_comment (`id`,`aid`,`des`,`timestamp`) values ('{$time}','{$_POST["aid"]}','{$_POST["content"]}','{$time}')");
		}
		$pd->exec("update `consult_art` set `show`=2,`endtime`='{$time}' where id=".$_POST["aid"]);
		echo "ok"; 
		break;
    case "del_consult_art":
		$pd->exec("delete from `consult_art` where id in ({$_POST["id"]})");
		echo "ok";
		break;
	case "del_menu_url":#删除单独后台功能列表
		$pd->exec("delete from `osa_menu_url` where menu_id=".$_POST["menu_id"]." or father_menu=".$_POST["menu_id"]);
		echo "ok";
		break;
	case "del_menu_url_all":#批量删除
		$menu_ids=implode(",", $_POST["menu_id"]);
		$pd->exec("delete from `osa_menu_url` where menu_id in(".$menu_ids.") or father_menu in(".$menu_ids.")");
		echo "ok";
		break;
	case "user_batch_deal":#用户处理【单个/批量】
		$ids=implode(",", $_POST["ids"]);
		$ts=isset($_POST["ts"])?$_POST["ts"]:'';
		
		if($_POST["bd"]=='del'){#删除
			$sql="delete from `act_member` where id in(".$ids.")";
		}elseif($_POST["bd"]=='ag'){#添加到用户组
			$sql="update `act_member` set user_group=".$ts." where id in(".$ids.")";
		}else{#其他
			$sql="update `act_member` set state=".$ts." where id in(".$ids.")";
		}
		$pd->exec($sql);
		echo "ok";
		break;
	case "del_user_group":#删除用户组
		$pd->exec("delete from `osa_user_group` where group_id=".$_POST["group_id"]);
		echo "ok";
		break;
	case "art_handle":
		$id=isset($_POST["id"])?$_POST["id"]:'';
		$flag=isset($_POST["flag"])?$_POST["flag"]:'';
		switch($flag){
			case "1":#回收站
				$sql="update `main_article` set state='4' where id in(".$id.")";
				break;
			case "2":#审核通过
				$sql="update `main_article` set state='2' where id in(".$id.")";
				break;
			case "3":#审核不通过
				$sql="update `main_article` set state='0' where id in(".$id.")";
				break;
			case "4":#彻底删除
				$sql="delete from `main_article` where id in(".$id.")";
				break;
		}
		$pd->exec($sql);
		echo "ok";
	break;
	case "dealNode":#处理栏目操作
	    $add=isset($_POST['add'])?$_POST['add']:"";
	    $drop=isset($_POST['drop'])?$_POST['drop']:"";
	    $rename=isset($_POST['rename'])?$_POST['rename']:"";
		$remove=isset($_POST['remove'])?$_POST['remove']:"";
        //p($rename);
		$sql="";
		if(!empty($add)){
			$sql.="insert into `main_art_category`(name,pid,visible,odx,timestamp,childnums,nums,lastid,odb,scend,isatc,type,iscst,cstyle,isast,astyle) values ";
			foreach($add as $a){
				$a=json_decode($a);
				$childnums=isset($a->children)?count($a->children):0;
				$sql.="('".$a->name."','".$a->pid."',".$a->visible.",".$a->odx.",unix_timestamp(),".$childnums.",0,'','".$a->odb."','".$a->scend."','".$a->isatc."','".$a->type."','".$a->iscst."','".$a->cstyle."','".$a->isast."','".$a->astyle."'),";
			}
			$sql=rtrim($sql,",");$sql.=";";
		}
		if(!empty($drop)){
			foreach($drop as $d){
				$d=json_decode($d);
				$sql.="update `main_art_category` set odx=".$d->odx.",pid='".$d->pid."' where id='".$d->id."';";
			}
		}
		if(!empty($rename)){
			foreach($rename as $ren){
				//p($ren);
				$ren=json_decode($ren);
				$sql.="update `main_art_category` set name='".$ren->name."',visible=".$ren->visible.",odb='".$ren->odb."',scend='".$ren->scend."',isatc='".$ren->isatc."',type='".$ren->type."',iscst='".$ren->iscst."',cstyle='".$ren->cstyle."',isast='".$ren->isast."',astyle='".$ren->astyle."' where id='".$ren->id."';";
			}
		}
		
		if(!empty($remove)){
			foreach($remove as $rem){
				$rem=json_decode($rem);
				$sql.="delete from `main_art_category` where id='".$rem->id."';";
				$sql.="update `main_article` set state=5 where cid='".$rem->id."';";//设置已删除栏目下文章状态为5，表示所属栏目已删除
			}
		}
		//echo $sql;
		//exit;
		if($pd->exec($sql)){
			echo '1';
		}else{
			echo '-1';
		}
		
		break;	
	case "deal_art_auth":#处理文章栏目权限
	    $change=isset($_POST['change'])?$_POST['change']:"";
	    if(empty($change)){echo '-1';exit;}
	    $sql="";
		foreach($change as $ch){
			$ch=json_decode($ch);
			$sql.="update `osa_user_group` set art_publish_auth='".$ch->art_publish_auth."',art_audit_auth='".$ch->art_audit_auth."' where group_id=".$ch->group_id.";";
		}
		//exit;
		if($pd->exec($sql)){
			echo '1';
		}else{
			echo '-1';
		}
		break;	
	case "del_links":#删除单个友情链接
		if($pd->exec("delete from `links` where id=".$_POST["id"])){
			echo 'ok';
		}else{
			echo 'error';
		}
		break;
	case "del_links_all":#批量删除友情链接
		$ids=implode(",", $_POST["id"]);
		if($pd->exec("delete from `links` where id in(".$ids.")")){
			echo 'ok';
		}else{
			echo 'error';
		}
		break;
    case "push_other_cate":#推送到其他栏目
	    $cur_id=$_POST["cur_id"];
		$cids=$_POST["push_cate"];
		//echo json_encode($_POST["push_cate"]);exit;
		$sql="";
		foreach($cids as $cid){
			$sql.="insert into `main_article` (id,cid,uid,`name`,pre,des,thumb,see,up,report,`share`,comments,`timestamp`,froms,fromid,state,CreateTime,isTop,push_cate) select (select max(id)+1 from main_article),".$cid.",uid,`name`,pre,des,thumb,see,up,report,`share`,comments,`timestamp`,froms,fromid,state,CreateTime,isTop,'' from `main_article` where id=".$cur_id.";";
		}
		echo $sql;exit;
		if($pd->exec($sql)){
			echo 'ok';
		}else{
			echo 'error';
		}
		break;		
}		
$pd->close();
unset($pd);
unset($rs);