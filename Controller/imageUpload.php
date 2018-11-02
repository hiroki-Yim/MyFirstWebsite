<?php

$return_value = "";

if ($_FILES['image']['name']) {
if (!$_FILES['image']['error']) {
$ext = explode('.', $_FILES['image']['name']);  
$filename = time().'.'.$ext[1];
$destination = '../uploadedFile/Images/users/'.$filename;
$location = $_FILES['image']['tmp_name'];
move_uploaded_file($location, $destination);
$return_value ='../../uploadedFile/Images/users/'.$filename;
}else{
$return_value ='업로드에 실패 하였습니다.: '.$_FILES['image']['error'];
}
}
echo $return_value;
?>