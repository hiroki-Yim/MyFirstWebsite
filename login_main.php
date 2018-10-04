<!DOCTYPE html>
<html lang="en">
<head>
  <title>로그인 페이지</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
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
    <a href="registerForm.php"><div class="btn btn-danger">회원가입</div></a>
  </form>
</div>
</body>
</html>
