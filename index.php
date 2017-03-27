<?php

header("Content-type: text/html; charset=utf-8;");
require('./ppf/360_safe3.php');     
require('./ppf/fun.php'); 
require("./ppf/pdo_template.php"); 
require("./ppf/cache.php"); 
require("./ppf/browser.php");
require("./ppf/pdo_mysql.php");
require("./srv/acd.php");#获取栏目排序相关
if (!session_id()) session_start();#初始化session
#防止CC攻击处理
$timestampcc = time();
$cc_nowtime = $timestampcc;
if(isset($_SESSION['cc_lasttime'])){
	$cc_lasttime = $_SESSION['cc_lasttime'];
	$cc_times = $_SESSION['cc_times']+1;
	$_SESSION['cc_times'] = $cc_times;
}else{
	$cc_lasttime = $cc_nowtime;
	$cc_times = 1;
	$_SESSION['cc_times'] = $cc_times;
	$_SESSION['cc_lasttime'] = $cc_lasttime;
}  
if(($cc_nowtime-$cc_lasttime)<3){//3秒内刷新5次以上可能为cc攻击
	if($cc_times>=5){
		echo '刷新太快!';
		exit;
	}
}else{
	$cc_times = 0;
	$_SESSION['cc_lasttime'] = $cc_nowtime;
	$_SESSION['cc_times'] = $cc_times;
}

#检测网站状态打开/关闭
if(WEB_STATE!='1'){
	die('<div style="color:grey;width:400px;height:300px;border:4px solid grey;margin:0 auto;text-align:center;"><h1 style="border-bottom:4px solid grey;">网站已关闭</h1><div>'.WEB_CLOSE_REASON.'</div></div>');
}

#检测传入模样
$qname=isset($_GET["t"])?$_GET["t"]:"index";

#检测栏目页和内容页模板
$cst_arr=array("c1"=>"pic_content","c2"=>"products","c3"=>"consult_form","c4"=>"consult_list");//自定义栏目模板对应关系
$ast_arr=array("a1"=>"product");//自定义内容模板对应关系
$cst=isset($_GET["cst"])?$_GET["cst"]:"";
$ast=isset($_GET["ast"])?$_GET["ast"]:"";
if(!empty($cst)&&!empty($ast)){echo "传入参数错误！";exit;}//只能有一个存在
if(!empty($cst)&&isset($cst_arr[$cst]))$qname=$cst_arr[$cst];
if(!empty($ast)&&isset($ast_arr[$ast]))$qname=$ast_arr[$ast];

#静态化处理
if(S_STATE=='1'){
	require("./srv/std.php");//引入静态化处理文件
	$std=new STD($qname,@$_GET['id'],@$_GET['c'],@$_GET['p']);
	$std->init();//初始化设置
	//加载静态页面
	if($std->loadFile()){
		if(S_AUTO_CLEAN=='1'){
			//定时清理过期文件
			$std->autoClean();
		}
        exit;		
	}
	
}


//exit;
if(isset($_SESSION['acd'])){
	$acd=unserialize($_SESSION['acd']);
}else{
	$acd=new ACD();
	$_SESSION['acd']=serialize($acd);	
}
//p($acd);
//exit;
#模板
$T=new pdo_template('./html/'.$qname.'.htm');
/*$T->SetTpl('head','head.htm');
$T->SetTpl('foot','foot.htm');
$T->SetTpl('meta','cssjs.inc');*/
if(!empty($id)){
  $pid=$T->db->query("select pid from main_art_category where id=(select c.id from `main_art_category` c left join main_article a on a.cid=c.id where a.id=".$id.")")->fetchColumn(0);
}
if(!empty($cid)){
  $pid=$T->db->query("select pid from main_art_category where id=".$cid)->fetchColumn(0);
}

