<?php
header('Content-type:text/html; charset=utf-8');
//开启session
session_start();
$usn = $_SESSION['username'];
//先判断cookie是否有用户信息
if (isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $usn = $_SESSION['username'];
    $_SESSION['islogin'] = 1;
    #print_r($_SESSION);
}
if (isset($_SESSION['islogin'])) {

} else {
    //如果没有登录
    header('location:skip.php?url=login.html&info=您还未登录，即将跳转至登录页面！');
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<center>
    <h2>新闻管理系统</h2>
    <a href=".">网站首页</a>
    <a href="console.php">控制台主页</a>
    <a href="add.php">发布新闻</a>
    <a href="category.php">新闻分类</a>
    <a href="UserManage.php">用户管理</a>
    <a href="logout.php">注销登录&nbsp(<? echo $usn ?>)</a>
    <hr width="80%">
</center>
</body>
</html>
