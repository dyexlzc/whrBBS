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
  <div class="navbar">
				<div class="navbar-inner">
					<div class="container-fluid">
						 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> <a href="#" class="brand">网站名</a>
						<div class="nav-collapse collapse navbar-responsive-collapse">
							<ul class="nav">
								<li class="active">
									<a href="#">主页</a>
								</li>
								<li>
									<a href="#">链接</a>
								</li>
								<li>
									<a href="#">链接</a>
								</li>
								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#">下拉菜单<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li>
											<a href="#">下拉导航1</a>
										</li>
										<li>
											<a href="#">下拉导航2</a>
										</li>
										<li>
											<a href="#">其他</a>
										</li>
										<li class="divider">
										</li>
										<li class="nav-header">
											标签
										</li>
										<li>
											<a href="#">链接1</a>
										</li>
										<li>
											<a href="#">链接2</a>
										</li>
									</ul>
								</li>
							</ul>
							<ul class="nav pull-right">
								<li>
									<a href="#">右边链接</a>
								</li>
								<li class="divider-vertical">
								</li>
								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#">下拉菜单<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li>
											<a href="#">下拉导航1</a>
										</li>
										<li>
											<a href="#">下拉导航2</a>
										</li>
										<li>
											<a href="#">其他</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">链接3</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						
					</div>
				</div>
				
			</div>
    <?
        //在本页显示隐藏的真实姓名以及包含关键字的自我介绍，真实姓名链接指向论坛的个人主页，默认隐藏所有信息
          include ("../db.php");//引用总的数据库文件
    ?>
  <div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span12">
                <form action="searchMa.php" method="get">
					<div class="input-group mb-3">
						<input name="text_for_major" type="text" class="form-control" placeholder="搜索专业或拼音查询" aria-label="Recipient's username" aria-describedby="basic-addon2">
						
							<button class="btn btn-outline-secondary" type="submit" >🔍</button>
							<!--调用模态窗口打开函数-->
							<button class="btn btn-outline-secondary" type="submit" onclick="">高级搜索</button>
						
					</div>
				</form>
				</div>
			</div>
			<table class="table">
				<thead> <!--表头-->
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
                    $major=$_GET["text_for_major"]; //获取get参数
                

                        $_t_sql=" SELECT uid,realname,other,major from bbs_user  WHERE other LIKE '%{$major}%';"; //组合参数为LIKE语句模糊查询
                        console.log($_t_sql);
                        $result=$con->query($_t_sql);//执行语句
                        if($result->num_rows!=0) //如果查询到结果
                        {
                            while($row = $result->fetch_assoc())//显示查询结果
                            {?>

                            
                                  <tbody><!--内容-->
                                    <tr>
                                        <td>
                                            <a href=" ./?user-<?echo $row['uid'];?>.htm"><?echo $row["realname"]; ?></a>
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