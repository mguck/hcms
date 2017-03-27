<?php
#登录
#require('../ppf/360_safe3.php');
#header("Content-type: text/html; charset=utf-8");
require('../../comm/guser.php');
if (!session_id()) session_start(); 
$u=isset($_POST["u"])?$_POST["u"]:"";
$p=isset($_POST["p"])?$_POST["p"]:"";
$s=isset($_POST["s"])?$_POST["s"]:"0";
$bid=isset($_POST["bid"])?$_POST["bid"]:"";
$ologin=isset($_POST["ologin"])?$_POST["ologin"]:"";
#$ip =$_SERVER["REMOTE_ADDR"];
if($ologin=='0'){
	if($u==""||$p==""){
		echo '{"ret":"err"}';
		exit;
    }
}

$ln=strlen($u);
$GU=new GUser();

if($ologin=='2'){
	//统一登录，创建新用户，检测用户名是否重复
	$rs=$GU->chkUserName($u);
	if(!$rs){echo '{"ret":"err","msg":"该用户名已存在！"}';exit;}
	$ress=$GU->addTlUser(array('username'=>$u,'password'=>$p,'save'=>$s,'bid'=>$bid));
	if(!$ress){echo '{"ret":"err","msg":"创建用户失败！"}';exit;}
	//echo '{"ret":"cok","msg":"新用户创建成功！"}';exit;
}

if(strpos($u,'@'))
$u=$GU->login(array('email'=>$u,'password'=>$p,'save'=>$s,'bid'=>$bid),1);
elseif($ln==11&&is_numeric($u))#手机	
$u=$GU->login(array('mobile'=>$u,'password'=>$p,'save'=>$s,'bid'=>$bid),2);
else
$u=$GU->login(array('username'=>$u,'password'=>$p,'save'=>$s,'bid'=>$bid),0);
//统一登录,已经绑定，直接登录
if($bid!='')$u=$GU->login(array('bid'=>$bid),3);
if($u){
#检测存储服务器
	if($u==1){
		echo '{"ret":"err","msg":"用户还没有通过审核！"}';
	}else{	
		echo '{"ret":"ok","idtype":"'.$u["idtype"].'"}';
	}	
}else{
	echo '{"ret":"err","msg":"登录失败:用户名或者密码错误"}';
}
$GU->close();
unset($GU);
?>