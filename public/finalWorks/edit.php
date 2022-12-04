<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <title>新闻管理系统</title>
    <link rel="stylesheet" type="text/css"
          href="https://jsd.czc.life/gh/seekinc/assets@master/simditor-2.3.28/site/assets/styles/simditor.css"/>

    <script type="text/javascript"
            src="https://jsd.czc.life/gh/seekinc/assets/simditor-2.3.28/site/assets/scripts/jquery.min.js"></script>
<script src="https://beacon-v2.helpscout.help/static/js/vendor.06c7227b.js"></script>
    <script type="text/javascript"
            src="https://jsd.czc.life/gh/seekinc/assets/simditor-2.3.28/site/assets/scripts/module.js"></script>
    <script type="text/javascript"
            src="https://jsd.czc.life/gh/seekinc/assets/simditor-2.3.28/site/assets/scripts/hotkeys.js"></script>
    <script type="text/javascript"
            src="https://jsd.czc.life/gh/seekinc/assets/simditor-2.3.28/site/assets/scripts/uploader.js"></script>
    <script type="text/javascript"
            src="https://jsd.czc.life/gh/seekinc/assets/simditor-2.3.28/site/assets/scripts/simditor.js"></script>

    <style>
        .simditor .simditor-body img {
            cursor: pointer;
            max-width: 100%;
            height: auto;
            /*clear: both;*/
            /*display: block;*/
            /*margin: auto;*/
        }
    </style>
</head>
<body>
<?php
require_once "menu.php";
$connection = require("conn.php");

//$connection = @mysqli_connect("43.129.243.195", "class", "Chi123..@", "class", "33307") or die("数据库连接失败!");
@mysqli_select_db($connection, dbname);

//获取要修改id号
$pID = $_GET['id'];
$var = $pID;

$sql = "select * from news where id={$pID}";
$result = mysqli_query($connection, $sql);

//判断是否获取到了要修改的信息
if ($result && mysqli_num_rows($result) > 0) {
    $news = mysqli_fetch_assoc($result);
} else {
//    die("未找到要修改的信息!");
    header('location:skip.php?url=console.php&info=未找到要修改的信息!');
}
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title" style="text-align: center">编辑新闻</h2>
    </div>
    <div class="panel-body form-inline">
    </div>
</div>
<form action="action.php?action=update" method="post">
    <input type="hidden" name="id" value="<?php echo $news['id']; ?>"/>
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr>
            <td align="right">标题:</td>
            <td><input type="text" name="title" size="100" value="<?php echo $news['title']; ?>"/></td>
        </tr>
        <tr>
            <td align="right">关键字:</td>
            <td><input type="text" name="keywords" size="100" value="<?php echo $news['keywords']; ?>"/></td>
        </tr>
        <tr>
            <td align="right">作者:</td>
            <td><input style="background-color: #e3e2e2;outline: none;border:none;" readonly="readonly" type="text"
                       name="author" size="100" value="<?php echo $news['author']; ?>"/></td>
        </tr>
        <tr>
            <td align="right" valign="top">文章分类:</td>
            <td>
                <select  id="categories" name="categories">
                    <?
                    $sql = "SELECT * FROM newscate ORDER BY id;";
                    $result = mysqli_query($connection, $sql);
                    while($row =mysqli_fetch_assoc($result)){
                        echo "<option value='{$row['category']}'>{$row['category']}</option>";
                    }
//                    mysqli_free_result($result);
//                    mysqli_close($connection);
                    ?>
                </select>
                <?
                $sql = "select * from newscate where category='{$news['category']}'";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_assoc($result);
                $sid=$row['id']-1;
                ?>
                <script>
                    document.getElementById("categories").options[<?=$sid?>].selected="selected"
                </script>
            </td>
            <!--            <td><input type="text" name="authorid" size="100"></td>-->
        </tr>
        <tr>
            <td align="right" valign="top">内容:</td>
            <td style="width: 850px;float: left">
                <textarea cols="100" rows="5" id="editor" placeholder="在这里输入内容..." name="content"
                          autofocus><?php echo $news['content']; ?></textarea></td>
            <script>
                var $pid = '<?=$var?>';
                var editor = new Simditor({
                    textarea: $('#editor'),
                    toolbar: [
                        'color',
                        'fontScale',
                        'title',
                        'alignment',
                        'image',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        'strikethrough',
                        'blockquote',
                        'hr',
                        '|',
                        'table',
                        'ol',
                        'ul',
                        'code',
                        'link',
                        // 'indent',
                        // 'outdent',
                    ],
                    upload: {
                        url: 'upload.php?id=' + <?=$pID?>,
                        params: null,
                        fileKey: $pid,
                        connectionCount: 3,
                        leaveConfirm: '正在上传文件...'
                    },
                    pasteImage: true

                });
            </script>

        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="update" value="保存内容"/>&nbsp;&nbsp;
                <input type="reset" value="重新输入"/>
            </td>
        </tr>
        </thead>
    </table>
</form>
</body>
</html>
