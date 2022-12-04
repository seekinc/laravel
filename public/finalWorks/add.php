<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
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
    <title>新闻管理系统</title>

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
<?php
//获取要修改id号
$connection=require("conn.php");

//$connection = @mysqli_connect("43.129.243.195", "class", "Chi123..@", "class", "33307") or die("数据库连接失败!");
@mysqli_select_db($connection, dbname);
$sql = "SELECT id FROM news ORDER BY id DESC LIMIT 1;";
$result = mysqli_query($connection, $sql);
$news = mysqli_fetch_assoc($result);
$pID =(int)$news['id']+1;
$var =(string)$pID;

?>
<body>
<?php include ("menu.php");
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title" style="text-align: center">发布新闻</h2>
    </div>
    <div class="panel-body form-inline">
    </div>
</div>
<div class="container">
    <form action="action.php?action=add" method="post">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td >标题:</td>
                <td><input type="text" name="title" size="100"></td>
            </tr>
            <tr>
                <td>关键字:</td>
                <td><input type="text" name="keywords" size="100"></td>
            </tr>
            <tr>
                <td >作者:</td>
                <td><input style="background-color: #e3e2e2;outline: none;border:none;" readonly="readonly" type="text" name="author" size="100" value="<?php echo $usn; ?>"></td>

            </tr>
            <tr>
                <td >分类:</td>
                <td>
                    <select name="categories">
                        <?
                        $sql = "SELECT * FROM newscate ORDER BY id;";
                        $result = mysqli_query($connection, $sql);
                        while($row =mysqli_fetch_assoc($result)){
                            echo "<option value='{$row['category']}'>{$row['category']}</option>";
                        }
                        mysqli_free_result($result);
                        mysqli_close($connection);
                        ?>
                    </select>
                </td>
<!--                <td><input type="text" name="category" size="100"></td>-->
            </tr>
<!--            <tr>-->
<!--                <td >权限:</td>-->
<!--                <td><input style="background-color: #e3e2e2;outline: none;border:none;" readonly="readonly" type="text" name="permission" size="100"></td>-->
<!--            </tr>-->
            <tr>
                <td >内容:</td>
                <td style="width: 850px;float: left">
                <textarea cols="100" rows="5" id="editor" placeholder="在这里输入内容..." name="content"
                          autofocus></textarea></td>
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
                            url: 'upload.php?id='+<?=$pID?>,
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
                <td align="center" colspan="2">
                    <input type="submit" name="add" value="添加">&nbsp;&nbsp;
                    <input type="reset" value="重置">
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
