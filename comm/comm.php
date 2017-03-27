<?php
/**全局通用函数 */

/******************
 *  日志操作记录 log_log
 *
 *****************/  
function log_log($pd,$uid,$des,$type=0){
   $pd->exec("insert into log_log values(UNIX_TIMESTAMP(),'".$uid."',".$type.",'".$des."')");
   #$pd->exec("delete from log_log where id<(UNIX_TIMESTAMP()-(3600*24*90))");#删除3个月前的日志
} 
#积分日志
function log_integral($pd,$uid,$io=0,$val,$des=""){ #io加减1+ 2-
   $pd->exec("insert into log_integral values(UNIX_TIMESTAMP(),'".$uid."',".$io.",".$val.",'".$des."')");
   #$pd->exec("delete from log_integral where d<(UNIX_TIMESTAMP()-(3600*24*90))");#删除3个月前的积分日志
}
/*********************************************   
积分加减
*/
function integralP($pd,$uid,$igl,$note=''){
  log_integral($pd,$uid,1,$igl,$note);   
  return  $pd->exec("update act_member set integral=ifnull(integral,0)+".$igl."  where id='".$uid."'");
}
function integralM($pd,$uid,$igl,$note=''){
  if($pd->query("select ifnull(integral,0) from act_member where id='".$uid."'")->fetchColumn(0)<$igl){
     return 0;
  }
  log_integral($pd,$uid,2,$igl,$note);
  return $pd->exec("update act_member set integral=ifnull(integral,0)-".$igl."  where id='".$uid."'");
}  

/*#登录加积分
function log_login($pd,$uid,$ip){
   if(!$pd->query("select count(1) from log_login where id='".$uid."' and d>UNIX_TIMESTAMP(date(now()))")->fetchColumn(0)){
      creditP($pd,$uid,1,"登录+1");
   }
   $pd->exec("insert into log_login values('".$uid."',UNIX_TIMESTAMP(),'".$ip."')");
   $pd->exec("delete from log_login where d<(UNIX_TIMESTAMP()-(3600*24*30))");#一个月
}*/
/**经验*/
function creditP($pd,$uid,$v,$note=''){
  log_credit($pd,$uid,$v,$note);   
  return  $pd->exec("update act_member set credit=ifnull(credit,0)+".$v."  where id='".$uid."'");
}
function creditM($pd,$uid,$v,$note=''){
  if($pd->query("select ifnull(integral,0) from act_member where id='".$uid."'")->fetchColumn(0)<$v){
     return 0;
  }
  log_credit($pd,$uid,$v,$note);
  return $pd->exec("update act_member set credit=ifnull(credit,0)-".$v."  where id='".$uid."'");
}
#经验日志
function log_credit($pd,$uid,$v,$note){
   $pd->exec("insert into log_credit values('".$uid."',UNIX_TIMESTAMP(),".$v.",'".$note."')");
   $pd->exec("delete from log_credit where d<(UNIX_TIMESTAMP()-(3600*24*90))");#删除3个月前的积分日志
}