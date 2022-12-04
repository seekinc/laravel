<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <title>用户管理</title>
    <script>
        function dodel(id){
            if (confirm("确定要删除吗")){
                window.location="action.php?action=del&id="+id;
            }
        }
    </script>
    <style>
        li{
            list-style-type: none;
        }
    </style>
</head>
<body>
<center>
    <h1 style="margin: 50px 0 50px 0">用户管理</h1>
    <div class="panel panel-primary">
        <div class="panel-body form-inline">
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped" style="width: 65%">
        <thead>
        <tr>
            <th>用户ID</th>
            <th>用户名</th>
            <th>用户组</th>
            <th>文章数量</th>
            <th>账号状态</th>
        </tr>
        </thead>
        <?php
        require("database.php");
        $connection=@mysqli_connect("43.129.243.195","class","Chi123..@","class","33307") or die("数据库连接失败!");
        @mysqli_select_db($connection,dbname);

        //执行查询并返回结果集
        $sql="select * from newsusers order by userid asc";
        $result=mysqli_query($connection,$sql);
        $sql="select * from newsusers order by userid asc";
        $articleNum=mysqli_query($connection,$sql);
        //解析结果集 并遍历
        while($row =mysqli_fetch_assoc($result)){
            echo "<tr>";

            echo "<td>{$row['userid']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['identity']}</td>";
            echo "<td>{$row['identity']}</td>";
            echo "<td>{$row['userStatus']}</td>";
//            echo "<td>{$row['content']}</td>";
            echo"</ul>";

        }
        //释放结果集
        mysqli_free_result($result);
        mysqli_close($connection);

        ?>
    </table>
    <input type="submit" style="width: 200px;height: 50px;margin: 50px 0 150px 0">
</center>
</body>
</html>
