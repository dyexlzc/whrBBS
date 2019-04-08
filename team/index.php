
<html>
<head>
<?header("Content-type: text/html; charset=utf-8");?>
 <title><?php  echo $title;?></title>
 <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <meta http-equiv='Pragma' content='no-cache' />
 <meta http-equiv=Content-Type content="text/html; charset=<?php echo $charset;?>" />
 <meta name="keywords" content="<?php echo $lang["keywords"];?>">
 <meta name="description" content="Mini AJAX Chatroom By Longbill. <?php echo $description;?>">
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<style media="screen,print">
	#body {
		width:70em;
		max-width:100%;
		margin:0 auto;
	}
	iframe {
		width:100%;
		margin:0 0 1em;
		border:0;
	}
	</style>

</head>
<body >
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Whr组队中心</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../">首页 <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          讨论区
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="../chating">在线交流</a>
			<a class="dropdown-item" href="../team">组队中心</a>
			<div class="dropdown-divider"></div>
          	<a class="dropdown-item" href="../?forum-2.htm">队友招聘</a>
          
          	<a class="dropdown-item" href="../?forum-1.htm">官方信息</a>

        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="creat.php">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">创建队伍</button>
    </form>
		<form class="form-inline my-2 my-lg-0" action="mine.php">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">我的队伍</button>
    </form>
  </div>
</nav>
<script>

	function setIframeHeight(iframe) {
	if (iframe) {
    	var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
    	if (iframeWin.document.body) {
    	    iframe.width = iframeWin.document.documentElement.scrollWidth || iframeWin.document.body.scrollWidth;
    	}
	}
	};
	
	window.onload = function () {
	setIframeWidth(document.getElementById('external-frame'));
	};

</script>
<iframe id="external-frame" src="http://whrhost.tk/whr/bbs/chating/room-uid.php?team_id=0" frameborder="0" height="500px" onload="setIframeHeight(this)"></iframe>
<!--头部结束-->
<div class="container-fluid">
	
	<div class="row clearfix">
				<!--展示热门用户-->
				<div class="col-md-12 column">
					<?
							include("../../db.php");
							$con = new mysqli($host,$name,$pwd,$db);
							function unlock_url($txt,$key='cdyexlzc')
							{
								$txt = urldecode($txt);
								$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
								$ch = $txt[0];
								$nh = strpos($chars,$ch);
								$mdKey = md5($key.$ch);
								$mdKey = substr($mdKey,$nh%8, $nh%8+7);
								$txt = substr($txt,1);
								$tmp = '';
								$i=0;$j=0; $k = 0;
								for ($i=0; $i<strlen($txt); $i++) {
									$k = $k == strlen($mdKey) ? 0 : $k;
									$j = strpos($chars,$txt[$i])-$nh - ord($mdKey[$k++]);
									while ($j<0) $j+=64;
									$tmp .= $chars[$j];
								}
								return base64_decode($tmp);
							}
							function random_color(){
								$i=rand(0,5);
								//echo $i;
								switch($i)
								{
									case 0:
										return 'card border-primary mb-3';
									case 1:
										return 'card border-secondary mb-3';
									case 2:
										return 'card border-success mb-3';
									case 3:
										return 'card border-info mb-3';
									case 4:
										return 'card border-light mb-3';
									case 5:
										return 'card border-dark mb-3';
								}
							}
							if ($con->connect_error)  //循环取出当前所有队伍及人物进行排版
							{
								echo "error";
								die('Could not connect: ' . mysql_error());
							}
							else{
							    $con->query("set names utf8");
								$u=unlock_url($_COOKIE['username']);//解密
								//判断是否由后台传来了退出的指令
								if(count($_GET)>0){
									if($_GET['quit']==1){
										$sql = "UPDATE bbs_user SET team_id=NULL ,is_cap=0 where username = '{$u}';"; //讲当前用户的队伍状态归零
										$con->query($sql);
									}
								}
								$sql = "SELECT * FROM  `team_usr` ;";  //从数据库选取数据 
								$result=$con->query($sql);
								if($result->num_rows!=0)  
								{
									while($row = $result->fetch_assoc())//取得关联数组
									{
									
								?>  <div class="<? echo random_color(); ?>" >
										<div class="card-header">队伍名称：<?  echo $row['team_name'];?></div>
											<div class="card-body">
												
												<div class="row clearfix">
													<div class="col">
															<h5 class="card-title">队伍描述:<? echo $row['team_desc'];?></h5>
															<p class="card-text">加入情况</p>
													</div>
													<div class="col-ms">
															<? if(!isset($_COOKIE['username'])) { ?>
																	
															<?   header("location:http://whrhost.tk/whr/bbs/custompage/Login.php"); ?>
																<p class="card-text">清先登录</p>
															<? } else {  //加入组队按钮在已经加入后就会消失?>
															
																<a class='btn btn-primary' href='mine.php?join=<? echo $row['id']; ?>'>加入组队</a>
															<?  } ?>
													</div>
													<div class="col-2-ms">
														&nbsp;  
													</div>
												</div>
											</div>
											
									</div>
								<?
									}
							}
						}
						?>
				</div>
			</div>



</div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
