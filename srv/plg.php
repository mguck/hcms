<?php
#登录
#require('../ppf/360_safe3.php');
#header("Content-type: text/html; charset=utf-8");
require('../comm/guser.php');
$u=isset($_POST["u"])?$_POST["u"]:"";
$p=isset($_POST["p"])?$_POST["p"]:"";
$s=isset($_POST["s"])?$_POST["s"]:"0";
#$ip =$_SERVER["REMOTE_ADDR"];
if($u==""||$p==""){
echo '{"ret":"err"}';
exit;
}
$ln=strlen($u);
$GU=new GUser();
if(strpos($u,'@'))
$u=$GU->login(array('email'=>$u,'password'=>$p,'save'=>$s),1);
elseif($ln==11&&is_numeric($u))#手机	
$u=$GU->login(array('mobile'=>$u,'password'=>$p,'save'=>$s),2);
else
$u=$GU->login(array('username'=>$u,'password'=>$p,'save'=>$s),0);
if($u){
#检测存储服务器
if($u==1)
echo '{"ret":"err","msg":"用户还没有通过审核！"}';
else
echo '{"ret":"ok","idtype":"'.$u["idtype"].'"}';
}
else
echo '{"ret":"err","msg":"登录失败:用户名或者密码错误"}';
$GU->close();
unset($GU);
?>