<?php
session_start();
require_once("../tools.php");
require_once("boardDao.php");
$bdao = new boardDao();
$sid = $_SESSION["id"]??'';                          // 세션 아이디를 변수로 저장

if(!$sid){
  errorBack("로그인 한 사용자만 글을 쓸 수 있습니다."); // 로그인을 하지 않은 사용자는 글 작성을 하지 못하게 막음
}else{
  $writer = $sid;                                    // 로그인을 했다면 게시글의 작성자를 현재 접속한 사람 session id로 저장함
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>게시글 작성 페이지</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/write_modify.css">
  <!-- include libraries(jQuery, bootstrap) 라이브러리 적용 -->
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

  <script src="../js/dropzone.js"></script>
  <link rel="stylesheet" href="./css/dropzone.css">

  <!-- include summernote css/js SmartEditor-SUMMERNOTE-서버에서 CSS,JS 가져와서 적용함(CDN) -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

</head>
  <body>
    <div class="wrapper">
      <form action="write.php" method="post" class="form" enctype="multipart/form-data">
        <!-- id가 label값, name이 php REQUEST값, value가 진짜 값 -->
        <input type="hidden" class="form-control" name="writer" value="<?= $writer ?>"> <!-- 작성자값을 보내긴 해야하는데 값이 보이면 안되니까 숨김
                                                            작성자의 기본 전달값을 작성자로 설정 -->
        <div class="form-group">
          <h2><label for="title" class="wrapper">WRITE_FORM</label></h2>
          <input type="text" class="form-control" name="title" placeholder="TITLE">
        </div>
 
        <div class="dropzone" id="fileDropzone" name="file">
        </div>

        <div class="form-group">
             <textarea id="summernote" name="content" rows="8"></textarea>
          <!-- <button type="submit" class="btn btn-primary">작성하기</button> -->
          <input type="submit" id="startUpload" class="btn btn-primary" value="작성하기" />
          <button type="button" class="btn btn-danger" onclick="location.href='board.php'">목록보기</button>
        </div>
        
      </form>
    </div>

    <script>
    $('#summernote').summernote({  //스마트 에디터 summernote탑재 그리고 에디터 기본 UI설정
      height: 300,                 // set editor height
      minHeight: null,             // set minimum height of editor
      maxHeight: null,             // set maximum height of editor
      focus: true,                 // set focus to editable area after initializing summernote
      placeholder: "CONTENT"
    });    
    </script>

    <script>
    // autoDiscover를 사용하지 않도록 설정합니다. 
Dropzone.autoDiscover = false;

$(function() {
    //Dropzone class
    var myDropzone = new Dropzone(".dropzone", {
		url: "./uploadFile.php",
		paramName: "file",
		maxFilesize: 2000,
		maxFiles: 10,
		acceptedFiles: "image/*,application/pdf,*",
		autoProcessQueue: false
	});
  $('#startUpload').click(function(){           
        myDropzone.processQueue();
  });
});

    </script>

  </body>
</html>

