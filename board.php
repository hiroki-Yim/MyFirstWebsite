<?php session_start();
require_once("DBS/boardDao.php");
require_once("./tools.php");
$id = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
/*
  3. </table> -> 페이지 리스트가 동적으로 제너레이션 됨(??)
  4. 글 쓰기 버튼 생성, 개념글
*/
$dao = new boardDao();        //  1. DB에 등록된 게시글 리스트를 인출(boardDao에게 요청)
$msgs = $dao->getManyMsgs();  //  DB에 있는 모든 글 정보를 가져옴

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>게시판</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style>
      a:hover{
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h2>게시글 리스트</h2>
    <table class="table table-hover">
      <tr>
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>작성일시</th>
        <th>조회수</th>
      </tr>
<!--  2. 2차원 배열로 반환된 게시글 리스트 각각에 대해 HTML 문서를 동적으로 생성  -->
      <tr>
        <?php foreach ($msgs as $row) : ?>  <!-- for문을 돌리면서 정보가 없을 때 까지 뽑아 옴 -->
          <td><?= $row["Num"]?></td>        <!-- 각 정보마다 행의 이름으로 열의 정보를 가져 옴 -->
          <td>
            <a href="DBS/view.php?id=<?=$row["Num"]?>">
              <?= $row["Title"]?>
            </a>
          </td>
          <td><?= $row["Writer"]?></td>
          <td><?= $row["Regtime"]?></td>
          <td><?= $row["Hits"]?></td>
      </tr>
    <?php endforeach ?>
    </table>

    <input type="button" value="글쓰기" class="btn btn-primary" onclick="location.href='DBS/write_Form.php'">

    </div>
  </body>
</html>
