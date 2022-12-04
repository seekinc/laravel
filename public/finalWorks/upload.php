<?php
//$image = $_FILES['uploadFile'];
//$path = 'uploads/'.$_FILES['uploadFile']['name'];
//if ($image) {
//    move_uploaded_file($image['tmp_name'], $path);
//}
//
//$json = [
//    'success' => true,
//    'msg' => $image,
//    'file_path' => $path,
//];
//echo json_encode($json);
$pID = $_GET['id'];
$image = $_FILES[$pID];
$path = 'uploads/' . $pID . '__' . $_FILES[$pID]['name'];

if ($image) {
    move_uploaded_file($image['tmp_name'], $path);
}

$json = [
    'success' => true,
    'msg' => $image,
    'file_path' => $path,
];

echo json_encode($json);


