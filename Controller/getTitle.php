<?php
header("Content-Type: application/json");

require_once('../Model/boardDao.php');
require_once('../config/tools.php');

$bdao = new boardDao();

$param = $_GET['param'];
 
    $result = $bdao->searchTitle($param);
    $paramArray = array($result);
    echo json_encode($paramArray);


?>