<?php 
require_once('../Model/boardDao.php');
require_once('../config/tools.php');
$bdao = new boardDao();

$num =       requestValue('num');
$filenames = requestValue('filenames');
$file_url =  requestValue('file_url');

$filename = $filenames; 
$reail_filename = urldecode($filename); 
$file_dir = $file_url; 

header('Content-Type: application/x-octetstream');
header('Content-Length: '.filesize($file_dir));
header('Content-Disposition: attachment; filename='.$reail_filename);
header('Content-Transfer-Encoding: binary');

$fp = fopen($file_dir, "r");
fpassthru($fp);
fclose($fp);

?>