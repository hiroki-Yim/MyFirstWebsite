<?php
  session_start();
  require_once('./tools.php');
  require_once('MemberDao.php');
  $id = session_exist('id');
  $name = $_SESSION["name"]??'';  // null 병합자 PHP 버전7 이후 등장 isset에 삼항연산자 쓴 것과 같음
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Page Title</title>
  <?php require_once("html_head.php"); ?>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="file/assets/css/style.min.css">
  <link rel="stylesheet" href="file/assets/css/modules.css">
  <link rel="stylesheet" href="./css/login_form.css">
  <script src="./js/tools.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/innks/NanumSquareRound/master/nanumsquareround.min.css">
  
</head>

<body>
  <?php require_once('header.php'); 
        require_once('navbar.php');
        require_once('sidebar.php');
  ?>

    <div class="main" id="listDiv">
      <h2>TITLE HEADING</h2>
      <h5>Title description, Dec 7, 2017</h5>
      <div class="fakeimg" style="height:200px;">Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
      <br>
      <h2>TITLE HEADING</h2>
      <h5>Title description, Sep 2, 2017</h5>
      <div class="fakeimg" style="height:200px;">Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
  </div>

  <?php require_once('loginmodal.php'); ?>

  <?php require_once("footer.php"); // footer ?>

  <script>
    //php와 js의 문법적 차이, php는 빈 문자열이 = null 하지만, js는 undefined가 뜸 그래서 isset으로 갖고 와야함
    if ('<?= isset($_SESSION["id"]) ?>') { // 세션이 있을 때 = 로그인이 되어 있을 때
      $("#login").css("display", "none");
      $("#update").css("display", "block");
      $("#logout").css("display", "block");
    } //else { location.href="./login_main.php"; 세션이 없는사람은 들어올 수 없게 함, }

    $(function(){                     // 게시판을 메인 화면에 출력하기 위해 ajax통신을 이용함
      $("#board").click(function(){   // 게시판 버튼을 눌렀을 시 받은 data를 기반으로 main부분에 동적으로 생성
      $.ajax({
        type: 'get' ,
        url: './DBS/board.php' ,
        dataType : 'html' ,
        success: function(data) {
          $("#listDiv").html(data);
        } });
      })
    })


  </script>
</body>

</html>