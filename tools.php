<?php  //공통적으로 사용되는 기능들을 묶어서 사용
    function requestValue($name){
      return $_REQUEST[$name]??''; // 변수가 있으면 그 변수를 담고 없으면 빈문자열 넣어줌(에러방지)
    }
    
    function session_exist($param){ //$sid = $_SESSION["id"]??'';
      return $_SESSION[$param]??'';
    }

    function bdUrl($file, $num, $page){
      $join = "?";
      //$url = "DBS/";  // AJAX 통신 Route를 위해 수정함
      if($num){
        $file=$file.$join . "num=$num";
        $join = "&";
      }
      if($page){
        $file=$file.$join . "page=$page";
      }
      return $file;
    }

    function errorBack($msg){
?>
      <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
        </head>
        <body>
          <script>
            alert('<?= $msg ?>');
            history.back();
          </script>
        </body>
      </html>
<?php
    exit(); //위의 결과가 출력되었을 때 더이상 넘어가지 말라는 뜻
    }

    function okGo($msg, $url){
?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
      </head>
      <body>
        <script>
        alert('<?= $msg ?>');
        location.href='<?= $url ?>';  //location $url을 문자열로 return 시켜 url로 이동시킴
        </script>
      </body>
      </html>
<?php
    }
 ?>
