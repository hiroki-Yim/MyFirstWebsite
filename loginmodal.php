  <!-- The Modal -->
  <div id="login_btn" class="modal">
    <span onclick="document.getElementById('login_btn').style.display='none'" class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form class="modal-content animate" action="./login_mainForm.php">
      <div class="imgcontainer">
        <img src="./img/login_icon.svg" alt="Avatar" class="avatar">
      </div>

      <div class="container wrapper">
        <b>학번</b>
        <input type="text" placeholder="학번" name="id" required>
        <b>비밀번호</b>
        <input type="password" placeholder="비밀번호" name="pwd" required>
        <button type="submit">로그인</button>
        <button class="pwd cancelbtn" onclick="locationView('register')">아직 회원이 아니세요?</button>
      </div>
    </form>
  </div>