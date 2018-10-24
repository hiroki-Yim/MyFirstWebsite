<?php
session_start();
require_once("boardDao.php");
require_once("../tools.php");
require_once("../config.php");
$dao = new boardDao();               //  1. DB에 등록된 게시글 리스트를 인출(boardDao에게 요청)
                                                                          /////
$currentPage = requestValue("page"); // 사용자가 page url에 page paramiter값을 넘겨줘서 받아옴
$totalCount = $dao->getNumMsgs();    // 게시판 테이블에 게시글이 총 몇 개인지 받아옴
// 집단함수, aggregate function select count(*) from board;
if($totalCount > 0){
  $totalPages = ceil($totalCount/NUM_LINES);                            // total page = ceil(전체 게시글 수 / NUM_LINES) 올림 함수 ceil
  if($currentPage < 1){ $currentPage = 1; }
  if($currentPage > $totalPages){ $currentPage = $totalPages; }

  $start = ($currentPage - 1) * NUM_LINES;
  $msgs = $dao->getManyMsgs($start, NUM_LINES);                         //  DB에 있는 모든 글 정보를 가져옴

  $startPage = floor(($currentPage-1)/NUM_PAGE_LINKS)*NUM_PAGE_LINKS+1; //내 림 함수 floor 사용
  $endPage = $startPage + NUM_PAGE_LINKS - 1;                           // NUM_PAGE_LINKS 만큼 보여 주겠다.

  if($endPage > $totalPages){ $endPage = $totalPages; }                 // 계산 상으로 endpage가 20이었는데 totalpages가 15이면 endpage로 하자
  if($startPage == 1){ $prev = true; }                                  // 만약 현재 페이지가 1이면
  if($endPage > $totalPages){ $next = true; }                           // endPage가 totalPages보다 크면

  $startRecord = floor(($currentPage-1)/NUM_LINES);
  //select * from board order by regtime limit start, count
  //current 1: start = 0, count = NUM_LINES -> 0~5
  //current 2: start = NUM_LINES, count = NUM_LINES 5~9
  //current 3: start = NUM_LINES*2, count = NUM_LINES 10~14
  //current 4: start = NUM_LINES*3, count = NUM_LINES 15~19
}//end of if
else{}//게시글이 없을 때
                                                                          /////
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>게시판</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once('./board-lib.php'); ?>
  <style>
    a:hover{
        text-decoration: none;
      }
  </style>
</head>

<body>
  <div class="container">
    <?php if($totalCount > 0) : ?>
    <h2>게시글 리스트</h2>
    <table class="table table-hover">
      <tr>
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>작성일시</th>
        <th>조회수</th>
      </tr>
      <tr>
        <!--  2. 2차원 배열로 반환된 게시글 리스트 각각에 대해 HTML 문서를 동적으로 생성  -->
        <?php foreach ($msgs as $row) : ?>
        <!-- for문을 돌리면서 정보가 없을 때 까지 뽑아 옴 -->
        <td>
          <?= $row["Num"]?>
        </td> <!-- 각 정보마다 행의 이름으로 열의 정보를 가져 옴 -->
        <td>
          <!-- 페이지 리스트가 동적으로 제너레이션 됨 -->
          <a href="<?= bdUrl("view.php", $row["Num"], $currentPage) ?>">
            <?= $row["Title"]?>
          </a>
        </td>
        <td>
          <?= $row["Writer"]?>
        </td>
        <td>
          <?= $row["Regtime"]?>
        </td>
        <td>
          <?= $row["Hits"]?>
        </td>
      </tr>
      <?php endforeach ?>
    </table>
    <br>
    <?php if($startPage > 1) : ?>
    <li class="page-item">
    <a class="page-link" href="<?= bdUrl("board.php", 0, $currentPage - NUM_PAGE_LINKS) ?>"><</a>
    </li>
    <?php endif ?>

        <?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
        <?php if($i == $currentPage) : ?>
        
        <a href="<?php bdUrl("board.php", 0, $i) ?>"><b>
            <?php $i ?></b> </a>&nbsp;
        <?php else : ?>
        <a href="<?= bdUrl("board.php", 0, $i) ?>">
          <?= $i ?></a>&nbsp;
        <?php endif ?>
        <?php endfor ?>

        <?php if($endPage < $totalPages) : ?>
        <a href="<?= bdUrl("board.php", 0, $currentPage + NUM_PAGE_LINKS) ?>">></a>
        <?php endif ?>
        <?php endif ?>
        <br>
        <br>
        <input type="button" value="글쓰기" class="btn btn-primary" onclick="location.href='<?= bdUrl('write_Form.php',0, $currentPage) ?>'">
  </div>
</body>

</html>