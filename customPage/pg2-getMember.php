<?php
function coverMajor($major) {
    $str = "";
    if ($major == "1") $str = "哲学";
    elseif ($major == "2") $str = "经济学";

    elseif ($major == "4") $str = "历史学";
    elseif ($major == "5") $str = "法学";
    elseif ($major == "6") $str = "马克思主义理论";
    elseif ($major == "7") $str = "社会学";
    elseif ($major == "8") $str = "政治学";
    elseif ($major == "9") $str = "公安学";
    elseif ($major == "10") $str = "教育学";
    elseif ($major == "11") $str = "体育学";
    elseif ($major == "12") $str = "职业技术教育";
    elseif ($major == "13") $str = "新闻传播学";
    elseif ($major == "14") $str = "中国语言文学";
    elseif ($major == "15") $str = "外国语言文学";
    elseif ($major == "16") $str = "艺术";
    elseif ($major == "17") $str = "数学";
    elseif ($major == "18") $str = "物理学";
    elseif ($major == "19") $str = "化学";
    elseif ($major == "20") $str = "生物科学";
    elseif ($major == "21") $str = "天文学";
    elseif ($major == "22") $str = "地理科学";
    elseif ($major == "23") $str = "地球物理学";
    elseif ($major == "24") $str = "大气科学";
    elseif ($major == "25") $str = "海洋科学";
    elseif ($major == "26") $str = "力学";
    elseif ($major == "27") $str = "农业工程";
    elseif ($major == "28") $str = "环境科学";
    elseif ($major == "29") $str = "心理学";
    elseif ($major == "30") $str = "统计学";
    elseif ($major == "31") $str = "系统科学";
    elseif ($major == "32") $str = "地矿";
    elseif ($major == "33") $str = "机械";
    elseif ($major == "34") $str = "仪器仪表";
    elseif ($major == "35") $str = "能源动力";
    elseif ($major == "36") $str = "电气信息";
    elseif ($major == "37") $str = "土建";
    elseif ($major == "38") $str = "测绘";
    elseif ($major == "39") $str = "环境与安全";
    elseif ($major == "40") $str = "化工与制药";
    elseif ($major == "41") $str = "交通运输";
    elseif ($major == "42") $str = "海洋工程";
    elseif ($major == "43") $str = "航空航天";
    elseif ($major == "44") $str = "武器";
    elseif ($major == "45") $str = "工程力学";
    elseif ($major == "46") $str = "生物工程";
    elseif ($major == "47") $str = "公安技术";
    elseif ($major == "48") $str = "材料科学";
    elseif ($major == "49") $str = "材料";
    elseif ($major == "50") $str = "水利";
    elseif ($major == "51") $str = "林业工程";
    elseif ($major == "52") $str = "轻工纺织食品";
    elseif ($major == "53") $str = "电子信息科学";
    elseif ($major == "54") $str = "植物生产";
    elseif ($major == "55") $str = "草业科学";
    elseif ($major == "56") $str = "森林资源";
    elseif ($major == "57") $str = "环境生态";
    elseif ($major == "58") $str = "动物生产";
    elseif ($major == "59") $str = "动物医学";
    elseif ($major == "60") $str = "水产";
    elseif ($major == "61") $str = "基础医学";
    elseif ($major == "62") $str = "预防医学";
    elseif ($major == "63") $str = "药学";
    elseif ($major == "64") $str = "口腔医学";
    elseif ($major == "65") $str = "中医学";
    elseif ($major == "66") $str = "法医学";
    elseif ($major == "67") $str = "护理学";
    elseif ($major == "68") $str = "临床医学与医学技术";
    elseif ($major == "69") $str = "工商管理";
    elseif ($major == "70") $str = "管理科学与工程";
    elseif ($major == "71") $str = "公共管理";
    elseif ($major == "72") $str = "农业经济管理";
    elseif ($major == "73") $str = "图书档案学";

    return $str;
}
include ("../../db.php");
//引用总的数据库文件
$con = new mysqli($host,$name,$pwd,$db);
if ($con->connect_error) {
    die('Could not connect: ' . mysql_error());
}
$major = $_POST['major'];
$school_a = $_POST['school'];
$province = $_POST['province'];

$_t_sql_1 = " SELECT t1.uid,realname,other,school,major,email
						FROM `bbs_user` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(uid) FROM `bbs_user`)-(SELECT MIN(uid) FROM `bbs_user`))+(SELECT MIN(uid) FROM `bbs_user`)) AS uid) AS t2
						WHERE t1.uid >= t2.uid ";

$_t_sql_11 = "SELECT t1.uid,realname,other,school,major,email
						FROM `bbs_user` AS t1
						WHERE t1.uid ";
$_t_sql_2 = "ORDER BY t1.uid LIMIT 10";
$_tadd = "";
if (!strcmp($major,"0") && (!strcmp($province,"所有")) && is_null($school_a)) {//第一次打开，就显示全部随机的队友
    $_tadd = "";
} else
{
    if (!strcmp($major,"0")) {
        //如果没有指定专业
        // $_tadd=$_tadd." AND t1.major={$major} ";
    } else {
        //指定专业以后
        $pm = (int)$major;
        $_tadd = $_tadd." AND t1.major={$pm} ";
    }
    if (strcmp($province,"所有")) {
        //如果不是所有省
        $_tadd = $_tadd." AND t1.province='{$province}' ";
    }
    if (!strcmp($school_a,$province)) {
        //如果学校为所有学校

    } else {
        $_tadd = $_tadd." AND t1.school='{$school_a}' ";
    }
    
}
$_t_sql = $_t_sql_1.$_tadd.$_t_sql_2;
//echo($_t_sql);
$arr = array();
//组合参数为LIKE语句模糊查询
// 设置编码，防止中文乱码
$con->query("set names utf8");
$result = $con->query($_t_sql);
//执行语句
if ($result->num_rows != 0) {
    //如果查询到结果
    while ($row = $result->fetch_assoc()) {
        //显示查询结果
        $count = count($row);
        //print_r($row);
        $row['major'] = coverMajor($row['major']);

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