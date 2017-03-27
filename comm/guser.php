<?php 
/** 用户接口  通用类以G开头后加类别名称
 *  编码utf8 前端页面
*/
header("Content-type: text/html; charset=utf-8;"); 
require_once 'comm.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ppf/fun.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ppf/pdo_mysql.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/man/srv/RABC.class.php';//引用rabc文件
class  GUser{ 
    protected $pd;
    /**open打开数据库连接,charset数据库连接方式*/
    public function __construct($open=true,$charset='utf8'){
      if($open)
  		  $this->openconn($charset);	
	 }
   /**打开数据库连接*/  
   public function openConn($charset='utf8'){
      if(!isset($this->pd))
         $this->pd=new pdo_mysql('',DB_USER,DB_PWD,$charset);	
   }
  /**关闭连接*/ 
  public function close(){
		if($this->pd)  {
		  $this->pd->close();
    	unset($this->pd);
    }
	} 
  /**检测用户是否登录*/
  public function chkLogin(){
      if (!session_id()) session_start();
      return isset($_SESSION["uid"]);
  }
  /**登录 u 为json对象 flag为标识0 用户名登录 1邮箱 2手机登录*/
  public function login($u,$flag=0){  
        switch($flag){
          case 0:
            $rs=$this->pd->prepare("select * from act_member where username=? and pmd5=?");
            $rs->execute(array($u["username"],md5($u["password"])));
            break;
          case 1:
            $rs=$this->pd->prepare("select * from act_member where email=? and pmd5=?");
            $rs->execute(array($u["email"],md5($u["password"])));
            break;
          case 2:
            $rs=$this->pd->prepare("select * from act_member where mobile=? and pmd5=?");
            $rs->execute(array($u["mobile"],md5($u["password"])));
            break;
		  case 3:
		  //echo $u["bid"];exit;
		    $rs=$this->pd->prepare("select * from act_member where bid=?");
			$rs->execute(array($u["bid"]));
			break;
        }
        if($r=$rs->fetch(PDO::FETCH_ASSOC)){
          if($r["state"]!="2")return 1;
		  
		  if($u["bid"]!=''&&$flag!=3){
			  //绑定bid
			  $bres=$this->pd->prepare("update act_member set bid=? where id=?");
			  $bres->execute(array($u["bid"],$r["id"]));
			  $r["id"]=$u["bid"];
		  }
		  
          $u= $this->setSession($u,$r);
          $ckey=md5(time());
          if(!empty($u["save"])) $this->setCookie($u["id"],$ckey);
        	$this->pd->exec("update act_member set tmp='".$ckey."',lgnums=ifnull(lgnums+1,1),lasttime=UNIX_TIMESTAMP(),lastip='".$_SERVER["REMOTE_ADDR"]."' where id='".$u["id"]."'");		
        	log_log($this->pd,$u["id"],$_SERVER["REMOTE_ADDR"],1);
          return $u;	
        }
        else   
          return 0;      
  }
  /**无密码登录用户 */
  public function loginNoPass($u,$flag=0){
       switch($flag){
          case 0:
            $rs=$this->pd->prepare("select * from act_member where username=?");
            $rs->execute(array($u["username"]));
            break;
          case 1:
            $rs=$this->pd->prepare("select * from act_member where email=? ");
            $rs->execute(array($u["email"]));
            break;
          case 2:
            $rs=$this->pd->prepare("select * from act_member where mobile=?");
            $rs->execute(array($u["mobile"]));
            break;
          case 3: #id登录
            $rs=$this->pd->prepare("select * from act_member where id=?");
            $rs->execute(array($u["id"]));
            break;
        }
        if($r=$rs->fetch(PDO::FETCH_ASSOC)){
          $u= $this->setSession($u,$r);  
          $ckey=md5(time());
          if(!empty($u["save"])) $this->setCookie($u["id"],$ckey);      	
        	$this->pd->exec("update act_member set tmp='".$ckey."',lgnums=ifnull(lgnums+1,1),lasttime=UNIX_TIMESTAMP(),lastip='".$_SERVER["REMOTE_ADDR"]."' where id='".$u["id"]."'");		
        	log_log($this->pd,$u["id"],$_SERVER["REMOTE_ADDR"],1);
          return $u;	
        }
        else   
          return 0; 
  }/**cookie登录*/
  public function loginCook($id,$k){
       $rs=$this->pd->prepare("select * from act_member where id=? and tmp=?");
        $rs->execute(array($id,$k));             
        if($r=$rs->fetch(PDO::FETCH_ASSOC)){
          $u=array();
          $u= $this->setSession($u,$r);               	
        	$this->pd->exec("update act_member set lgnums=ifnull(lgnums+1,1),lasttime=UNIX_TIMESTAMP(),lastip='".$_SERVER["REMOTE_ADDR"]."' where id='".$id."'");		
          log_log($this->pd,$id,$_SERVER["REMOTE_ADDR"],1);
          return $u;	
        }
        else   
          return 0;
  }
  /**设置session*/
  private function setSession($u,$r){
       if (!session_id()) session_start();#检测session启动    
      $u["id"]=$_SESSION["uid"]=$r["id"]; 
      $u["username"]=$_SESSION["username"]=$r["username"];	
      $u["idtype"]=$_SESSION["idtype"]=$r["idtype"];
      $u["nick"]=$_SESSION["nick"]=$r["nick"];
      $u["school"]=$_SESSION["school"]=$r["school"];
      #if($r["face"])	
        $u["face"]=$_SESSION["face"]='/upd/face/'.$u["id"].'.jpg';
      #else
      #  $u["face"]=$_SESSION["face"]='/error/face.jpg';
      $u["gold"]=$_SESSION["gold"]=$r["gold"];
      $u["credit"]=$_SESSION["credit"]=$r["credit"];
      $u["integral"]=$_SESSION["integral"]=$r["integral"];
      $u["msg"]=$_SESSION["msg"]=$r["msg"];
      $u["user_group"]=$_SESSION["user_group"]=$r["user_group"];//用户组
      $u["template"]=$_SESSION["template"]=$r["template"];//用户后台模板样式
      $u["shortcuts"]=$_SESSION["shortcuts"]=$r["shortcuts"];//用户后台快捷菜单
      //把权限url列表存入session,避免每打开一个页面查询一次数据库
	  $rabc=new RABC($_SESSION['user_group'],$this->pd);
	  $rabc_url=$rabc->getMenuUrl();
	  $u["rabc_url"]=$_SESSION["rabc_url"]=$rabc_url;
	  //统一登录
	  $u["bid"]=$_SESSION["bid"]=$r["bid"];
      return $u;
  }
  /**写cookie*/
  private function setCookie($u,$k){    	
  	$expire=time()+8640000; #100天
  	setcookie('cu',$u,$expire,"/");  #cookie按目录存 请带上/ 如果要通用请带上domain
  	setcookie('ck',$k,$expire,"/");
  }
  /**登出，注销登录*/
  public function logout(){
      if (!session_id()) session_start();
      if(isset($_SESSION["uid"])){
        #更新用户退出
		    unset($_SESSION["uid"]);
		    session_destroy();#session_unset(); 相同;		
	    }
  }
  /**检测用户所有服务器 0本服务器 否则其它服务器url请跳转 */
  public function chkServer($uid=0){
      $sid=$this->pd->query("select ssid from org_units where id=(select unit from act_member where id='".$uid."')")->fetchColumn(0);
      if(!empty($sid)&&$sid!=LR_SID){        
        #更新主服务参数给从服务验证
        $code=md5(time());
        $this->pd->exec("update act_member set tmp='".$code."' where id='".$uid."'");
        return $this->pd->query("select url from sys_server where sid='".$sid."'")->fetchColumn(0)
          .'/api/layer?t=skip&vi='.$uid.'&code='.$code;
          #使用客户端跳转
      }
      else 
        return 0;
  }  
  /**更新用户信息*/
  public function updateInfo($info){
    
  }
  /*检测用户名是否已经存在*/
  public function chkUserName($username){
	  $res=$this->pd->query("select count(1) from act_member where username='".$username."'")->fetchColumn(0);
	  if($res>0){
		  return false;
	  }
	  return true;
  }
  /*统一登录新增用户*/
  public function addTlUser($info){
	  //检查是否存在名为“默认账号组”的用户组，不存在则新建	  
	  $gid=$this->pd->query("select group_id from `osa_user_group` where group_name='默认账号组'")->fetchColumn(0);
	  if(!$gid){
		  $this->pd->exec("insert into `osa_user_group`(group_name,group_role,owner_id,group_desc,art_publish_auth,art_audit_auth) values('统一登录新增用户','1,14,2,21,22,23,24,26,3,5','1','统一登录新增用户','','1')");
		  $gid=$this->pd->lastInsertId();
	  }
	  $timestamp=time();
	  $nid='a'.$timestamp;
	  $rs=$this->pd->exec("insert into `act_member`(id,bid,username,pmd5,truename,state,user_group,timestamp) values('".$nid."','".$info["bid"].
				"','".$info["username"]."','".md5($info["password"],false)."','".$info["username"]."','2','".$gid."','".$timestamp."')");
	  if($rs>0){
		  return true;
	  }else{
		  return false;
	  }			
	  
  }
  
}