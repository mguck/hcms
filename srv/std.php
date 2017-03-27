<?php
/* 静态化和定时清理相关处理
 * 
 */
 class STD{
	 public  $qname;//请求的模板名
	 public  $aid;//文章id
	 public  $cid;//栏目id
	 public  $p;//分页页码
	 private $s_expir;//静态文件有效期
	 private $s_root_path;//静态文件根目录
	 public  $s_file_path;//文件路径（包含文件名）
	 private $s_auto_clean;//是否开启定时清理
	 private $s_auto_clean_expir;//自动清理的间隔时间
	 private $timer;//定时器任务时间戳，过去某个时间点
	 
	 function __construct($qname,$aid,$cid,$p,$s_expir=S_EXPIR,$s_root_path=S_ROOT_PATH,$s_auto_clean=S_AUTO_CLEAN,$s_auto_clean_expir=S_AUTO_CLEAN_EXPIR,$timer=TIMER){
		$this->qname=$qname;
		$this->aid=$aid;
		$this->cid=$cid;
		$this->p=isset($p)?abs($p):1;
		$this->s_expir=$s_expir;
		$this->s_root_path=rtrim($s_root_path,'/');
		$this->s_auto_clean=$s_auto_clean;
		$this->s_auto_clean_expir=$s_auto_clean_expir;
		$this->timer=$timer;
	 }
	 
	 //检测与设置存储目录、文件名
	 public function init(){
		 if(!is_dir($this->s_root_path)){
			 mkdir($this->s_root_path,0777,true);
		 }
		 $s_child_path="/";//静态页子目录
	     $s_file_name=$this->qname.".htm";//静态页文件名
		 if($this->qname!='index'){
			$s_child_path=(isset($this->aid)&&!empty($this->aid))?"/a/":"/c/";//c为栏目静态页，a为文章静态页
			$s_file_name=($s_child_path=='/a/')?($this->qname.'_'.$this->aid.'.htm'):($this->qname.'_'.$this->cid.'_'.$this->p.'.htm');//形如list_21.htm
		 }
		 $s_file_dir=$this->s_root_path.$s_child_path;
		 if(!is_dir($s_file_dir)){
			 mkdir($s_file_dir,0777);
		 }
		 $this->s_file_path=$s_file_dir.$s_file_name;
	 }
	 
	 //加载有效期内的静态文件
	 public function loadFile(){
		 if(file_exists($this->s_file_path)){
			 $filemtime=filemtime($this->s_file_path);//文件最后修改时间
			 if((time()-$filemtime)<3600*24*$this->s_expir){//在有效期内
				 require($this->s_file_path);//加载静态页面
				 return true;
			 }
		 }		 
		 return false;
	 }
	 
	 //定时清理
	 public function autoClean(){
		 //判断定时器任务，清理过期文件
		 if((time()-$this->timer)>3600*24*$this->s_auto_clean_expir){
			 $this->loopDel($this->s_root_path);
			 //更新配置文件的timer值
			 $this->updateTimer();
		 }
	 }
	 
	 //遍历静态文件根目录，删除过期文件
	 private function loopDel($dir){
		 if(is_dir($dir)){
			 if($handle=opendir($dir)){
				 while(($file=readdir($handle))!==false){
					 if($file!="." && $file!=".."){
						 if(is_dir($dir.'/'.$file)){
							 $this->loopDel($dir.'/'.$file);
						 }else{
							 $filemtime=filemtime($dir.'/'.$file);
							 if((time()-$filemtime)>3600*24*$this->s_expir){//判断有效期内
								 //echo $dir.'/'.$file.'<br/>';
								 unlink($dir.'/'.$file);
							 }
						 }
					 }
				 }
				 closedir($handle);
			 }
		 }
	 }
	 
	 //更新配置文件定时器时间戳timer
	 private function updateTimer(){
		 $new_timer=time();
		 $p=file_get_contents('./cfg/config.inc');
		 $p=str_replace("define('TIMER', '".($this->timer)."')","define('TIMER', '".$new_timer."')",$p);
		 file_put_contents('./cfg/config.inc',$p); 	
		 unset($p);
	 }
 }

?>