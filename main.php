<?php
  session_start();
  require_once('./tools.php');
  require_once('MemberDao.php');
  $id = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
  $name = $_SESSION["name"]??'';  // null 병합자 PHP 버전7 이후 등장 isset에 삼항연산자 쓴 것과 같음
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Page Title</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<link rel="stylesheet" href="./css/main.css">
<link rel="stylesheet" href="file/assets/css/style.min.css">
<link rel="stylesheet" href="file/assets/css/modules.css">
</head>
<body>
<div class="header">
  <h1>YoungJin University WebSite</h1>
  <h3 class = "sid"><?php if(isset($_SESSION["id"])){ echo $name."님 환영합니다.";}else{ echo " ";} ?></h3>
</div>

<div class="navbar">
  <div id="login">
    <a href="login_main.php"><div class="label">로그인</div></a>
    <a href="registerForm.php"><div class="label">회원가입</div></a>
  </div>
  <a href="logout.php"> <div class="label" id = 'logout' style="display:none;"> 로그아웃 </div></a>
  <a href="update_Form.php"><div class="label" id ='update' style="display:none;">회원정보 수정</div></a>
  <a id='board'><div class="label">게시판</div></a>
</div>

<div class="row">
  <div class="side">
      <h2>About Me</h2>
      <h5>Photo of me:</h5>
      <img src="img/pic1.jpg" width="243.45" height="200">
      <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
      <h3>More Text</h3>
      <p>Lorem ipsum dolor sit ame.</p>
      <div class="fakeimg" style="height:60px;">Image</div><br>
      <div class="fakeimg" style="height:60px;">Image</div><br>
      <div class="fakeimg" style="height:60px;">Image</div>
  </div>
  <div class="main" id="listDiv">
      <h2>TITLE HEADING</h2>
      <h5>Title description, Dec 7, 2017</h5>
      <div class="fakeimg" style="height:200px;">Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
      <br>
      <h2>TITLE HEADING</h2>
      <h5>Title description, Sep 2, 2017</h5>
      <div class="fakeimg" style="height:200px;">Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
  </div>
</div>

