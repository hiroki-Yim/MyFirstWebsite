<?php
require_once('tools.php');
require_once('MemberDao.php');
session_start();
// 폼에 입력되어있는 모든 정보를 받아옴
$id = requestValue('id');
$pwd = requestValue('pwd');
$name = requestValue('name');
$mail = requestValue('mail');
$phone = requestValue('phone');
$sid = session_exist('id');

if(!$sid){ // 회원정보 수정 방어 (세션 아이디가 없으면)
  errorBack("로그인 하여 주십시오.");
}else if($sid != $id){ // 세션 아이디와 수정 하고자 하는 아이디가 다르면
  errorBack("다른 회원의 정보는 수정할 수 없습니다.");
}
if($id && $pwd && $name && $mail && $phone){  // 모든 정보가 다 입력 되었다면
    $mdao = new MemberDao();
    $mdao->updateAccount($id, $pwd, $name, $mail, $phone);     // 쓰여진 정보를 기반으로 update함수 실행 = DB에 저장
    $_SESSION["name"] = $name;
    okGo(" $id 님의 정보가 수정되었습니다..", "index.php");       // 원래 url정보로 MAIN_PAGE상수 넣어야 함
}else{
    errorBack("모든 정보를 입력해 주세요.");  // 모든 정보가 입력되지 않으면 다시 작성
}
?>
