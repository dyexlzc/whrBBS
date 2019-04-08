<?
error_reporting(E_ALL);
ini_set('display_errors', '1');

//将出错信息输出到一个文本文件
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
?>
<html>
<head>
 <title>我的队伍</title>
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
    
  </div>
</nav>
<style>
textarea
{
width:100%;
height:300;
}
</style>
<div class="container">
	<div class="row clearfix">
<?
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
include("db.php"); 

$con = new mysqli($host,$name,$pwd,$db);

if ($con->connect_error)
{
    echo "error";
    die('Could not connect: ' . mysql_error());
}
else
{
    $con->query("set names utf8");
    $u=unlock_url($_COOKIE['username']);//解密
    //查询看用户是否加入了队伍,如果没有加入队伍则提示清先加入队伍
    $_t_sql="select team_id,is_cap from bbs_user where username = '{$u}';";
    $result=$con->query($_t_sql);
    $tok=true;
    while($row = $result->fetch_assoc())//ȡ�ù�������
    {
        if($row['team_id']==""||$row['team_id']=="-1"||$row['team_id']==NULL) //如果该人没有加入队伍，就显示提示信息
        {
            if(count($_GET)>0) //如果传来了加入房间的请求，就允许此人加入房间，只能加入一个房间，加入后首页的加入按钮消失，没加入可以联系队长
            {
                $sql_="UPDATE bbs_user SET team_id={$_GET['join']} ,is_cap=0 where username = '{$u}';";  //则更新相应信息:加入队伍且不是队长
                
	            $con->query($sql_);
            }
            else
            {
                $tok=false;
               
        ?>
            
            <div class="col-md-12 column">
                <hr>
		    </div>
            <div class="col-md-12 column">
                <h3>
                    请先加入队伍。  <a class='btn btn-primary' href="index.php"> 返回首页 </a>
                </h3>
            </div>
            
        
        <? 
            }
        }
        
            if($tok!=false){?>
         <div class="col-md-8 column">
         <hr>
         <h3>队伍名称：<?
         $tid=count($_GET)>0?$_GET['join']:$row['team_id'];
         $_t_sql="select team_name from team_usr where id = {$tid};";
         $result=$con->query($_t_sql);
         while($row2 = $result->fetch_assoc())//ȡ�ù�������
         {
            echo $row2['team_name'];
         }
         
         ?></h3>
         <hr>
         <iframe src="http://cneuralc.tk/whr/bbs/chating/room-uid.php?team_id=<?echo $tid; //拉起指定房间的聊天室,应该要指定只有你存在于该房间所对应的列表中才能访问该聊天室?>" frameborder="0" width="100%" height="500px"></iframe>
		</div>
		<div class="col-md-4 column">
            <hr>
			<h3>
				队伍聊天大厅  <a class='btn btn-primary' href='index.php?quit=1'>退出队伍</a>     
			</h3>
		</div>
        
        <?
            }   
        
    }
   // $sql="INSERT INTO  team_usr ( team_name , team_desc   ) VALUES (  '{$__name}',  '{$__desc}' );";
    //echo $sql;
    //$con->query($sql);
    //echo $con;

}


?>

       
	</div>
</div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
