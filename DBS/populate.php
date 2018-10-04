<?php
/*
1.file(rows.txt)에서 한 줄씩 읽어서 게시글 테이블에 insert
2.한 줄씩 읽어서 ","를 기준으로 나눈다.
*/
require_once("boardDao.php");
$bdao = new boardDao();

$fname = "./text/populateTest.txt";

$file = fopen($fname, "r");
while (! feof($file)) {

  $data = fgetcsv($file);

  $bdao->insertMsg($data[0], $data[1], $data[2]); //0 제목, 1 작성자, 2내용
}
  fclose($file);

header("Location: board.php");
// $text = file_get_contents($fname);
// foreach (file($fname) as $line){
//     $line = trim($line);
//     $value = explode(',', $line);
//     $bdao->insertMsg($value[0],$value[1],$value[2]);
// }
?>
