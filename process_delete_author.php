<?php
$conn = mysqli_connect(
 "localhost",
 "root",
 "858891qq",
 "opentutorials"
);

settype($_POST['id'],'integer');
$filtered = array(
  'id'=>mysqli_real_escape_string($conn,$_POST['id']),
);

//글쓴이를 지우기 전 글쓴이가 작성한 글을 지우기
$sql = "
  DELETE FROM topic
  WHERE author_id = {$filtered['id']}
";
mysqli_query($conn,$sql);

//글쓴이를 삭제하기
$sql = "
  DELETE FROM author
  WHERE id = {$filtered['id']}
";
$result = mysqli_query($conn,$sql);

if(!$result){
  echo "처리과정에서 문제가 발생하였습니다. 관리자에게 문의해주세요.
  <p><a href=\"index.php\">홈으로 돌아가기</a></p>
  ";
  error_log(mysqli_error($conn));
} else{
  header("Location: author.php");
}
?>
