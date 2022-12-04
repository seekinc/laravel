<?php

require("../conn.php");

header('Content-Type:text/html;charset=utf-8');
//开启session()
session_start();

//处理用户登录信息
if(isset($_POST['login'])){
//接收用户的登录信息
    $username=$_POST['username'];
    $passwd = $_POST['passwd'];

//判断提交的登录信息
    if(($username == '') || ($passwd == '')){
        //若为空则视为未填写返回login.html页面
        header('refresh:3;url=login.html');
        echo "用户名或密码不能为空，3秒后将返回登录页面，请重新输入!";
        exit;
    }else{
        //若不为空则判断和账号密码是否存在于数据库中
        $sql = "select username,passwd from newsusers where username = '$username'"; //构造查询账号密码语句
        $result = mysqli_query($connection,$sql); //查询字符串
        $row = mysqli_fetch_assoc($result);  //从结果中取一行为关联数组
        if(($username != $row['username']) || ($passwd != $row['passwd'])){
            //账号密码错误的情况下 同样和空处理一样
            header('refresh:3;url=login.html');
            echo "用户名或密码错误，3庙后将放回登录页面，请重新输入!";
            exit;
        }elseif($passwd==$row['passwd']){
            #用户名和密码都正确，将用户名和密码信息存到Session中
            $_SESSION['username'] = $username;
            $_SESSION['islogin'] = 1;

            echo "登录成功!三秒后跳转到后台管理页面";

            if($_POST['remember'] == "yes"){
                #如果勾选七天内自动登录 将其保存到cookie中 并设置保存7天
                setcookie('username',$username,time()+7*24*60*60);
                setcookie('code',md5($username.md5($passwd)),time()+7*24*60*60);
                #print_r($_COOKIE);
            }else{
                #没有勾选删除cookie
//                setcookie('username','',time()-999999);
////                setcookie('code','',time()-999999);
                setcookie('username',$username,time()+60*60);
                setcookie('code',md5($username.md5($passwd)),time()+60*60);
            }
            header('refresh:3;url=../console.php');
        }
    }

}
?>

