<?php
//
////退出登录并跳转到登录页面
//
//unset($_SESSION['username']);
//
//setcookie("username","",time()-1);  //清空cookie
//
//setcookie("password","",time()-1);
//
//header("location: login.html ");

header('Content-type:text/html; charset=utf-8');
//开启session
session_start();
$usn=$_SESSION['username'];

//先判断cookie是否有用户信息
if(isset($_COOKIE['username'])){
    $_SESSION['username'] = $_COOKIE['username'];
    $usn=$_SESSION['username'];
    $_SESSION['islogin'] = 1;
    #print_r($_SESSION);
}else{
    header('location:skip.php?url=login.html&info=您还未登录，三秒后跳转到登陆页面！');
}
//清楚session
$username = $_SESSION['username']; //用于后面的提示信息
$_SESSION = array();
session_destroy();

//清除cookie
setcookie('username', '', time() - 99);
setcookie('code', '', time() - 99);

//提示信息
header('location:skip.php?url=login.html&info='."$usn".'，注销成功！期待您下次登陆');

echo "期待下次登录," . $username . '<br>';
echo "<a href='login.html'>重新登录</a>";
