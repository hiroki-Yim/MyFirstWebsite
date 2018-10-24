<?php
require_once("../tools.php");
require_once("boardDao.php");
session_start();
$bdao = new BoardDao();

$id = session_exist('id');  //witer = 현재 접속자
$board_num = requestValue('board_num'); //게시글 번호
$comments = requestValue('comments');
$page = requestValue('page');

if($id && $board_num && $comments){
    $bdao->comment($id, $board_num, $comments);
    okGo("입력되었습니다.", "view.php?num=$board_num&page=$page");
}else{
    errorBack("입력되지 않았습니다.");
}

?>