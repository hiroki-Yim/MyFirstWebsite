<?php 
  require_once('MemberDao.php');
  require_once('tools.php');
?>

<!DOCTYPE html>
<html lang="kr" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>회원가입 페이지</title>
  
  <?php // require_once('./html_head.php'); ?>
  <link rel="stylesheet" type="text/css" href="./css/registerForm.css" />
  
</head>
<?php //require_once('header.php'); 
      //require_once('navbar.php');
?>
<body>
  <form id="msform" method="post" action="register.php">
    <!--  action : 폼을 전송할 서버 쪽 스크립트 파일을 지정합니다.
          name : 폼을 식별하기 위한 이름을 지정합니다.
          accept-charset : 폼 전송에 사용할 문자 인코딩을 지정합니다.
          target : action에서 지정한 스크립트 파일을 현재 창이 아닌 다른 위치에 열도록 지정합니다.
          method : 폼을 서버에 전송할 http 메소드를 정합니다. (GET 또는 POST) -->
    <fieldset>
      <!-- fieldset 태그는 form 양식에 관계된 요소들끼리 묶어주고, 관계 요소 주위에 박스를 그림 -->
      <h2 class="fs-title">Create your account</h2>학번
      <!-- pattern 은 정규식을 넣어서 데이터를 검증할 수 있는 속성.  pattern 속성에 정규식을 넣어서 input 에 입력한 값의 유효성을 체크할 수 있는 것 -->
      <input type="tel" maxlength="7" pattern="[0-9]{7}" name="id" title="학번 형식으로 입력해 주세요!" placeholder="본인의 학번 7자리를 입력 해 주세요."
        required> 비밀번호
      <input type="password" maxlength="15" name="pwd" pattern=".{6,}" title="6자 이상 입력 해 주세요!" placeholder="비밀번호 6자 이상"
        required>
      <input type="password" maxlength="15" name="cpwd" placeholder="비밀번호 재확인" required> 이름
      <!-- required 는 input 박스에 값을 반드시 입력해야 넘어갈 수 있도록 만드는 속성. 만약 입력하지 않으면 더 이상 진행할 수가 없음창이 뜸-->
      <!--   1. type : 입력 태그의 유형
             2. vlaue : 입력 태그의 초기값을 말하며 사용자가 변경 가능.
             3. name : 서버로 전달되는 이름 (사용자 임의 지정)       -->
      <input type="text" maxlength="10" name="name" placeholder="ex)홍길동" required> 이메일
      <input type="text" name="mail" placeholder="exemple@google.com" required> 전화번호
      <input type="text" name="phone" placeholder="010-1234-5678" required>
      <p id="horizon_boxing">성별
        <hr />
        <input class="hidden_btns" type="radio" id="male_btn" name="gender" value="남" required />
        <label for="male_btn">
          <div class="gender">남성</div>
        </label>
        <input class="hidden_btns" type="radio" id="female_btn" name="gender" value="여" required />
        <label for="female_btn">
          <div class="gender">여성</div>
        </label>
      </p>
      <input type="submit" class="submit action-button" value="Submit" />
      <!-- class에 space(공백)으로 구분 해 놓으면 class명을 여러 개 사용 할 수 있다.-->
    </fieldset>
  </form>
</body>

<?php   //require_once('loginmodal.php'); //modal 다음으로 footer에 있는 SCRIPT문이 실행되기 때문에 순서는 중요
        //require_once('footer.php'); 
?>
</html>