<?php
$conn = mysqli_connect(
  "localhost",
  "root",
  "858891qq",
  "opentutorials"
);
$filtered = array(
  'name' => mysqli_real_escape_string($conn,$_POST['name']),
  'profile' => mysqli_real_escape_string($conn,$_POST['profile'])
);

$sql = "
  INSERT INTO author
    (name, profile)
  VALUE(
    '{$filtered['name']}',
    '{$filtered['profile']}'
  )
";
$result = mysqli_query($conn, $sql);
if (!$result){
  echo '처리하는 과정에서 문제가 발생하였습니다. 관리자에게 문의하세요.
  <p><a href="author.php">글쓴이 페이지로 돌아가기</a></p>
  ';
  error_log(mysqli_error($conn));
} else {
  header("Location: author.php");
};

 ?>
