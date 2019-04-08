
<html>
<head>
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

<!--头部结束-->
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<hr>
			<h4>
				队伍创建，寻找志同道合的队友
			</h4>
			<div class="row clearfix">
				<div class="col-md-12 column">
					<form role="form" action="create_b.php" method="post">
						<div class="form-group">
							<label for="exampleInputEmail1">队伍名称</label><input class="form-control" name="name" />
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">队伍描述【例如队伍方向，目前资源状况等】</label><hr><textarea name="desc"></textarea>
						</div>
						
						<button type="submit" class="btn btn-default">确定创建</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
