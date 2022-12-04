<meta charset="UTF-8">
<?php
$link=require("conn.php");

//连接mysql,并选择数据库
$link=@mysqli_connect("hk.xero.run","class","Chi123..@","class","33307") or die("数据库连接失败!");
//@mysqli_select_db($link,dbname);

switch ($_GET['action']){

    case "add"://执行添加操作
        //获取要添加的信息并补充其他信息

        $title=$_POST["title"];
        $keywords=$_POST["keywords"];
        $author=$_POST["author"];
        $content=$_POST["content"];
        $uptime=time();
        $authorid=$_POST["authorid"];
        $categories=$_POST['categories'];

        $sql="insert into news values (null,'{$title}','{$keywords}','{$author}','{$uptime}','{$categories}','{$content}')";
        @mysqli_query($link,$sql);

        //判断是否成功
        $id=mysqli_insert_id($link);//获取刚刚添加信息的自增id值
        if($id>0){
            echo "新闻信息添加成功!";
        }else{
            echo "新闻信息添加失败!";
        }
        ?>
        <script>alert('文章发布成功！');top.location.href ='console.php'</script>
<script src="https://beacon-v2.helpscout.help/static/js/vendor.06c7227b.js"></script>
        <?
//        echo "<a href='javascript:window.history.back();'>返回</a>&nbsp;&nbsp;";
        echo "<a href='console.php'>浏览新闻</a>";
        break;
    case "del"://执行删除操作
        $id=$_GET['id']; //获取亚删除的id号
        $sql="delete from news where id={$id}";
        mysqli_query($link,$sql);//执行删除操作

        //自动跳转到浏览新闻页面
        header("Location:console.php");
        break;
    case "update":
        $title=$_POST['title'];
        $keywords=$_POST['keywords'];
        $author=$_POST['author'];
        $content=$_POST['content'];
        $id=$_POST['id'];
        $categories=$_POST['categories'];
        $sql="update news set title='{$title}',keywords='{$keywords}',author='{$author}',content='{$content}',category='{$categories}' where id={$id}";?>
        <script>alert('文章修改成功！');top.location.href ='console.php'</script>
        <? mysqli_query($link,$sql);

//        header("Location:console.php");//跳回浏览界面
        break;
    case "catedel" :
        $cid=$_GET['cid']; //获取亚删除的id号
        $sql="delete from newscate where id={$cid}";
        mysqli_query($link,$sql);//执行删除操作
        $sql="SET @i=0";//对id重新排序
        mysqli_query($link,$sql);//执行删除操作
        $sql="UPDATE `newscate` SET `id`=(@i:=@i+1)";
        mysqli_query($link,$sql);//执行删除操作
        $sql="ALTER TABLE `newscate` AUTO_INCREMENT=0";
        mysqli_query($link,$sql);//执行删除操作
//        SET @i=0;
//UPDATE `newscate` SET `id`=(@i:=@i+1);
//ALTER TABLE `newscate` AUTO_INCREMENT=0;
        //自动跳转到浏览新闻页面
        header("Location:category.php");
        break;

    case "userdel" :
        $cid=$_GET['cid']; //获取亚删除的id号
        $sql="delete from newsusers where id={$cid}";
        mysqli_query($link,$sql);//执行删除操作
        $sql="SET @i=0";//对id重新排序
        mysqli_query($link,$sql);//执行删除操作
        $sql="UPDATE `newsusers` SET `id`=(@i:=@i+1)";
        mysqli_query($link,$sql);//执行删除操作
        $sql="ALTER TABLE `newsusers` AUTO_INCREMENT=0";
        mysqli_query($link,$sql);//执行删除操作
        header("Location:category.php");
        break;
}

//关闭数据库连接
mysqli_close($link);

