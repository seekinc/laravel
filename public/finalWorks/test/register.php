<html>
<head><title>用户注册</title>
    <meta name="content-type" ; charset="UTF-8">
</head>
<body>
<h1>用户注册</h1>
<form action="register.php" method="post">
    <table border="0">
        <tr>
            <td>用户名：</td>
            <td><input type="text" id="id_name" name="username" required="required"></td>
        </tr>
        <tr>
            <td>密码：</td>
            <td><input type="passwd" id="passwd" name="passwd" required="required"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" id="register" name="register" value="注册">
                <input type="reset" id="rester" name="rester" value="重置">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                如果已有账号，快去<a href="login.html" rel="external nofollow" rel="external nofollow"> 登录</a>吧！
            </td>
        </tr>
    </table>

</form>
</body>
</html>


<?php
require("conn.php");

header('Content-type:text/html;charset=utf-8');

$username = $_POST['username'];
$passwd = $_POST['passwd'];

$sql = "select username from newsusers where username = '$username'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
//判断用户名是否存在
if (!$_POST) {
    if ($username == $row['username']) {

        echo "<script>alert('用户名.$username.已经存在!请重新注册')</script>";

    } else {
        //用户名不存在 将注册的账号密码加入数据库
        $sql_insert = "insert into newsusers(username,passwd) values('$username','$passwd')";
        mysqli_query($connection, $sql_insert);
        header('refrsh:3;url=login.html');
        echo "<script>alert('$username.用户注册成功，请点击登录去登录!')</script>";
    }
}
?>

