<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>学生党员信息</title>
    <link rel="stylesheet" href="https://www.layuicdn.com/layui-v2.6.8/css/layui.css">
    <style>
        /*此处省去body、h2、table、th、th, td属性*/
        body {
            padding: 0 10%;
        }
        h2 {
            text-align: center;
            font-size: 40px;
        }
        table {
            border-collapse: collapse;
            font-size: 16px;
        }
        th {
            background-color: #DADBDC
        }
        th, td {
            border: 1px solid #000000;
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
            margin-top: 10px;
            color: #007DDB;
        }
    </style>
</head>
<body>
<h2 style="margin-top: 3.5%">学生党员信息</h2>
<form style="align-self: center;background:#FFFFFF" action="" method="get">
    <input type="text" name="keyWord" placeholder="请输入查询关键字" value="<?=isset($keyWord)?$keyWord:''?>">
    <input type="submit" value="搜索">
</form>
<table width="100%">
    <tr>
        <th>学号</th>
        <th>姓名</th>
        <th>性别</th>
        <th>班级</th>
        <th>入党时间</th>
        <th colspan="2">操作</th>
    </tr>
    <?php
    //新增对搜索结果是否为空的判断
    if (empty($dataArr))
    {
        echo "<tr>
    <td colspan='5'>没有查询到对应记录！</td>
    </tr>";
    }
    else{
        //遍历输出数据数组
        foreach($dataArr as $row){
            ?>
            <tr>
                <td><?=$row["mebID"]?></td>
                <td><?=$row["mebName"]?></td>
                <td><?=$row["mebClass"]?></td>
                <td><?=$row["mebAddDate"]?></td>
                <!--        <td><a href="modify.php?id=<?=$row['id']?>">修改</a></td>-->
                <td><a onclick="modify()">修改</a></td>
                <script>
                    function modify(){
                        layer.open({
                            type: 1,
                            skin: 'layui-layer-rim', //加上边框
                            area: ['550px', '420px'], //宽高
                            content: '<iframe src="./include/modify_in.php?id=<?=$row['id']?>" width="550px" height="355px" ' +
                                'overflow:hidden; frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowTransparency="true" > </iframe>',
                        });
                    }
                </script>
                <td><a href="include/delete.php?id=<?=$row['id']?>" onclick="return confirm('删除后将无法恢复，是否确定删除？')">删除</a></td>
            </tr>

            <!--与foreach循环的左大括号和判断数组是否为空的左大括号配对-->
        <?php } }?>
</table>

</body>
</html>