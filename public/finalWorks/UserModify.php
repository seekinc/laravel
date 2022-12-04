<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>修改分类名称</title>
    <style>
        h2 {
            text-align: center
        }
        form {
            width: 350px;
            margin: 10px auto;
            background: rgba(248, 248, 248, 0.64);
            padding: 20px;
            border-radius: 8px;
            padding-left: 130px;
        }
        tr {
            height: 30px;
            line-height: 30px;
        }
        input[type='text'], input[type='date'], select {
            height: 25px;
            line-height: 25px;
            width: 150px;
        }
        .btn {
            padding: 8px 20px;
            background-color: #2795F7;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .list{
            box-shadow: rgb(203, 203, 203) 0px 0px 2px;
            border-radius: 15px;
            background: rgba(84, 156, 208, 0.13);
            height: 320px;
            width: 600px;
            position: absolute;
            top: 0;
            bottom: 25%;
            left: 0;
            right: 0;
            margin: auto;
        }
    </style>
</head>
<body>
<?php
header("Content-type:text/html;charset=UTF-8");
$id = $_GET["id"];
//echo $id;
if (!empty($_POST)) {
//更新数据
    //获取用户数据
    $data = $_POST;
//注意set后面有一个空格
    $sql = "update newsusers set ";
//遍历$data，实现自动拼接
    foreach ($data as $k => $v) {
        $sql .= "$k='$v',";
    }
//去除最右侧多余的逗号
    $sql = rtrim($sql, ",");
    $sql .= " where id=$id";
    $link = require_once "conn.php";
//    echo $sql;
    $res = mysqli_query($link, $sql);
    if ($res) {
        echo "<script>alert('数据修改成功！');top.location.href ='UserManage.php'</script>
<script src="https://beacon-v2.helpscout.help/static/js/vendor.06c7227b.js"></script>";
    } else {
        echo "<script>alert('数据修改失败！')</script>";
    }
} else {
//没有提交表单，加载表单页面并显示原始数据信息
    $id = $_GET["id"];
    $sql = "select * from newsusers where id=$id";
    $link = require_once "conn.php";
    $res = mysqli_query($link, $sql);
    $data = mysqli_fetch_assoc($res);
}

?>
<div class="list">
<h2>修改分类名称</h2>
<form action="" method="post">
    <table>
        <tr>
            <td style="border: 0">用户名：</td>
            <td style="border: 0"><input type="text" name="username" value="<?=$data['username']?>"></td>
        </tr>
        <tr>
            <td style="border: 0">密码：</td>
            <td style="border: 0"><input type="text" name="passwd" value="<?=$data['passwd']?>"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="立即提交" class="btn"/>
                <input type="reset" value="重新填写" class="btn"/>
            </td>
        </tr>
    </table>
</form>
</div>

</body>
</html>



