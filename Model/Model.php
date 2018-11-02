<?php 
    class Model{     //공통 함수를 Model에 정의함
        public $db;  //멤버변수에 접근하기 위해 this키워드 사용, 연결 정보를 갖고 있는 변수 //PDO 객체를 저장하기위한 property
        public function __construct() { //생성자 만듦 -> 생성될 때 자동으로 DB에 연결하기 위해서 //php의 생성자는 __construct이다.
          try {
              $this->db = new PDO("mysql:host=localhost;dbname=php", "root", "");
              $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch (PDOException $e) {
              exit($e->getMessage());
          }
        }
    }

?>