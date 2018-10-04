<?php
    session_start();
    require_once("../tools.php");
    require_once("boardDao.php");

    //  해당 글을 수정하기 위해 글에 대한 정보를 불러온다.
    $writer = requestValue("writer");
    $title = requestValue("title");
    $content = requestValue("content");
    $num = requestValue("num");

    if($writer && $title && $content){  // 수정 하고자 하는 글의 폼에 모든 정보가 입력되어 있으면

      $bdao = new boardDao();           //db에 접속하고 정보를 가져오고 update 쿼리를 실행시킨다.
      $bdao->updateMsg($title, $writer, $content, $num);
      okGo("정상적으로 수정되었습니다.","view.php?id=$num");  // 수정이 완료되면 alert창과 함께 수정했던 글로 다시 돌아간다.
    }else{
      errorBack("모든 항목을 빈칸 없이 입력해 주세요");        // 모든 폼에 정보가 쓰여지지 않았다면 error발생 다시 수정 폼으로 돌아간다.63
    }
?>
