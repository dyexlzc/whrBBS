<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
    
  </head>
  
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Whr队友搜索</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./">首页 <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          讨论区
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./?forum-2.htm">队友招聘</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="./?forum-1.htm">官方信息</a>

        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<br>
    <?
        //在本页显示隐藏的真实姓名以及包含关键字的自我介绍，真实姓名链接指向论坛的个人主页，默认隐藏所有信息
          include ("../db.php");//引用总的数据库文件
    ?>
    <script>
    function check(form){
    var name= document.getElementById("text_for_major");
    if(name.value.length <= 0)
    { alert('请输入要查询的专业名字'); return false; }
   return true;
    }
    </script>
  <div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span12">
                <form action="searchMa.php" method="get">
					<div class="input-group mb-3">
						<input name="text_for_major" id="text_for_major" type="text" class="form-control" placeholder="搜索专业或拼音查询" aria-label="Recipient's username" aria-describedby="basic-addon2">
						
							<button class="btn btn-outline-secondary" type="submit" onclick="return check(this)">🔍搜索</button>
						
					</div>
				</form>
				</div>
			</div>
			<table class="table table-hover">
				<thead  class="thead-dark"> <!--表头-->
					<tr>
						<th>
							姓名
						</th>
						<th>
							队友宣言
						</th>
					</tr>
                </thead>
                
                <?
                $con = new mysqli($host,$name,$pwd,$db);
                if ($con->connect_error)
                {
                  die('Could not connect: ' . mysql_error());
                }
                else
                    
                {
                    $major=$_GET["text_for_major"]; //获取get参数,需要支持多参数查询

                    $_t_sql="";
                    $iparr = spliti ("\ ", $major); 
                    if(count($iparr)==1)
                    $_t_sql=" SELECT uid,realname,other,major from bbs_user  WHERE other LIKE '%{$major}%';"; //组合参数为LIKE语句模糊查询
                    else{
                    $_t_sql=" SELECT uid,realname,other,major from bbs_user  WHERE "; //组合参数为LIKE语句模糊查询
                    foreach ($iparr as $str){
                    if($str==$iparr[count($iparr)-1]) $_t_sql=$_t_sql." other LIKE '%{$str}%';";//循环添加条件
                    else $_t_sql=$_t_sql." other LIKE '%{$str}%' or";//循环添加条件

                    }
                                                
                                                
                    }
                        console.log($_t_sql);
                        $con->query("set names utf8;");//查询不到中文就要设置这个东西
                        $result=$con->query($_t_sql);//执行语句
                        if($result->num_rows!=0) //如果查询到结果
                        {
                            while($row = $result->fetch_assoc())//显示查询结果
                            {?>

                            
                                  <tbody><!--内容-->
                                    <tr>
                                        <td>
                                            <a href=" ./?user-<?echo $row['uid'];?>.htm"><?echo $row["realname"]; echo $result->num_rows;?></a>
                                        </td>
                                        <td>
                                           <?echo  $row["other"];?>
                                        </td>
                                    </tr>  
                                </tbody> 
                            
                            <?}
                        }?>
                        
                        
                        
                        <?
                }
                
                $con->close();
                
                ?>

			</table>
		</div>
	</div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>