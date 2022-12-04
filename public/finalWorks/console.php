

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <title>新闻管理系统</title>
    <script>
        function dodel(id){
            if (confirm("确定要删除吗")){
                window.location="action.php?action=del&id="+id;
            }
        }
    </script>
<script src="https://beacon-v2.helpscout.help/static/js/vendor.06c7227b.js"></script>
    <style>

    </style>
</head>
<body>
<center>
    <?php include ("menu.php");?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title">浏览新闻</h2>
        </div>
        <div class="panel-body form-inline">
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped" style="width: 65%">
        <thead>
        <tr>
            <th>新闻id</th>
            <th>新闻标题</th>
            <th>新闻分类</th>
            <th>关键字</th>
            <th>作者</th>
            <th>发布时间</th>
<!--            <th>新闻内容</th>-->
            <th >操作</th>
        </tr>
        </thead>
        <?php
        $connection=require("conn.php");
//        $connection=@mysqli_connect("43.129.243.195","class","Chi123..@","class","33307") or die("数据库连接失败!");
        @mysqli_select_db($connection,dbname);

        //执行查询并返回结果集
        $sql="select * from news order by uptime desc";
        $result=mysqli_query($connection,$sql);

        //解析结果集 并遍历
        while($row =mysqli_fetch_assoc($result)){

            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['category']}</td>";
            echo "<td>{$row['keywords']}</td>";
            echo "<td>{$row['author']}</td>";
            echo "<td>".date("Y-m-d",$row['uptime'])."</td>";
//            echo "<td>{$row['content']}</td>";
            echo "<td><a href='detail.php?id={$row['id']}'>预览</a>&nbsp;/&nbsp;<a href='edit.php?id={$row['id']}'>修改</a>&nbsp;/&nbsp;<a href='javascript:dodel({$row['id']})'>删除</a></td>";
            echo"</tr>";
        }

        //释放结果集
        mysqli_free_result($result);
        mysqli_close($connection);

        ?>
    </table>
</center>
</body>
</html>
