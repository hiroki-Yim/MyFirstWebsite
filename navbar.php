<div class="navbar">
    <div id="login">
      <a onclick="document.getElementById('login_btn').style.display='block'" style="width:auto;">
        <div class="label">로그인</div>
      </a>
      <a href="./Views/account/registerForm.php">
        <div class="label">회원가입</div>
      </a>
    </div>
    <a href="./Controller/logout.php">
      <div class="label" id='logout' style="display:none;"> 로그아웃 </div>
    </a>
    <a href="update_Form.php">
      <div class="label" id='update' style="display:none;">회원정보 수정</div>
    </a>
    <a href="./View/kakaoView/board.php" id='board'>
      <div class="label">게시판</div>
    </a>
  </div>