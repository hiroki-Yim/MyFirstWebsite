<?php  //공통적으로 사용되는 기능들을 묶어서 사용
    define("MAIN_PAGE", "login_main.php");  //메인 홈페이지 상수로 사용 코드의 재활용을 위해
    define("NUM_LINES", 5); // 한 페이지에 출력할 게시글 수
    define("NUM_PAGE_LINKS", 7); // 한 페이지에 출력할 페이지 링크 수

    function requestValue($name){
      return $_REQUEST[$name]??''; // 변수가 있으면 그 변수를 담고 없으면 빈문자열 넣어줌(에러방지)
    }

    function bdUrl($file, $num, $page){
      $join = "?";
      if($num){
        $file .= $join . "num=$num";
        $join = "&";
      }
      if($page){
        $file .=  $join . "page=$page";
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
