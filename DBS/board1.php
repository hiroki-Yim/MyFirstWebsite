<?php
require_once("../Model/boardDao.php");
require_once("../config/tools.php");
require_once("../config/config.php");
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
  
</head>
<body>
  <?php 
    if(requestValue('num')){
      $num = requestValue('num');
      $boardView = "view.php";
  }
  else{
    $num = 0;
    $boardView = "board.php";
  } ?>

    <?php if($totalCount > 0) : ?>
    <h2>게시글 리스트</h2>
    

        <!--  2. 2차원 배열로 반환된 게시글 리스트 각각에 대해 HTML 문서를 동적으로 생성  -->
        <div class="d-flex align-content-end flex-wrap">
        <?php foreach ($msgs as $row) : ?>
        <?php for($i=0; $i<count($msgs); $i++) : ?>
    <div class="col-lg-4 col-md-6">

<!--Card-->
<div class="card order-3 p-2 col-example">

  <!--Card image-->
  <div class="view">
    <img src="../public/img/pic1.jpg" class="card-img-top" alt="photo">
    <a href="#">
      <div class="mask rgba-white-slight"></div>
    </a>
  </div>

  <!--Card content-->
  <div class="card-body elegant-color white-text">
    <!--Title-->
    <h4 class="card-title"><a href="<?= bdUrl("view.php", $row["Num"], $currentPage) ?>">
            <?= $row["Title"]?>
          </a></h4>
    <!--Text-->
    <p class="card-text white-text">
         <td class="align-left">
          BoardNum:<?= $row["Num"]?>
        </td>
        <hr>
        <td>
          Writer:<?= $row["Writer"]?>
        </td>
        <hr>
        <td>
          Regtime:<?= passing_time($row["Regtime"]); ?>
        </td>
        <hr>
        <br>
        
        <td>
          Hits:<?= $row["Hits"]?>
        </td>

    </p>
    <a href="#" class="btn btn-outline-white btn-md waves-effect">읽기</a>
  </div>

</div>
<!--/.Card-->

</div>
<!-- Grid column -->
</div>
        <?php endfor ?>
      <?php endforeach ?>
    <br>

    <ul class="pagination pg-dark">
    
    <?php if($startPage > 1) : ?>
    <li class="page-item">
    <a class="page-link" href="<?= bdUrl($boardView, $num, $currentPage - NUM_PAGE_LINKS) ?>">
    <span aria-hidden="true">&laquo;</span>
      <span class="sr-only">previous</span>
    </a>
    </li>
    <?php endif ?>

        <?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
        <?php if($i == $currentPage) : ?>
        <li class="page-item active">
        <a class="page-link" href="<?php bdUrl($boardView, $num, $i) ?>">
            now<?php $i ?>
        </a>
        </li>
        <?php else : ?>
        <li class="page-item">
        <a class="page-link" href="<?= bdUrl($boardView, $num, $i) ?>">
          <?= $i ?></a>&nbsp;
        </li> 
        <?php endif ?>
        <?php endfor ?>

        <?php if($endPage < $totalPages) : ?>
        <li class="page-item ">
        <a class="page-link" aria-label="Next" href="<?= bdUrl($boardView, $num, $currentPage + NUM_PAGE_LINKS) ?>">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
        </a>
        </li> 
        </ul>
        <?php endif ?>
        <?php endif ?>

        <input type="button" value="글쓰기" class="btn btn-primary" onclick="location.href='<?= bdUrl('write_Form.php',0, $currentPage) ?>'">
  </div>
</body>

</html>