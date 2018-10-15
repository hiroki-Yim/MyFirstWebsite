<?php
    /*
리스트가 이
전송해서
작성하기 버튼 누를때
파일리스트를 업로드하고
파일명도 db에 올리고
글도 db에 올리고 싶다아니야
    */
    session_start();
    require_once('./boardDao.php');
    $bdao = new boardDao();
    $id = $_SESSION['id']??'';
    if(!empty($_FILES)){
        // Include the database configuration file
        // File path configuration
        $targetDir = "./uploads/";
        $fileName = $_FILES['file']['name'];
        $targetFilePath = $targetDir.$fileName;
        $fileSize = intval($_FILES['file']['size']);
        $tempName = $_FILES['file']['tmp_name'];

        //is_dir($targetDir.$sid."/"){}
        //$id dir upload -> sid(dir) -> file_name 이렇게 하고싶다~ 이말이야

        if(move_uploaded_file($tempName, $targetFilePath)){         // Upload file to server
          $bdao->fileupload($fileName, $fileSize);
        // Insert file information in the database      
        //$insert = $db->query("INSERT INTO files (file_name) VALUES ('.$fileName.'");
        }       
    }

?>