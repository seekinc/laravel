<!-- 导入背景php文件 -->

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        .inner .uptime .ann_panel i {
            display: inline-block;
            margin: 5px 100px 0px 200px;
            font-style: normal;
            font-size: 20px;
        }

        .inner .uptime .ann_panel .more .show_notice {
            width: 88%;
            margin: 10px auto;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .inner .uptime .ann_panel .more .show_notice tr .item {
            text-align: left;
            width: 20px;
            height: 50px;
            padding: 5px;
            overflow: hidden;
            border: 0.5px solid #000000;
        }

        .inner .uptime .ann_panel .tip {
            margin: 0px 0px 0px 50px;
            position: absolute;
            left: 290px;
            bottom: 30px;
        }

        .inner .uptime .ann_panel .tip tr td {
            padding: 0px 240px 0px 0px;
        }

        .ul-list {
            box-shadow: rgb(192, 192, 192) 0px 0px 2px, rgb(54, 52, 52) 0px 0px 0px;
            border-radius: 15px;
            list-style-type: none;
            width: 90%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            padding: 10px;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.22);
        }

        .a-list {
            font-size: 1.2em;
            display: block;
            color: #000000;
            text-align: left;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul li a:hover:not(.active) {
            background-color: rgba(178, 176, 176, 0.23);
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="inner">
    <!--内容面板 -->
    <div class="uptime">
        <!-- 左上角菜单 -->
        <!-- 右边公告详情面板 -->
        <div class="ann_panel">
            <?php
            function printfStr($str)
            {
                if (mb_strlen($str) > 100) {
                    return mb_substr($str, 1, 100) . "......";
                } else {
                    return $str;
                }
            }

            $conn = mysqli_connect('hk.xero.run:33307', 'class', 'Chi123..@', 'class');
            mysqli_set_charset($conn, "utf8");
            // $_GET[page] 为当前页，如果$_GET[page]为空，则初始化为1
            if ($_GET['page'] == "") $_GET['page'] = 1;
            if (is_numeric($_GET['page'])){
            $page_size = 5;
            if (!$_GET['category']){
                $query = "select uptime from news order by uptime desc";
                $result = mysqli_query($conn, $query);
                $message_count = mysqli_num_rows($result);
            } else{
                $query = "select uptime from news where category='{$t1}' order by uptime desc";
                $result = mysqli_query($conn, $query);
                $message_count = mysqli_num_rows($result);
            }
                  //要显示的总记录数
            $page_count = ceil($message_count / $page_size);    //求出总页数
            $offset = ($_GET['page'] - 1) * $page_size;        //计算下一页从第几条数据开始循环
//            $cgy=$_GET['category'];

//            echo $cgyn=$row['category'];
            //判断是否为主页
            if (!$_GET['category']){
                $s1="";

            }else{
                $sql = "select * from newscate where categoryName='{$cgy}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $cgyn=$row['category'];
                $s1="where category='{$cgyn}'";
            }

            $sql = mysqli_query($conn, "select * from news {$s1} order by uptime desc limit $offset, $page_size");
//            $sql = mysqli_query($conn, "select * from news order by uptime desc limit $offset, $page_size");
            $row = mysqli_fetch_object($sql);
            echo "<div class='more'>";
            echo "<table border='0' class='show_notice' style='table-layout: fixed;'>";
            if (!$row) {
                echo "<tr><td colspan='2' class='item' style='text-align:center;'><font color='red'>暂无更多新闻！</font></td></tr>";
                echo "</table>";
            } ?>
            <ul class="ul-list">
                <?
                do {
                    ?>
                    <li class="item" style="width: 80%" "><a class="a-list"
                                                             href='detail.php?id=<?php echo $row->id; ?>'><? echo $row->title; ?></a></li>
                    <li class="item" style="margin-top: 13px"
                        content="<?php echo $row->uptime; ?>"><?php $str = date("Y-m-d", $row->uptime);
                        echo printfStr($str); ?></li>
                    <?php

                } while ($row = mysqli_fetch_object($sql));
                }
                ?>
            </ul>
            </table>
        </div>
        <table border="0" class="tip">

        </table>
        <center style="padding-top: 30px">
            <tr>
                <td>页次：<?php echo $_GET['page']; ?>/<?php echo $page_count; ?>页&nbsp;
                    记录：<?php echo $message_count; ?> 条&nbsp;
                </td>

            </tr>
            <div style="float: left;text-align: center;margin-left: 40%">
                <?php
                if (!$_GET['category']){
                     $ctg="?";
                }else{
                    $ctg="?category=".$_GET['category']."&";
                }
//                $ctg=$_GET['category'];
                if ($_GET['page'] != 1) {
                    echo "<a href='{$ctg}page=1'>首页</a>&nbsp";
                    echo "<a href='{$ctg}page=" . ($_GET['page'] - 1) . "'>上一页</a>&nbsp;";
                }
                if ($_GET['pqge'] < $page_count) {
                    echo "<a href='{$ctg}page=".($_GET['page'] + 1) . "'>下一页</a>&nbsp;";
                    echo "<a href='{$ctg}page=" . $page_count . "'>尾页</a>";
                }
                mysqli_close($conn);
                ?>
            </div>
        </center>
    </div>
</div>
</div>
</body>
</html>