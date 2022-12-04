<?php
$connection = require_once "conn.php";
@mysqli_select_db($connection,dbname);

$sql="insert into newscate set category='test22',categoryName='test22'";
$result=mysqli_query($connection,$sql);