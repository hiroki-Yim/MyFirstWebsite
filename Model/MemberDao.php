<?php
  require_once('Model.php');
  class MemberDao extends Model{

    function getMember($option, $id){   //연결정보를 db가 갖고 있으니 사용가능
      try {   //this의 db가 연결정보를 갖고 있으니 prepare로 쿼리문을 db서버에 넘겨줌
        $pstmt = $this->db->prepare("select * from account where ".$option." = :id");  //placeholder  //실행준비된 객체를 가지고 있음
        $pstmt->bindValue(":id", $id, PDO::PARAM_STR);
        $pstmt->execute(); //데이터 타입까지 정해주고 실행함
        $result = $pstmt->fetch(PDO::FETCH_ASSOC);  //레코드 하나를 배열로 만들어 줌 FETCH는 하나의 레코드를 1차원 배열로 만듬
        //FETCHALL 하면 전체를 2차원 배열로 만들어줌
      } catch (PDOException $e) {
        exit($e->getMessage());
      }
      return $result;
    }//end of getMember

    function insertMember($id, $pwd, $name, $mail, $phone, $gender){  // DB에 입력된 정보를 넣는 메서드
      try {
          $sql = "insert into account(id, pwd, name, mail, phone, gender) values(:id, :pwd, :name, :mail, :phone, :gender)";
          $pstmt = $this->db->prepare($sql);
          $pstmt->bindValue(":id", $id, PDO::PARAM_STR);
          $pstmt->bindValue(":pwd", $pwd, PDO::PARAM_STR);
          $pstmt->bindValue(":name", $name, PDO::PARAM_STR);
          $pstmt->bindValue(":mail", $mail, PDO::PARAM_STR);
          $pstmt->bindValue(":phone", $phone, PDO::PARAM_STR);
          $pstmt->bindValue(":gender", $gender, PDO::PARAM_STR);
          $pstmt->execute();
      } catch (PDOException $e) {
        exit($e->getMessage());
      }
    }

    function updateAccount($id, $pwd, $name, $mail, $phone){  // 기존에 DB에 있던 정보를 수정하는 메서드
        try {
          $sql = "update account set pwd=:pwd, name=:name, mail=:mail, phone=:phone where id=:id";
          $pstmt = $this->db->prepare($sql);
          $pstmt->bindValue(":id", $id, PDO::PARAM_STR);
          $pstmt->bindValue(":pwd", $pwd, PDO::PARAM_STR);
          $pstmt->bindValue(":name", $name, PDO::PARAM_STR);
          $pstmt->bindValue(":mail", $mail, PDO::PARAM_STR);
          $pstmt->bindValue(":phone", $phone, PDO::PARAM_STR);
          $pstmt->execute();
        } catch (PDOException $e) {
          exit($e->getMessage());
        }
    }
  }
?>
