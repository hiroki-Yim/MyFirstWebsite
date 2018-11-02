<?php
session_start();                  //세션 시작
require_once("../config/tools.php");     //직접 만든 메서드 requestValue를 이용하기 위해 tools 불러옴
require_once("../Model/boardDao.php");    //db에 접속하기 위해 만든 bdo 불러옴
$bdao = new boardDao();           //변수에 만든 db객체 담음


$sid = $_SESSION['id']??'';       //php 7버전 이상부터 사용할 수 있음 isset에다가 삼항 연산자를 사용 한것과 같음 현재 세션아이디를 가져옴
$num = requestValue("num");       //현재 보고있는 글의 번호를 들고옴
$writer = requestValue("writer"); //보고 있는 view에서 보고있는 글 작성자를 받아옴
$page = requestValue("page");

if($sid == $writer){              //세션 아이디(현재 접속자)와 쓰여진 글의 작성자가 같은지 확인함.
  if($num){                       //글이 존재하면
  $bdao->deleteMsg($num);         //bdo에서 만든 delete문을 실행함
  okGo("해당글이 삭제되었습니다.", "../View/kakaoView/board.php?page=".$page);
  }else{
    errorBack("이미 삭제된 게시물 입니다.", "../DBS/board.php"); //글이 존재하지 않으면
  }
}else{
  errorBack("작성자만 삭제 할 수 있습니다.");            //접속된 아이디와 글의 아이디가 다르면
}
?>
