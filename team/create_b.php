<?
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

//将出错信息输出到一个文本文件
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
?>
<html>
<head>
 <title></title>
 <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <meta http-equiv='Pragma' content='no-cache' />



 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
    <form class="form-inline my-2 my-lg-0" action="mine.php">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">我的队伍</button>
    </form>
  </div>
</nav>
<style>
textarea
{
width:100%;
height:300;
}
</style>
<?
include("db.php"); 

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
if ($con->connect_error)
{
    echo "error";
    die('Could not connect: ' . mysql_error());
}
else
{
    $u=unlock_url($_COOKIE['username']);//解密
    //echo "连接成功";
    $__name=$_POST["name"];  
    $__desc=$_POST["desc"];  //获取页面参数
    //先查询队伍名字有米有重
    $con->query("set names utf8");
    $_t_sql="select * from team_usr where team_name = '{$__name}'";   //判断队伍名字
		if($con->query($_t_sql)->num_rows==0)  //如果没有重名
		{
      $sql="INSERT INTO  team_usr ( team_name , team_desc   ) VALUES (  '{$__name}',  '{$__desc}' );";  //将信息插入
      $con->query($sql);//创建队伍

      $_t_sql="select id from team_usr where team_name = '{$__name}'";   //获取队伍ID
      $result=$con->query($_t_sql);
      while($row = $result->fetch_assoc())
			{
        
      }

      //echo $con;
      $sql = "UPDATE bbs_user SET team_id={$row['id']} ,is_cap=1 where username = '{$u}';"; //设定当前用户的队伍状态
      $con->query($sql);
    }
}


?>
<!--头部结束-->
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<hr>
			<h4>
				队伍[<?echo $_POST['name']?>]创建成功！
			</h4>
            <a href="index.php" >返回首页 </a>
		</div>
	</div>
</div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
