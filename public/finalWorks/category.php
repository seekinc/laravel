<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.layuicdn.com/layui-v2.6.8/css/layui.css">
    <script type="text/javascript" src="https://www.layuicdn.com/layui-v2.6.8/layui.js"/>
    <title>新闻管理系统</title>
    <script>
        layui.use('element', function(){
            var element = layui.element;
        });
    </script>
<script src="https://beacon-v2.helpscout.help/static/js/vendor.06c7227b.js"></script>
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



    <style>

    </style>
</head>
<body>
<center>
    <?php include ("menu.php");?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 style="padding-bottom: 25px">分类管理</h2>
        </div>
        <div class="panel-body form-inline">
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped" style="width: 50%">
        <thead>
        <tr>
            <th style="width: 35%">分类名称</th>
            <th style="width: 35%">分类别名</th>
            <th style="text-align: center">操作</th>
        </tr>
        </thead>
        <?php
        $link=require("conn.php");
        $connection=require("conn.php");

        $connection=@mysqli_connect("43.129.243.195","class","Chi123..@","class","33307") or die("数据库连接失败!");
        @mysqli_select_db($connection,dbname);

        //执行查询并返回结果集
        $sql="select * from newscate order by id";
        $result=mysqli_query($connection,$sql);

        //解析结果集 并遍历
        while($row =mysqli_fetch_assoc($result)){

            echo "<tr>";
            echo "<td>{$row['category']}</td>";
            echo "<td>{$row['categoryName']}</td>";
            echo "<td style='text-align: center'><a href='categoryModify.php?id={$row['id']}'>修改</a>&nbsp;&nbsp;| &nbsp;&nbsp;<a href='javascript:dodel({$row['id']})'>删除</a></td>";
            echo"</tr>";
            $cid = $row['id'];
        }

        //释放结果集
        mysqli_free_result($result);
        mysqli_close($connection);

        ?>
        <script>
            function catemodify(){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['600px', '600px'], //宽高
                    content: '<iframe src="categoryModify.php?id=<?=$cid?>" width="550px" height="355px" ' +
                        'overflow:hidden; frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowTransparency="true" > </iframe>',
                });
            }

            function dodel(id){
                if (confirm("确定要删除吗")){
                    window.location="action.php?action=catedel&cid="+id;
                }
            }
        </script>
    </table>
    <div class="layui-collapse"  style="margin-top: 10px;margin-bottom: 100px;width: 50%" lay-filter="test">
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">点击添加</h2>
            <div class="layui-colla-content">
                <?php
                if (!empty($_POST)) {
//获取用户数据
//                    $data2 = $_POST;
////注意set后面有一个空格
////                    $sql = "insert into newscate set ";
//                    $sql2 = "insert into `newscate` (`category`) VALUES ('4'); ";
//// insert into 表名称 set 字段1=值1,字段2=值2......
////遍历$data，实现自动拼接
////                    foreach ($data2 as $k => $v) {
////                        $sql .= "$k='$v',";
////                    }
////                    //去除最右侧多余的逗号
////                    $sql = rtrim($sql, ",");
//                    $res = mysqli_query($link, $sql2);

                    $data = $_POST;
//注意set后面有一个空格
                    $sql = "insert into newscate set ";
// insert into 表名称 set 字段1=值1,字段2=值2......
//遍历$data，实现自动拼接
                    foreach ($data as $k => $v) {
                        $sql .= "$k='$v',";
                    }
//去除最右侧多余的逗号
                    $sql = rtrim($sql, ",");
//                    $link = require_once "conn.php";
                    $res = mysqli_query($link, $sql);

                    echo $sql;
                    if ($res) {
                        echo "<script>alert('数据添加成功！');top.location.href='category.php'</script>";
                    } else {
                        echo "<script>alert('数据添加失败！')</script>";

                    }
                } else {
                    //没有提交表单，加载表单页面

                    require_once "categoryAdd.html";
                }
                ?>
            </div>
        </div>
    </div>
</center>

</body>
</html>
