<!DOCTYPE html>
<html lang="en">

<head>
  <title>로그인 페이지</title>
  <?php require_once("html_head.php"); ?>

</head>

<body>
  <div class="container">
    <form action="login_mainForm.php" method="post">
      <div class="form-group">
        <label for="id">아이디</label>
        <input type="text" class="form-control" id="id" name="id">
      </div>
      <div class="form-group">
        <label for="pwd">비밀번호</label>
        <input type="password" class="form-control" id="pwd" name="pwd">
      </div>
      <button type="submit" class="btn btn-primary">로그인</button>
      <a href="registerForm.php">
        <div class="btn btn-danger">회원가입</div>
      </a>
    </form>
  </div>
</body>

</html>