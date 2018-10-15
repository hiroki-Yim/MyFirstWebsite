<?php

class boardDao{
  private $db;  //멤버변수에 접근하기 위해 this키워드 사용, 연결 정보를 갖고 있는 변수
  public function __construct() { //생성자 만듦 -> 생성될 때 자동으로 DB에 연결하기 위해서
    try {
        $this->db = new PDO("mysql:host=localhost;dbname=php", "root", "");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
  }
function insertMsg($title, $writer, $content){  //게시글에 작성된 글을 기반으로 DB에 저장하는 메서드
  try {                                         //(:title)=placeholder 쿼리를 execute하기 전 유동적으로 변할 값에 자리(메모리)지정
  $sql = "insert into board(title, writer, content) values(:title, :writer,  :content)";
  $pstmt = $this->db->prepare($sql);                                // 실행준비된 객체를 가지고 있음 (prepare)
  $pstmt->bindValue(":title", $title, PDO::PARAM_STR);              // 이후 bindValue를 해줌으로서
  $pstmt->bindValue(":writer", $writer, PDO::PARAM_STR);            // 변수  $title을 :title과 같이 사용할 수 있음
  $pstmt->bindValue(":content", $content, PDO::PARAM_STR);          // 자료형에 맞게 PARAM_INT, PARAM_STR 등 지정 해주어야 함
  $pstmt->execute();
  } catch (PDOException $e) {
    exit($e->getMessage());
    }
  }

  function increaseHits($num){  // 조회수 증가 함수
    try {
          $pstmt = $this->db->prepare("update board set hits=hits+1 where num=:num");  // 조회수 증가 쿼리 해당 게시글의 조회수를 1 증가시킴
          $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
          $pstmt->execute();
    } catch (PDOException $e) {
      exit($e->getMessage());
      //ALTER TABLE tmp AUTO_INCREMENT = $num(가장 최근글);, 으로 가장 최근에 생성된 게시 글 번호로 자동 인덱싱을 맞출 수 있음 (글 지워도 최근 글 번호로 $num값 주면 됨)
    }
  }

  function deleteMsg($num){ // 글 삭제 함수
    try {
        $pstmt = $this->db->prepare("delete from board where num=:num");  // 인자로 받은 값(글 번호)를 검색하여 삭제함
        $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
        $pstmt->execute();
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }

  function updateMsg($title, $writer, $content, $num){  //글 수정 시 수정 된 글 업데이트
    try {
        $sql = "update board set title=:title, writer=:writer, content=:content where num=:num";
        $pstmt = $this->db->prepare($sql);
        $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
        $pstmt->bindValue(":title", $title, PDO::PARAM_STR);
        $pstmt->bindValue(":writer", $writer, PDO::PARAM_STR);
        $pstmt->bindValue(":content", $content, PDO::PARAM_STR);
        $pstmt->execute();
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
  }

  function getManyMsgs($start, $rows){
    try {
      $sql = "select * from board order by Regtime desc LIMIT :start, :rows"; //최근 올라온 순으로 정렬하기 위함
      $pstmt = $this->db->prepare($sql);  //필요한 데이터가 없기 때문에 bindValue 해주지 않음

      $pstmt->bindValue(":start", $start, PDO::PARAM_INT);
      $pstmt->bindValue(":rows", $rows, PDO::PARAM_INT);
      $pstmt->execute();  //sql문 실행 -> 결과 집합이 생성 됨

      $msg = $pstmt->fetchAll(PDO::FETCH_ASSOC); //resultset에 있는 모든 결과를 2차원 배열로 받아 옴 = fetchAll
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
    return $msg;
  }

  function getMsg($num){
    try {
          $pstmt = $this->db->prepare("select * from board where num=:num");  //placeholder  //실행준비된 객체를 가지고 있음
          $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
          $pstmt->execute(); //데이터 타입까지 정해주고 실행함
          $result = $pstmt->fetch(PDO::FETCH_ASSOC);  //레코드 하나를 배열로 만들어 줌 FETCH는 하나의 레코드를 1차원 배열로 만듬
                                                      //FETCHALL 하면 전체를 2차원 배열로 만들어줌
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
      return $result;
  }

  function prenex($num){  //게시물의 다음 글과 이전 글을 가져오는 쿼리문
    try {
      $sql ="select * from
            (select Num, Title from board where Num < :num order by Num desc limit 0,1) as q
            union all
            (select Num, Title from board where Num > :num order by Num limit 0,1)";
      // "select * from board where num < :num
      //  UNION ALL (select * from board where num < :num ORDER BY num DESC LIMIT 0,1)
      //  UNION ALL (select * from board where num > :num ORDER BY num ASC LIMIT 0,1)
      //  ORDER BY num DESC LIMIT 1,2";
      $pstmt = $this->db->prepare($sql);
      $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
      $pstmt->execute();
      $prenex = $pstmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
    return $prenex; //이전 글과 다음 글의 정보를 2차원 배열로 만들고 리턴함
  }

  function getNumMsgs(){  // DB에 있는 총 게시글 갯수를 반환함
    try {
      $sql = "select count(*) from board";
      $pstmt = $this->db->prepare($sql);
      $pstmt->execute();
      $totalCount = $pstmt->fetchColumn();  // 하나의 값(테이블 전체 레코드 개수)만 반환되므로, fetchColumn()메서드로 그 값을 읽어 레코드 개수 구함
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
      return $totalCount;
  }

  function fileupload($file_name, $file_size){
    try{
      $sql = "insert files set file_name=:file_name, file_size=:file_size";
      // $sql = "insert into files(file_name, file_size) values(:file_name, :file_size)";
      $pstmt = $this->db->prepare($sql);
      $pstmt->bindValue(":file_name", $file_name, PDO::PARAM_STR);
      $pstmt->bindValue(":file_size", $file_size, PDO::PARAM_INT);
      $pstmt->execute();
    }catch(PDOException $e){
      exit($e->getMessage());
    }
  }



}
?>