$cid_logo=$acd->getCidByCtype('sht_logo');//返回形式为array
$cid_banner=$acd->getCidByCtype('sht_banner');
//logo
//$T->SetBlock("logo","select id,name,des from main_article where cid=".$cid_logo['id']." and state=2 limit 0,1");
//$T->Set("logo_cname",$cid_logo['name']);
//banner   注意此处写法！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！1
$T->SetBlock("banner","select id,name,thumb,pre,cid,'".$cid_banner['astyle']."' as astyle from main_article where cid=".$cid_banner['id']." and state=2 order by ".$acd->aco($cid_banner['id']));
$T->Set("banner_ast",$cid_banner['astyle']);
//友情链接
$T->SetBlock("links","select * from links order by odx");
//菜单
$T->SetBlock("menu_list","select id,name,pid,cstyle,astyle from `main_art_category` where pid=0 and visible=1 order by odx");
switch($qname){
	case "index":
		
		$cid_product=$acd->getCidByCtype('sht_product');
		$cid_honor=$acd->getCidByCtype('sht_honor');
		$product_childs=$acd->getCidByPid($cid_product['id']);//获取该栏目下所有子栏目id的集合
		array_push($product_childs,$cid_product['id']);
		$product_childs_str=implode(",", $product_childs);
		$honor_childs=$acd->getCidByPid($cid_honor['id']);//获取该栏目下所有子栏目id的集合
		array_push($honor_childs,$cid_honor['id']);
		$honor_childs_str=implode(",", $honor_childs);
		//product滚动   注意此处写法！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！1
		$T->SetBlock("product","select id,name,thumb,pre,cid,'".$cid_product['astyle']."' as astyle from main_article where cid in (".$product_childs_str.") and state=2 order by ".$acd->aco($cid_product['id']));
		$T->Set("product_cid",$cid_product['id']);//用于点击更多跳转时的id值
		$T->Set("product_cname",$cid_product['name']);
		$T->Set("product_cstyle",$cid_product['cstyle']);//检测栏目模板
		//honor滚动
		$T->SetBlock("honor","select id,name,thumb,pre,cid,'".$cid_honor['astyle']."' as astyle from main_article where cid in (".$honor_childs_str.") and state=2 order by ".$acd->aco($cid_honor['id']));
		$T->Set("honor_cid",$cid_honor['id']);
		$T->Set("honor_cname",$cid_honor['name']);
		$T->Set("honor_cstyle",$cid_honor['cstyle']);
		
		/******首页图文列表模块  ******/
		$pam1=$acd->getCidByCtype('sht_pam1');//获取该类型的栏目array
		$pam2=$acd->getCidByCtype('sht_pam2');
		$pam3=$acd->getCidByCtype2('sht_pam3');//获取该类型的所有栏目array
		//首页模块1和模块2即走进航飞和新闻中心两个模块固定，类似模块健康顾问 可增加
		//对于模块1
		$T->Set("m1_cid",$pam1['id']);//模块1栏目id
		$T->Set("m1_cname",$pam1['name']);//模块1栏目name
		$T->Set("m1_cstyle",$pam1['cstyle']);
		$m1_childs=$acd->getCidByPid($pam1['id']);//获取该栏目下所有子栏目id的集合
		array_push($m1_childs,$pam1['id']);
		$m1_cids_str=implode(",", $m1_childs);
		$T->SetBlock("m1_list","select id,name,thumb,pre,CreateTime,cid,'".$pam1['astyle']."' as astyle from main_article where cid in (".$m1_cids_str.") and state=2 order by isTop desc,".$acd->aco($pam1['id'])." limit 0,1",array("CreateTime"),array("%Y-%m-%d"));//第一条带图片的新闻
		/********对于模块2*********/
		$T->Set("m2_cid",$pam2['id']);//模块2栏目id
		$T->Set("m2_cname",$pam2['name']);//模块2栏目name
		$T->Set("m2_cstyle",$pam2['cstyle']);
		$m2_childs=$acd->getCidByPid($pam2['id']);//获取该栏目下所有子栏目id的集合
		array_push($m2_childs,$pam2['id']);
		$m2_cids_str=implode(",", $m2_childs);
		$T->SetBlock("m2_list1","select id,name,thumb,pre,CreateTime,cid,'".$pam2['astyle']."' as astyle from main_article where cid in (".$m2_cids_str.") and state=2 order by isTop desc,".$acd->aco($pam2['id'])." limit 0,1",array("CreateTime"),array("%Y-%m-%d"));//第一条带图片的新闻
		$T->SetBlock("m2_list2","select id,name,thumb,pre,CreateTime,cid,'".$pam2['astyle']."' as astyle from main_article where cid in (".$m2_cids_str.") and state=2 order by isTop desc,".$acd->aco($pam2['id'])." limit 1,4",array("CreateTime"),array("%Y-%m-%d"));
		/********对于模块3*********/
		//可输出任意多模块3，注意空格
		$m3_html="";
        $m3_cids=$pam3;
        if(count($m3_cids)!=0){
        foreach($m3_cids as $m3){
        	$m3_html.=<<<EOF
        	 <!-- 健康顾问开始 -->  
        <div id="box_main_sub4">
			<div class="in_products">
				<div class="in_products_title" limit="4">{$m3['name']}</div>
			    <div class="in_products_more"><a href="{WEB_URL}/?t=list&c={$m3['id']}&cst={$m3['cstyle']}" target="_blank">更多&gt;&gt;</a></div>
			    <div class="clearBoth"></div>
			</div>
<!-- 苦荞知识开始 -->
EOF;
        $m3_childs=$acd->getCidByPid($m3['id'],1,1);//一级子栏目集合
        foreach($m3_childs as $m3_child){
        $m3_childs_all=$acd->getCidByPid($m3_child['id']);//获取该栏目下所有级栏目
        
        array_push($m3_childs_all,$m3_child['id']);
        $m3_childs_all_str=implode(",", $m3_childs_all);
		//$m3_childs_all_str=$m3_child['id'];
        $art_info1=$T->db->query("select id,name,thumb,pre,from_unixtime(CreateTime,'%Y-%m-%d') as ct,cid,'".$m3_child['astyle']."' as astyle from main_article where cid in (".$m3_childs_all_str.") and state=2 order by isTop desc,".$acd->aco($m3_child['id'])." limit 0,1")->fetch(PDO::FETCH_ASSOC);//带图片的第一条新闻
		
		$art_info2=$T->db->query("select id,name,thumb,pre,from_unixtime(CreateTime,'%Y-%m-%d') as ct,cid,'".$m3_child['astyle']."' as astyle from main_article where cid in (".$m3_childs_all_str.") and state=2 order by isTop desc,".$acd->aco($m3_child['id'])." limit 1,5")->fetchAll(PDO::FETCH_ASSOC); 
        $m3_html.=<<<EOF
        <div id="box_main_sub4_sub1" class='special_1' style="margin-right:15px;">
	    <div class="in_title_bg"> 
              <div class="in_title" limit="4">{$m3_child['name']}</div>  
              <div class="in_more">
                <a href="{WEB_URL}/?t=list&c={$m3_child['id']}&cst={$m3_child['cstyle']}" target="_blank">更多&gt;&gt;</a>
              </div> 
            </div>  
	  <div id="box_pic">
	  <div class="columnSpace"><div class="FrontSpecifies_show01-d3_c1"><div class="describe htmledit">
       <p>
	<img alt="" src="{WEB_URL}/upd/art_thumb/{$art_info1['thumb']}" width="140" height="120" onerror="this.src='{WEB_URL}/html/img/nopic.jpg'"></p></div>
</div></div>
	  </div>
	  <div id="box_cont">
	  <div class="columnSpace">
<div  class="FrontNews_list01-d1_c1_01"><div>
		<ul class="comstyle newslist-01">
		 	<li class="content column-num1">
			 	<div class="newstitle">
					<ul>
						<li class="title">
							<h3>
							<a href="{WEB_URL}/?t=detail&id={$art_info1['id']}&c={$art_info1['cid']}&ast={$art_info1['astyle']}" title="{$art_info1['name']}" target="_blank" limit="30">
												{$art_info1['name']}</a>
										</h3>
						</li>
						<li class="date"><span></span>{$art_info1['ct']}</li>
				   	</ul>
				</div>
			</li>
EOF;
    foreach($art_info2 as $row){
        $m3_html.=<<<EOF
			<li class="content column-num1">
			 	<div class="newstitle">
					<ul>
						<li class="title">
							<h3>
							<a href="{WEB_URL}/?t=detail&id={$row['id']}&c={$row['cid']}&ast={$row['astyle']}" title="{$row['name']}" target="_blank" limit="30">
												{$row['name']}</a>
										</h3>
						</li>
						<li class="date"><span></span>{$row['ct']}</li>
				   	</ul>
				</div>
			</li>
EOF;
	}
        $m3_html.=<<<EOF
		</ul>
	</div>
	</div></div>
	  </div>
	  </div>
	  <!-- 苦荞知识结束 -->
	  
EOF;
}
	    $m3_html.=<<<EOF
          <div class="clearBoth"></div>
        </div>  
        <!-- 健康顾问结束 -->  
EOF;
        }
        }
        
		$T->Set("m3_html",$m3_html);
		break;
	case "list":
        $cid=isset($_GET['c'])?$_GET['c']:'';
		if(empty($cid))exit;
		$cid_info=$acd->getInfoByCid($cid);//获取当前栏目信息
		$T->Set("cid_name",$cid_info['name']);
		//获取所有级pid
		$pids_arr=$acd->getPidByCid($cid);
		//顶级pid
		$tpid=$pids_arr[count($pids_arr)-1];
		$T->Set("tpid",$tpid['id']);
		$T->Set("tpid_name",$tpid['name']);
		//遍历左侧栏目
		$T->SetBlock("cate_list", "select id,name,cstyle from main_art_category where pid=".$tpid['id']." order by odx");              	
        //获取cid下所有级子栏目
        $childs_arr=$acd->getCidByPid($cid);
		array_push($childs_arr,$cid);
		$cids_str=implode(",", $childs_arr);
		$p=isset($_GET['p'])?$_GET['p']:1;
		//注意此处写法！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！1
		$T->SetBlock("arts_list","select id,name,CreateTime,cid,'".$tpid['astyle']."' as astyle from main_article where state=2 and cid in (".$cids_str.") order by isTop desc,".$acd->aco($cid)." limit ".(($p-1)*20).",20",array("CreateTime"),array("%Y-%m-%d"));
		$rc=$T->db->query("select count(1) from main_article where state=2 and cid in (".$cids_str.")")->fetchColumn(0);
		$pagehtml=getPageHtml($rc,20,$p,"&t=list&c={$cid}&cst={$cid_info['cstyle']}");
		$T->Set("page",$pagehtml);

        break;
	case "pic_content":
        $cid=isset($_GET['c'])?$_GET['c']:'';
		if(empty($cid))exit;
		$cid_info=$acd->getInfoByCid($cid);//获取当前栏目信息
		$T->Set("cid_name",$cid_info['name']);
		//获取所有级pid
		$pids_arr=$acd->getPidByCid($cid);
		//顶级pid
		$tpid=$pids_arr[count($pids_arr)-1];
		$T->Set("tpid",$tpid['id']);
		$T->Set("tpid_name",$tpid['name']);
		//遍历左侧栏目
		$T->SetBlock("cate_list", "select id,name,cstyle from main_art_category where pid=".$tpid['id']." order by odx");    
		//获取顶级pid下第一级子栏目
        $childs_arr_one=$acd->getCidByPid($tpid['id'],'',1);
		$show_cid=($cid==$tpid['id']&&count($childs_arr_one)!=0)?$childs_arr_one[0]:$cid;//用于打开页面时直接显示第一个栏目下的文章(只有当传入的cid是顶级父栏目时)          	    //获取$show_cid下所有级子栏目
        $childs_arr=$acd->getCidByPid($show_cid);
		array_push($childs_arr,$show_cid);
		$cids_str=implode(",", $childs_arr);
        $T->SetBlock("art_content","select *,'".$cid_info['name']."' as cid_name from main_article where cid in (".$cids_str.") and state=2 order by isTop desc,".$acd->aco($show_cid)."  limit 0,1",array("CreateTime"),array("%Y-%m-%d"));

        break;
    case "detail":              
        $id=isset($_GET['id'])?$_GET['id']:'';
		$cid=isset($_GET['c'])?$_GET['c']:'';
		if(empty($cid)||empty($id))exit;
		$cid_info=$acd->getInfoByCid($cid);//获取当前栏目信息
		$T->Set("cid_name",$cid_info['name']);
        //获取所有级pid
		$pids_arr=$acd->getPidByCid($cid);
		//顶级pid
		$tpid=$pids_arr[count($pids_arr)-1];
		$T->Set("tpid",$tpid['id']);
		$T->Set("tpid_name",$tpid['name']);
		//遍历左侧栏目
		$T->SetBlock("cate_list", "select id,name,cstyle from main_art_category where pid=".$tpid['id']);            
		
		$T->SetBlock("art_content","select *,'".$cid_info['name']."' as cid_name from main_article where id={$id} and state=2",array("CreateTime"),array("%Y-%m-%d"));

        break;
	case "consult_form":
	    $cid=isset($_GET['c'])?$_GET['c']:'';
		if(empty($cid))exit;
		$cid_info=$acd->getInfoByCid($cid);//获取当前栏目信息
		$T->Set("cid_name",$cid_info['name']);
		//获取所有级pid
		$pids_arr=$acd->getPidByCid($cid);
		//顶级pid
		$tpid=$pids_arr[count($pids_arr)-1];
		$T->Set("tpid",$tpid['id']);
		$T->Set("tpid_name",$tpid['name']);
		//遍历左侧栏目
		$T->SetBlock("cate_list", "select id,name,cstyle from main_art_category where pid=".$tpid['id']." order by odx");  
	    $T->Set("ip",getIP());
        break;
	case "consult_list":  
		$cid=isset($_GET['c'])?$_GET['c']:'';
		if(empty($cid))exit;
		$cid_info=$acd->getInfoByCid($cid);//获取当前栏目信息
		$T->Set("cid_name",$cid_info['name']);
		//获取所有级pid
		$pids_arr=$acd->getPidByCid($cid);
		//顶级pid
		$tpid=$pids_arr[count($pids_arr)-1];
		$T->Set("tpid",$tpid['id']);
		$T->Set("tpid_name",$tpid['name']);
		//遍历左侧栏目
		$T->SetBlock("cate_list", "select id,name,cstyle from main_art_category where pid=".$tpid['id']." order by odx");              	
		$p=isset($_GET['p'])?$_GET['p']:1;
		$T->SetBlock("consult_list","select a.*,c.des from consult_art a left join consult_art_comment c on a.id=c.aid where a.show=2  order by a.timestamp desc limit ".(($p-1)*8).",8",array("timestamp"),array("%Y-%m-%d"));
		$rc=$T->db->query("select count(1) from consult_art a left join consult_art_comment c on a.id=c.aid where a.show=2")->fetchColumn(0);
		$pagehtml=getPageHtml($rc,8,$p,"&t=list&c={$cid}&cst={$cid_info['cstyle']}");
		$T->Set("page",$pagehtml);
		break;
        //产品列表
    case "products":
        $cid=isset($_GET['c'])?$_GET['c']:'';
		if(empty($cid))exit;
		$cid_info=$acd->getInfoByCid($cid);//获取当前栏目信息
		$T->Set("cid_name",$cid_info['name']);
		//获取所有级pid
		$pids_arr=$acd->getPidByCid($cid);
		//顶级pid
		$tpid=$pids_arr[count($pids_arr)-1];
		$T->Set("tpid",$tpid['id']);
		$T->Set("tpid_name",$tpid['name']);
		//遍历左侧栏目
		$T->SetBlock("cate_list", "select id,name,cstyle from main_art_category where pid=".$tpid['id']." order by odx");              	
        //获取cid下所有级子栏目
        $childs_arr=$acd->getCidByPid($cid);
		array_push($childs_arr,$cid);
		$cids_str=implode(",", $childs_arr);
		$p=isset($_GET['p'])?$_GET['p']:1;
		//注意此处写法！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！1
		$T->SetBlock("arts_list","select id,name,thumb,CreateTime,cid,'".$tpid['astyle']."' as astyle from main_article where state=2 and cid in (".$cids_str.") order by isTop desc,".$acd->aco($cid)." limit ".(($p-1)*20).",20",array("CreateTime"),array("%Y-%m-%d"));
		$rc=$T->db->query("select count(1) from main_article where state=2 and cid in (".$cids_str.")")->fetchColumn(0);
		$pagehtml=getPageHtml($rc,20,$p,"&t=list&c={$cid}&cst={$cid_info['cstyle']}");
		$T->Set("page",$pagehtml);

        break;
        //产品详情
    case "product":              
        $id=isset($_GET['id'])?$_GET['id']:'';
		$cid=isset($_GET['c'])?$_GET['c']:'';
		if(empty($cid)||empty($id))exit;
		$cid_info=$acd->getInfoByCid($cid);//获取当前栏目信息
		$T->Set("cid_name",$cid_info['name']);
        //获取所有级pid
		$pids_arr=$acd->getPidByCid($cid);
		//顶级pid
		$tpid=$pids_arr[count($pids_arr)-1];
		$T->Set("tpid",$tpid['id']);
		$T->Set("tpid_name",$tpid['name']);
		//遍历左侧栏目
		$T->SetBlock("cate_list", "select id,name,cstyle from main_art_category where pid=".$tpid['id']);              	
        
		
		$T->SetBlock("art_content","select *,'".$cid_info['name']."' as cid_name from main_article where id={$id} and state=2",array("CreateTime"),array("%Y-%m-%d"));

        break;

	case "arts":
		$cid=isset($_GET['c'])?$_GET['c']:2;
		$pid=isset($_GET['pid'])?$_GET['pid']:1;
		
		#文章列表
		#子栏目
		$T->SetBlock("arts_xwzx","select id,name,pid from main_art_category where pid={$pid} order by timestamp asc");
		$T->SetBlock("arts_xwzx_name","select id,name,pid from main_art_category where id={$cid}");
		$T->SetBlock("arts_xwzx_title","select id,name,pid from main_art_category where id={$cid}");
		
		$T->SetBlock("arts_title","select id,name,pid from main_art_category where id={$pid}");//查询大分类
		
		#文章标题列表
		$p=isset($_GET['p'])?$_GET['p']:1;
		$T->SetBlock("arts_qnxw_1","select id,name,CreateTime,CreateTime as ct,cid,isTop from main_article where cid={$cid} order by isTop desc,CreateTime desc limit ".(($p-1)*20).",20",array("CreateTime"),array("%Y-%m-%d"));
		/*$T->SetBlock("arts_qnxw_2","select id,name,CreateTime,CreateTime as ct,cid,isTop from main_article where cid={$cid} order by isTop desc,CreateTime desc limit 5,5",array("CreateTime"),array("%Y-%m-%d"));
		$T->SetBlock("arts_qnxw_3","select id,name,CreateTime,CreateTime as ct,cid,isTop from main_article where cid={$cid} order by isTop desc,CreateTime desc limit 10,5",array("CreateTime"),array("%Y-%m-%d"));
		$T->SetBlock("arts_qnxw_4","select id,name,CreateTime,CreateTime as ct,cid,isTop from main_article where cid={$cid} order by isTop desc,CreateTime desc limit 15,5",array("CreateTime"),array("%Y-%m-%d"));*/
		
		#分页
		
		$rc=$T->db->query("select count(1) from main_article where cid={$cid}")->fetchColumn(0);
		$pagehtml=getPageHtml($rc,20,$p,"&t=arts&c={$cid}&pid={$pid}");
		$T->Set("page",$pagehtml);
		$T->SetBlock("arts","select id,name,CreateTime,CreateTime as ct,isTop from main_article where cid={$cid} order by isTop desc,CreateTime desc limit ".(($p-1)*20).",20");
		
		break;
	case "art":
		$id=isset($_GET['id'])?$_GET['id']:1;
		$cid=isset($_GET['c'])?$_GET['c']:2;
		$pid=isset($_GET['pid'])?$_GET['pid']:1;
		//timestamp改为CreateTime
		$T->SetBlock("art_content","select name,des,see,CreateTime,CreateTime as ct,see,froms from main_article where id={$id}",array("CreateTime"),array("%Y-%m-%d"));
		$T->SetBlock("art_title","select id,name,pid from main_art_category where id={$cid}");
		$T->SetBlock("art_cate","select id,name,pid from main_art_category where id={$pid}");//查询大分类
		$T->SetBlock("art_before","select id,name,cid from main_article where id={$id}-1");
		$T->SetBlock("art_after","select id,name,cid from main_article where id={$id}+1");
		break;
	case "search":
		$keyword=$_GET['keyword'];
		$T->SetBlock("search_list","select id,name,CreateTime,CreateTime as ct,cid from main_article where name like '%{$keyword}%' order by CreateTime desc",array("CreateTime"),array("%Y-%m-%d"));
		#分页
		$p=isset($_GET['p'])?$_GET['p']:1;
		$rc=$T->db->query("select count(1) from main_article where name like '%{$keyword}%'")->fetchColumn(0);
		$pagehtml=getPageHtml($rc,10,$p,"&t=search&keyword={$keyword}");
		$T->Set("page",$pagehtml);
		$T->SetBlock("search","select id,name,CreateTime,CreateTime as ct,isTop from main_article where name like '%{$keyword}%' order by CreateTime desc limit ".(($p-1)*10).",10");
		$T->Set("keyword",$keyword);
		break;
	
    case "add_consult":
		$T->Set("ip",getIP());
   
	break;
	case "info_consult":
		$id=isset($_GET['id'])?$_GET['id']:1;
		$T->SetBlock("list","select ca.*,cac.des from consult_art as ca left join consult_art_comment as cac on cac.aid=ca.id where ca.id={$id}");
		break;
	case "arts_consult":
		#子栏目
		$cid=isset($_GET['c'])?$_GET['c']:0;
		$T->SetBlock("arts_xwzx","select id,name from consult_art_category order by timestamp asc");
		$T->SetBlock("arts_xwzx_name","select id,name from consult_art_category where id={$cid}");
		$mname=$T->db->query("select name from consult_art_category where id={$cid}")->fetchColumn(0);
		$p=isset($_GET['p'])?$_GET['p']:1;

		if($cid==0){
		$rc=$T->db->query("select count(1) from consult_art ")->fetchColumn(0);
		$pagehtml=getPageHtml($rc,20,$p,"&t=arts_consult&c={$cid}");
		$T->Set("page",$pagehtml);
		$T->SetBlock("arts_consult","select ca.*,cac.name as menuname from consult_art as ca left join consult_art_category as cac on cac.id=ca.cid order by ca.id desc limit ".(($p-1)*20).",20",array("timestamp"),array("%Y-%m-%d"));
		$T->Set("mname","在线咨询");
		}else{
		$rc=$T->db->query("select count(1) from consult_art where cid={$cid}")->fetchColumn(0);
		$pagehtml=getPageHtml($rc,20,$p,"&t=arts_consult&c={$cid}");
		$T->Set("page",$pagehtml);
		$T->SetBlock("arts_consult","select ca.*,cac.name as menuname from consult_art as ca left join consult_art_category as cac on cac.id=ca.cid where ca.cid={$cid} order by ca.id desc limit ".(($p-1)*20).",20",array("timestamp"),array("%Y-%m-%d"));
		$T->Set("mname",$mname);
		}
		break;
	default:	
		
		break;	
}

//全局变量
$T->Set("WEB_NAME",WEB_NAME);
$T->Set("WEB_URL",WEB_URL);
$T->Set("WEB_KEYWORD",WEB_KEYWORD);
$T->Set("WEB_DES",WEB_DES);
$T->Set("WEB_EMAIL",WEB_EMAIL);
$T->Set("DIR_ROOT",DIR_ROOT);

  

#释放资源
$T->clearNoN();
$T->clearNaN();
if(S_STATE=='1'){
	ob_start();
	$T->display();
	$ob_html=ob_get_contents();
	$fp=fopen($std->s_file_path,"w");
	fwrite($fp,$ob_html);
	fclose($fp);
}else{
	$T->display();
}
$T->close();	
unset($T);