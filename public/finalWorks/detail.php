<?
header('Content-type:text/html; charset=utf-8');
//开启session
session_start();

//先判断cookie是否有用户信息
if (isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $usn = $_SESSION['username'];
    $_SESSION['islogin'] = 1;
    #print_r($_SESSION);
}
if (isset($_SESSION['islogin'])) {

}else{
    ?>
    <script>
        var h = document.getElementsByName("edit-a")[0];
        h.getAttributeNode("style").value = "visibility: hidden;
    </script>
<script src="https://beacon-v2.helpscout.help/static/js/vendor.06c7227b.js"></script>
    <?php
}

////
$pID = $_GET['id'];
$connection=require("conn.php");

//$connection = @mysqli_connect("43.129.243.195", "class", "Chi123..@", "class", "33307") or die("数据库连接失败!");
@mysqli_select_db($connection, dbname);

//执行查询并返回结果集
$sql = "select * from news where id={$pID}";
$result = mysqli_query($connection, $sql);

//解析结果集 并遍历
//        while($row =mysqli_fetch_assoc($result)){
$row = mysqli_fetch_assoc($result);
$uptime = date("Y-m-d", $row['uptime']);// H:i
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://jsd.czc.life/gh/seekinc/assets@master/simditor-2.3.28/site/assets/styles/simditor.css"/>

    <script type="text/javascript"
            src="https://jsd.czc.life/gh/seekinc/assets/simditor-2.3.28/site/assets/scripts/jquery.min.js"></script>
    <title>新闻管理系统</title>
    <style>

        body {
            background: rgba(85, 136, 170, 0.5);
            background-image: repeating-linear-gradient(30deg, hsla(0, 0%, 100%, .1), hsla(0, 0%, 100%, .1) 15px, transparent 0, transparent 30px);
            background-attachment: fixed;

            /*background-color: #1e1e1e;*/
        }

        .backgroundth {
            box-shadow: rgb(98, 98, 98) 0px 0px 10px, rgb(54, 52, 52) 0px 0px 3px;
            height: auto;
            /*margin-top: 100px';*/
            align = 'center';
            border-radius: 0 0 40px 40px;
            background: rgba(243, 243, 243, 0.6);
        }

        .backgrounded {
            box-shadow: rgb(98, 98, 98) 0px 0px 5px, rgb(54, 52, 52) 0px 0px 0px;
            height: auto;
            margin-top: 100px ';
            align = 'center';
            border-radius: 50px 50px 40px 40px;
            background: rgba(243, 243, 243, 0.6);
        }

        .background {
            box-shadow: rgb(98, 98, 98) 0px 0px 1px, rgb(54, 52, 52) 0px 0px 1px;
            height: auto;
            margin-top: 100px ';
            align = 'center';
            border-radius: 30px 30px 40px 40px;
            background: rgba(243, 243, 243, 0.75);
        }

        .content {
            /*line-height:20px;*/
            width: 70%;
            /*text-indent: 2px;*/
            margin-top: 50px;
            margin-bottom: 50px;
            margin-left: auto;
            margin-right: auto;
        }

        body {
            padding: 0 25%;
            line-height: 1.55em;
        }

        table {
            border-collapse: collapse;
            /*font-size: 16px;*/
        }

        th {
            background-color: #DADBDC
        }

        th, td {
            /*border: 1px solid #000000;*/
            height: 35px;
            text-align: center
        }

        input[type='text'] {
            height: 25px;
            line-height: 25px;
            width: 150px;
        }

        input[type='submit'] {
            padding: 6px 20px;
            background-color: #2795F7;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        a {
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
            /*margin-top: 10px;*/
            color: #007DDB;
        }

        img {
            cursor: pointer;
            max-width: 90%;
            height: auto;
            /*clear: both;*/
            /*display: block;*/
            /*margin: auto;*/
        }

        p {
            margin-top: 20px;
        }

        li {
            display: inline;
        }

        .titles {
            text-shadow: 0.08em 0.025em 0.1em #5e5e5e;
            border-radius: 30px;
            padding: 195px 0 50px 0;
            /*margin-top: 75px;*/
            text-align: center;
            font-size: 40px;
        }

        .artical-info {
            padding-top: 10px;
            margin-top: 50px;
            margin-left: 10px;
            text-align: center;
            font-size: 1.1em;
            font-weight: normal;
            text-shadow: 0.04em 0.015em 0.1em #a6a6a6;
        }
    </style>

    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: block;

            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: #111;
        }

        .active {
            background-color: #4CAF50;
        }

    </style>
</head>
<body>
<!--<center>-->
<div class="backgroundth" style="padding: 0;">
    <ul style="position:fixed;width: 50.05%">
        <li><a href="index.php">&nbsp&nbsp首页&nbsp&nbsp</a></li>
        <li><a href="#news">重要公告</a></li>
        <li><a href="#contact">活动通知</a></li>
        <li><a href="#contact">学术动态</a></li>
        <li><a href="#contact">校园播报</a></li>
        <li style="float:right;padding: 0"><a class="active" href="console.php">&nbsp;&nbsp;控制台&nbsp;&nbsp;</a></li>
        <!--        <li style="float:right;"><a class="active" href="#about">注册</a></li>-->
    </ul>
    <div>
        <div>
            <!--            <li>首页</li>-->
            <!--            <li>重要公告</li>-->
            <!--            <li>活动通知</li>-->
            <!--            <li>学术动态</li>-->
            <!--            <li>校园播报</li>-->
            <!--            <ol>-->
            <!--                <li>当前位置：首页 >> 校园播报 >> 正文</li>-->
            <!--            </ol>-->

            <? echo "<h2 class='titles'>{$row['title']}</h2><br>" ?>
        </div>
        <div class="panel-body form-inline">
        </div>
    </div>
    <thead>
    <tr>
        <!--            <th>新闻id</th>-->
        <!--            <th>新闻标题</th>-->
        <!--            <th>关键字</th>-->
        <!--            <th>作者</th>-->
        <!--            <th>发布时间</th>-->
        <!--            <th>新闻内容</th>-->
        <!--            <th>操作</th>-->
    </tr>
    </thead>
    <?php

    //            echo "<div>";
    //            echo "<td>{$row['id']}</td>";
    //            echo "<td>{$row['title']}</td>";
    //            echo "<td>{$row['keywords']}</td>";
    //            echo "<td>{$row['author']}</td>";
    //            echo "<td>".date("Y-m-d",$row['uptime'])."</td>";
    //            echo "<td><a href='javascript:dodel({$row['id']})'>删除</a>/<a href='edit.php?id={$row['id']}'>修改</a></td>";

    //            echo"</div>";


    //        }

    //释放结果集
    //        mysqli_free_result($result);
    //        mysqli_close($connection);

    echo "<div class='backgrounded'>";
    echo "<p class='artical-info' '>发布时间：$uptime&nbsp&nbsp&nbsp&nbsp作者：{$row['author']}</p>";
    echo "<div class='background' style='margin-top: -5px'>";
    echo "<br><br>";
    echo "<div class='content' style='letter-spacing: 1px;line-height:27px' >{$row['content']}";
    echo "<a style='margin-top: 50px;float: right;' href='edit.php?id={$row['id']}' name='edit-a'>修改内容</a>";
    echo "</div>";
    echo "<br><br><br><br></div>";
    echo "</div>"
    ?>
</div>
<br><br><br><br>
<!--</center>-->

</body>
</html>
