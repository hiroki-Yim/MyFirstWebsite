<?php
session_start();
require_once("../tools.php");
require_once("boardDao.php");
$sid = $_SESSION["id"]??'';

if(!$sid){  // 만약 로그인 되어있지 않으면 error발생
  errorBack("로그인 한 뒤에 볼 수 있습니다.");
}else{      // 로그인 되어 있으면 정보를 가져와서 렌더링 해줌
  $id = requestValue("id");     // 현재 게시글의 번호 Num을 게시글로 부터 받아옴
  $page = requestValue("page");
  $bdao = new boardDao();
  $prenex = $bdao->prenex($id); // 이전 글과 다음 글의 정보를 가져오기 위해 db 2차원 배열 형태로 가져옴
  $msg = $bdao->getMsg($id);    // 현재 글 번호에 맞춰 DB에 저장된 글을 가지고 옴(1차원 배열로)
  $bdao->increaseHits($id);     // 현재 글의 조회수를 1증가 시키는 메서드 호출
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>VIEW</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script>
      function delReq(num){ // 삭제할 경우 삭제를 확인을 받기 위해 deleteRequest함수를 만듦
        var yn = confirm("정말 삭제 하시겠습니까?");
        if (yn == false){ return; } // 아니오를 눌렀을 시 아무 반응 하지않게 함
        else { location.href="delete.php?num="+num+"&writer="+<?= $msg["Writer"] ?>; }  // 예를 눌렀을 때 delete.php에 글 값을 전달하여 삭제함
      }
  </script>
  <style type="text/css">
  /* 이전 글 다음 글 css 적용, 검정색, decoration제거 */
    .prenex a{
      text-decoration: none;
      color : black;
      font-size: 1em;
    }
  </style>
</head>

  <body>
    <div class="container">
      <table class ="table">
          <!-- DB에서 가져와서 $msg로 저장되어 있는 1차원 배열의 게시글의 정보를 이용하여 html을 동적으로 생성 -->
          <tr>
            <th>제목</th>
            <td><?= $msg["Title"] ?></td>
          </tr>
          <tr>
            <th>작성자</th>
            <td><?= $msg["Writer"] ?></td>
          </tr>
          <tr>
            <th>작성일시</th>
            <td><?= $msg["Regtime"] ?></td>
          </tr>
          <tr>
            <th>조회수</th>
            <td><?= $msg["Hits"] ?></td>
          </tr>
          <tr>
            <th>내용</th>
            <td><?= $msg["Content"] ?></td>
          </tr>
      </table>          <!-- 글 번호를 통해 삭제하고, 수정을 요청함 -->
    <input type="button" class="btn btn-primary" onclick="location.href='board.php'" value="목록보기">
    <input type="button" class="btn btn-success" onclick="location.href='modify_Form.php?id=<?= $id ?>'" value="수정하기">
    <input type="button" class="btn btn-danger" onclick="delReq(<?=$id?>)" value="삭제하기">
    <br>
    <hr>

  <div class="prenex">  <!-- 이전 글과 다음 글의 정보를 2차원 배열로 받아와서 해당 번호로 글 요청을 하고 동적으로 a태그를 생성해줌 -->


    <?php if(isset($prenex[1])): ?>
      <input type="button" class="btn btn-primary" onclick="location.href='view.php?id=<?= $prenex[1]["Num"] ?>'" value="다음 글" style="margin:2px;">
      <b><a href="view.php?id=<?= $prenex[1]['Num']?>"><?= $prenex[1]["Title"] ?></a></b>
  <?php endif ?>
      <br>
  <?php if(isset($prenex[0])): ?>
<input type="button" class="btn btn-primary" onclick="location.href='view.php?id=<?= $prenex[0]["Num"] ?>'" value="이전 글" style="margin:2px;">
    <b><a href="view.php?id=<?= $prenex[0]['Num']?>"><?= $prenex[0]["Title"] ?></a> </b>
  <?php endif ?>
</div>
    </div> <!-- end of container div -->
  </body>
</html>
