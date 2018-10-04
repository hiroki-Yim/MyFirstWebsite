<?php
session_start();
unset($_SESSION["id"]);   // 로그아웃 시 세션에 저장된 id와 name정보를 삭제함
unset($_SESSION["name"]);
header("Location: main.php"); // main페이지로 이동
 ?>
