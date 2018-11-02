<?php
session_start();
require_once("../config/tools.php");
require_once("../Model/boardDao.php");
$sid = session_exist('id'); 
if(!$sid){  // 만약 로그인 되어있지 않으면 error발생
  errorBack("로그인 한 뒤에 볼 수 있습니다.");
}else{      // 로그인 되어 있으면 정보를 가져와서 렌더링 해줌
  $num = requestValue("num");     // 현재 게시글의 번호 Num을 게시글로 부터 받
  $page = requestValue("page");
  $bdao = new boardDao();
  $prenex = $bdao->prenex($num); // 이전 글과 다음 글의 정보를 가져오기 위해 db 2차원 배열 형태로 가져옴
  $msg = $bdao->getMsg($num);    // 현재 글 번호에 맞춰 DB에 저장된 글을 가지고 옴(1차원 배열로)
  $bdao->increaseHits($num);     // 현재 글의 조회수를 1증가 시키는 메서드 호출

  $comments = $bdao->getComment($num);
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>VIEW</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="../bower_components/bootstrap-material-design/css/mdb.css" rel="stylesheet">
 

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script src="../bower_components/bootstrap-material-design/js/mdb.js"></script>
<script src="../public/js/tools.js"></script>
<script src="../public/js/view.js"></script>  

</head>

<body>
  <div class="container">
    <table class="table">
      <!-- DB에서 가져와서 $msg로 저장되어 있는 1차원 배열의 게시글의 정보를 이용하여 html을 동적으로 생성 -->
      <tr>
        <th>제목</th>
        <td>
          <?= $msg["Title"] ?>
        </td>
      </tr>
      <tr>
        <th>작성자</th>
        <td>
          <?= $msg["Writer"] ?>
        </td>
      </tr>
      <tr>
        <th>작성일시</th>
        <td>
          <?= $msg["Regtime"] ?>
        </td>
      </tr>
      <tr>
        <th>조회수</th>
        <td>
          <?= $msg["Hits"] ?>
        </td>
      </tr>
      <tr>
        <th>내용</th>
        <td>
          <?= $msg["Content"] ?>
        </td>
      </tr>
    </table> <!-- 글 번호를 통해 삭제하고, 수정을 요청함 -->
    <input type="button" class="btn btn-primary" onclick="locationView('board',<?= $page ?>);" value="목록보기">
    <?php if($msg['Writer'] == $sid) : ?>
    <input type="button" class="btn btn-success" onclick="locationView('modifyForm',<?= $num ?>);" value="수정하기">
    <input type="button" class="btn btn-danger" onclick="delReq(<?= $num ?> , <?= $msg['Writer'] ?>, <?= $page ?>);"
      value="삭제하기">
    <?php endif ?>
    <br>
    <hr>

  <?php require_once('div-comment.php'); ?>

    <form class="comment" method="post" action="../Controller/comment.php?page=<?= $page ?>">
      <!--Textarea with icon prefix-->
      <div class="md-form mb-4 pink-textarea active-pink-textarea" id="comment_input">
        <textarea type="text" id="form21" class="md-textarea form-control" rows="3" name="comments"></textarea>
        <label for="form21" class="id">댓글 작성자 : <code><?= $sid ?></code></label>
        <button type="submit" class="btn btn-primary comment_btn"></button>
        <input type="hidden" name="board_num" value="<?= $num ?>"><!-- 따로 입력 안받으니 값을 정해줘야함 -->
      </div>
    </form>

    <?php // if($files) "첨부된 파일".$files;  ?>

    <div class="prenex">
      <!-- 이전 글과 다음 글의 정보를 2차원 배열로 받아와서 해당 번호로 글 요청을 하고 동적으로 a태그를 생성해줌 -->
      <?php if(isset($prenex[1])): ?>
      <label for="next_btn">
      <input type="button" id="next_btn" class="btn btn-primary" onclick="locationView('view', <?=$prenex[1]['Num']?>,<?=$page?>);"
        value="다음 글">
      <b><?= $prenex[1]["Title"] ?></b>
        </label>
      <?php endif ?>
      <br>
      <?php if(isset($prenex[0])): ?>
      <label for="prev_btn">
        <input type="button" id="prev_btn" class="btn btn-primary" onclick="locationView('view', <?=$prenex[0]['Num']?>,<?=$page?>);"
          value="이전 글">
        <b><?= $prenex[0]["Title"] ?></b>
      </label>
      <?php endif ?>
    </div>
  </div> <!-- end of container div -->
</body>

</html>