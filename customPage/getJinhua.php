<?php
include ("../../db.php");
//引用总的数据库文件
$con = new mysqli($host,$name,$pwd,$db);
if ($con->connect_error) {
    die('Could not connect: ' . mysql_error());
}
$con->query("set names utf8");
$result = $con->query("SELECT likes,tid,subject,views FROM `bbs_thread` WHERE digest!=0");
$arr=array();
//执行语句
if ($result->num_rows != 0) {
    //如果查询到结果
    while ($row = $result->fetch_assoc()) {
        //显示查询结果
        $count = count($row);
        //print_r($row);
        $row['uri']="http://whrhost.tk/whr/bbs/?thread-".$row['tid'].".htm";
        //不能在循环语句中，由于每次删除 row数组长度都减小
        for ($i = 0;$i < $count;$i++) {
            unset($row[$i]);
            //删除冗余数据
        }

        array_push($arr,$row);

    }
}
mysqli_close($con);
echo json_encode($arr,JSON_UNESCAPED_UNICODE);