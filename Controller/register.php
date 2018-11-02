<?php
    require_once("../config/tools.php");  //tools에 있는 함수 호출위해
    require_once("../Model/MemberDao.php");
    // 1. 회원가입폼에서 입력된 정보를 추출
    $id = requestValue("id");
    $pwd = requestValue("pwd");
    $name = requestValue("name");
    $mail = requestValue("mail");
    $phone = requestValue("phone");
    $gender = requestValue("gender");

    if($id && $pwd && $name && $mail && $phone && $gender) {  // 2. 모든 입력 필드의 값이 다 채워져 있는지 체크
        $mdao = new MemberDao();
        if($mdao->getMember("id", $id)){           // 3. 아이디가 이미 사용중인지 체크, 이미 사용중인 아이디(db에 존재할 경우)
          errorBack("이미 존재하는 학번 입니다..");  // 3-1. 이미 사용 중이라면 "이미 사용중인 아이디입니다." 출력 후 회원가입폼으로 이동
      }else{
        $mdao->insertMember($id, $pwd, $name, $mail, $phone, $gender); // 4. 데이터베이스에 회원 정보를 insert
        okGo("가입이 완료되었습니다.", '../../view/kakaoView/index.php');   // 5. 메인 페이지로 이동
      }
    }else{  // 2-1. 다 채워져 있지 않으면 " 다 채워 주세요 " 라는 메시지를 띄워주고 회원가입폼으로 이동
          errorBack("모든 양식을 채워 주세요.");
    }
?>