<!-- <div class="footer"></div> -->
<!-- footer 하단 부분 -->
<footer>
  <div class="MOD_FOOTER2" data-theme="_bgd">
    <div data-layout="_r">
      <div data-layout="al16 ch8 ch-o1 ec-third ec-o1">
        <h3>Links</h3>
        <nav>
          <ul>
            <li><a href="#">Footer Link 1</a></li>
            <li><a href="#">Footer Link 2</a></li>
            <li><a href="#">Footer Link 3</a></li>
            <li><a href="#">Footer Link 4</a></li>
            <li><a href="#">Footer Link 5</a></li>
          </ul>
        </nav>
      </div>
      <div data-layout="al16 ch-o3 ec-third ec-o2">
        <h3>Contact</h3>
        <!-- Facebook SVG -->
        <div class="MOD_FOOTER2_Icons">
          <a href="#" class="smIcon"><svg class="fb" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0v24h24v-24h-24zm16 7h-1.923c-.616 0-1.077.252-1.077.889v1.111h3l-.239 3h-2.761v8h-3v-8h-2v-3h2v-1.923c0-2.022 1.064-3.077 3.461-3.077h2.539v3z"/></svg></a>
          <!-- Twitter SVG -->
          <a href="#" class="smIcon"><svg class="tw" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0v24h24v-24h-24zm18.862 9.237c.208 4.617-3.235 9.765-9.33 9.765-1.854 0-3.579-.543-5.032-1.475 1.742.205 3.48-.278 4.86-1.359-1.437-.027-2.649-.976-3.066-2.28.515.098 1.021.069 1.482-.056-1.579-.317-2.668-1.739-2.633-3.26.442.246.949.394 1.486.411-1.461-.977-1.875-2.907-1.016-4.383 1.619 1.986 4.038 3.293 6.766 3.43-.479-2.053 1.079-4.03 3.198-4.03.944 0 1.797.398 2.396 1.037.748-.147 1.451-.42 2.085-.796-.245.767-.766 1.41-1.443 1.816.664-.08 1.297-.256 1.885-.517-.44.656-.997 1.234-1.638 1.697z"/></svg></a>
          <!-- LinkedIn SVG -->
          <a href="#" class="smIcon"><svg class="li" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0v24h24v-24h-24zm8 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.397-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
          <!-- Google Plus SVG-->
          <a href="#" class="smIcon"><svg class="gp" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0v24h24v-24h-24zm8.667 16.667c-2.581 0-4.667-2.087-4.667-4.667s2.086-4.667 4.667-4.667c1.26 0 2.313.46 3.127 1.22l-1.267 1.22c-.347-.333-.954-.72-1.86-.72-1.593 0-2.893 1.32-2.893 2.947s1.3 2.947 2.893 2.947c1.847 0 2.54-1.327 2.647-2.013h-2.647v-1.6h4.406c.041.233.074.467.074.773 0 2.666-1.787 4.56-4.48 4.56zm11.333-4h-2v2h-1.333v-2h-2v-1.333h2v-2h1.333v2h2v1.333z"/></svg></a>
          <!-- Pinterest SVG -->
          <a href="#" class="smIcon"><svg class="pi" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0v24h24v-24h-24zm12 20c-.825 0-1.62-.125-2.369-.357.326-.531.813-1.402.994-2.098l.499-1.901c.261.498 1.023.918 1.833.918 2.413 0 4.151-2.219 4.151-4.976 0-2.643-2.157-4.62-4.932-4.62-3.452 0-5.286 2.317-5.286 4.841 0 1.174.625 2.634 1.624 3.1.151.07.232.039.268-.107l.222-.907c.019-.081.01-.15-.056-.23-.331-.4-.595-1.138-.595-1.825 0-1.765 1.336-3.472 3.612-3.472 1.965 0 3.341 1.339 3.341 3.255 0 2.164-1.093 3.663-2.515 3.663-.786 0-1.374-.649-1.185-1.446.226-.951.663-1.977.663-2.664 0-.614-.33-1.127-1.012-1.127-.803 0-1.448.831-1.448 1.943 0 .709.239 1.188.239 1.188s-.793 3.353-.938 3.977c-.161.691-.098 1.662-.028 2.294-2.974-1.165-5.082-4.06-5.082-7.449 0-4.418 3.582-8 8-8s8 3.582 8 8-3.582 8-8 8z"/></svg></a>
        </div>
        <p>Email: <a href="mailto:imhk_@naver.com">imhk_@naver.com</a><br>Phone: <a href="tel:#">01234 567 8910</a>
        </p>
        <p>Copyright &copy; 2017 Company</p>
      </div>
      <div data-layout="al16 ch8 ch-o2 ec-third ec-o3">
        <h3>Address</h3>
          <address>
            123 The High Street<br>
            The Town<br>
            The City<br>
            County / State<br>
            Postal / Zip Code
          </address>
      </div>
    </div>
  </div>
</footer>

<script>    //php와 js의 문법적 차이, php는 빈 문자열이 = null 하지만, js는 undefined가 뜸 그래서 isset으로 갖고 와야함
if ('<?= isset($_SESSION["id"]) ?>') { // 세션이 있을 때 = 로그인이 되어 있을 때
    $("#login").css("display", "none");
    $("#update").css("display", "block");
    $("#logout").css("display", "block");
} //else { location.href="./login_main.php"; 세션이 없는사람은 들어올 수 없게 함, }

$(function(){                     // 게시판을 메인 화면에 출력하기 위해 ajax통신을 이용함
  $("#board").click(function(){   // 게시판 버튼을 눌렀을 시 받은 data를 기반으로 main부분에 동적으로 생성
  $.ajax({
    type: 'post' ,
    url: 'board.php' ,
    dataType : 'html' ,
    success: function(data) {
      $("#listDiv").html(data);
    } });
  })
})
</script>
</body>
</html>
