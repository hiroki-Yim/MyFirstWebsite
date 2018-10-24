<?php
/*
 3. 입력된 아이디를 가진 레코드가 있고, 비밀번호가 맞으면 로그인(인증) -> 이후 세션에 로그인 정보를 저장
 (세션은 서버의 메모리공간에 저장하고 특정 시간이 지나면 사라지기 때문.)
 4. 레코드가 없거나, 비밀번호가 틀리면 에러메세지 출력 후 로그인 페이지로 이동  (세션은 1개 사용자마다!)
*/
require_once('tools.php'); // 1. 로그인 입력폼에서 전달된 아이디, 비밀번호 읽기 $_REQUEST
require_once('MemberDao.php');
session_start();
$id = requestValue('id');
$pwd = requestValue('pwd');
if($id && $pwd){  // 로그인 처리 페이지 -사용자가 입력한 id와 pwd가 존재하는 회원의 것인지 CHECK
  $mdao = new MemberDao(); // 2. 로그인 폼에 입력된 아이디의 회원보를 DB에서 읽기 DAO
  $result = $mdao->getMember("id", $id);
  if ($result['pwd']==$pwd) {  // - 세션에 로그인한 사람의 id와 pwd를 저장}
        $_SESSION["id"] = $id; // 로그인한 사용자의 id를 세션에 저장
        $_SESSION["name"] = $result["name"];  // 결과값에 있는 name을 세션에 저장
        okGo($result["name"]."님로그인 되었습니다.", "index.php");  // 다 맞으면 로그인 후 메인페이지로 이동
  }else{ errorBack("아이디와 비밀번호를 다시 확인하세요"); } // 비밀 번호나 아이디가 틀리면
}else{ errorBack("모두 입력해 주세요.");} // 폼에 입력되지 않은 정보가 있으면
?>
