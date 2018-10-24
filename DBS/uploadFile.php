<?php
    session_start();
    require_once('./boardDao.php');
    require_once('../tools.php');
    $bdao = new boardDao();
    $id = $_SESSION['id']??'';
    if(!empty($_FILES)){
        // Include the database configuration file
        // File path configuration
        $targetDir = "./uploads/users/".$id."/";
        $fileName = $_FILES['file']['name'];
        $targetFilePath = $targetDir.$fileName;
        $fileSize = intval($_FILES['file']['size']);
        $tempName = iconv("utf-8", "cp949",$_FILES['file']['tmp_name']);
        //$dateTime = date("YmdHis")."_";
        
        if(is_dir($targetDir)){
            if(move_uploaded_file($tempName, $targetFilePath)){         // Upload file to server
              $fileUrl = dirname($targetFilePath)."/".$fileName;
              $bdao->fileupload($fileName, $fileSize, $fileUrl);
             
              // Insert file information in the database      
              //$insert = $db->query("INSERT INTO files (file_name) VALUES ('.$fileName.'");
              }
        }else{
            if(mkdir($targetDir)){
                if(move_uploaded_file($tempName, $targetFilePath)){
                $fileUrl = dirname($targetFilePath)."/".$fileName;
                $bdao->fileupload($fileName, $fileSize, $fileUrl);
            }
        }
    }
}else{
    errorBack("파일업로드가 실패하였습니다.");
}
?>