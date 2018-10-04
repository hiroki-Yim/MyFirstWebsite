<?php
    session_start();
    require_once("../tools.php");
    require_once("boardDao.php");
    /* witer, title, content 값을 request에 추출
      그 값이 모두 존재하면 DB에 삽입 후에 글 목록 페이지(board)로 이동.
      값이 하나라도 없으면 errorBack */
      $writer = requestValue("writer");
      $title = requestValue("title");
      $content = requestValue("content");
      if($writer && $title && $content){
        $bdao = new boardDao();
        $bdao->insertMsg($title, $writer, $content);
        okGo("정상적으로 작성 되었습니다.","board.php");
      }else{
        errorBack("모두 항목을 입력해 주세요", "write_Form.php");
      }
?>
