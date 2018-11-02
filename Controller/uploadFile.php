<?php
    session_start();
    require_once("../Model/boardDao.php");
    require_once("../config/tools.php");
    $bdao = new boardDao();
    $id = $_SESSION['id']??'';
    
    if(!empty($_FILES)){
        $ext = explode('.', $_FILES['file']['name']);
        $targetDir = "../uploadedFile/Files/users/".$id."/"; // 파일경로 정의
        $fileName = $_FILES['file']['name'];
        $targetFilePath = $targetDir.$fileName;
        $fileSize = intval($_FILES['file']['size']);
        $tempName = iconv("utf-8", "cp949",$_FILES['file']['tmp_name']);
        //$dateTime = date("YmdHis")."_";
        //이름+date+원본이름 = savename
        //originname 따로저장
        $file_id = md5($tempName);// file id로 저장 - 다운로드 요청시 반환

        if(is_dir($targetDir)){
            if(move_uploaded_file($tempName, $targetFilePath)){         // Upload file to server
              $fileUrl = dirname($targetFilePath)."/".$fileName;
              $bdao->fileupload($fileName, $fileSize, $fileUrl);
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
    errorBack("업로드에 실패하였습니다.");
}
?>