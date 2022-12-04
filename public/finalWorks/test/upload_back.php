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
if ($image != "") {
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
} else {
    $json = [
        'msg' => "Permisstion denied",
    ];
    echo json_encode($json);

}

//echo "<br><ul/>⚠ 别乱访问啊喂 (〃ﾟдﾟ〃)";
//echo "<br>&nbsp&nbsp&nbsp&nbsp要被玩坏了";
//    $path = 'uploads/' . $pID . '__' . $_FILES['uploadFile']['name'];