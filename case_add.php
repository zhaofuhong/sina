<meta charset="utf-8">
<?php 
include 'databases.php';
if (isset($_POST['tijiao'])){  //判断是否有文件提交操作，判断按钮<input type="submit" name="file" value="上传" />
 $xin='';
 if ($_FILES['file']['error']==0){
     $aa=$_FILES['file']['name'];//取得文件名
     $ab=explode(".", $aa);        //把文件名转化为数组，点为分界点
     $ac=end($ab);                 //取数组的最后一个当后缀名
     $ad=time().'.'.$ac;           //新文件名    :时间戳+后缀名。
     $old=$_FILES['file']['tmp_name']; //取得旧的文件临时储存地址;

     //创建 自动时间目录 存放文件，
     $year=date('Y',time());
     $yue=date('m',time());
     $day=date('d',time());

     if (is_dir($year)){ //1、判断是否有年
         if (is_dir($year.'/'.$yue)){
             if (is_dir($year.'/'.$yue.'/'.$day)){
                  
             }else {
                 mkdir($year.'/'.$yue.'/'.$day);
             }
              
         }else {
             mkdir($year.'/'.$yue);
             if (is_dir($year.'/'.$yue.'/'.$day)){
             }
             else {
                 mkdir($year.'/'.$yue.'/'.$day);
             }
         }
          
     }
     else {
         mkdir($year);//1、没有年创建
         if (is_dir($year.'/'.$yue)){
             if (is_dir($year.'/'.$yue.'/'.$day)){

             }
             else{
                 mkdir($year.'/'.$yue.'/'.$day);
             }

         }else {
             mkdir($year.'/'.$yue);
             if (is_dir($year.'/'.$yue.'/'.$day)){

             }else {
                 mkdir($year.'/'.$yue.'/'.$day);
             }
         }
     }
     $xin=$year.'/'.$yue.'/'.$day.'/'.$ad;
     $_SESSION['tupian']=$xin;                          //设置$_SESSION;
     // var_dump($_SESSION);exit;
     //setcookie('file',$xin,time()+36000);  //设置cookie
     move_uploaded_file($old, $xin);//旧路径，转新路径
 }
}



if (isset($_POST['tijiao'])){
    $lanmua=$_POST['lanmua'];
    $lanmub=$_POST['lanmub'];
    $lanmuc=$_POST['lanmuc'];
    $username=$_POST['username'];
    $content=$_POST['content'];
    $title=$_POST['title'];
    $time=time();
    $sql="insert into news(`lanmua`,`lanmub`,`lanmuc`,`username`,`content`,`tltles`,`times`,`files`) 
        values('$lanmua','$lanmub','$lanmuc','$username','$content','$title','$time','$xin')";
    $aa=mysql_query($sql);
    var_dump($aa);    //echo "<script>alert('$aa')</script>";
}
?>
<?php 
include 'header.php';
?>


  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">添加案例</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="" method="post" class="cmxform" enctype="multipart/form-data">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">添加案例</div>
              <div class="panel-btns pull-right margin-left">
              <a href="case_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">
                          
                <div class="form-group">
                  <div class="input-group"style="width: 700px;height: 50px;">
                  	 <span class="input-group-addon"style="height: 40px;float: left;width:80px;margin: 20px 0px 20px 0px;border: 1px solid #cccccc;">所属分类</span>
	                  	<div style="float: left;width: 200px;height: 40px;">
	                  		<p style="float: left;margin-top: 20px;width: 60px;height: 40px;line-height: 40px;background: #eeeeee;border: 1px solid #cccccc;">一级导航</p>
		                    <select  name="lanmua" class="form-control" style="margin-top:20px;float: left;width: 130px;height: 40px;">
		                          <option value="1">栏目选择</option>
		                          <option value="首页">首页</option>
		                          <option value="关于伦次">关于伦次</option>
		                          <option value="解决方案">解决方案</option>
		                          <option value="产品介绍">产品介绍</option>
		                          <option value="诚聘精英">诚聘精英</option>
		                          <option value="服务支持">服务支持</option>
		                          <option value="联系我们">联系我们</option>
		                    </select>
		                    
		                </div>
		                 <div style="float: left;width: 180px;height: 40px;margin: 20px 0px 0px -10px;">  
	                        <p style="float: left;width: 60px;height: 40px;background: #eeeeee;border: 1px solid #cccccc;line-height: 40px;">二级导航</p>
	                    	<input type="text" name="lanmub" style="float: left;width: 100px;height: 40px;" />
	                    
	                    </div>  
	                    <div style="float: left;width: 180px;height: 40px;margin: -40px 0px 0px 360px;"> 
	                    	<p style="float: left;width: 60px;height: 40px;background:#eeeeee;border: 1px solid #cccccc;line-height: 40px;">三级导航</p>
	                    	<input type="text" name="lanmuc" style="float: left;width: 100px;height: 40px;" />
	                    </div>	
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">案例名称</span>
                    <input type="text" name="username" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                    <div class="input-group"> <span class="input-group-addon">案例描述</span>
                        <input type="text" name="title" value="" class="form-control">
                    </div>
                </div>
                
                        <input type="file" name="file" value="" >
               
                </div>
                </div>
                <div class="form-group col-md-12">
                  <script type="text/plain" id="myEditor" style="width:100%;height:200px;"name="content">
					<p></p>
				  </script>
                </div>
                <div class="col-md-7">
	                <div class="form-group">
	                  <input type="submit" name="tijiao" value="提交" class="submit btn btn-blue">
	                </div>
                </div>
            </div>
          </div>
          </form>
        </div>
    </div>
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main --> 
<link type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css" >
<script src="umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="umeditor/editor_api.js" type="text/javascript"></script>
<script src="umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>
<script type="text/javascript">
var ue = UM.getEditor('myEditor',{
    autoClearinitialContent:true,
    wordCount:false,
    elementPathEnabled:false,
    initialFrameHeight:300
});
</script>
</body>

</html>