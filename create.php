<?php
$conn = mysqli_connect(
  "localhost",
  "root",
  "858891qq",
  "opentutorials");

$sql = "SELECT * FROM topic LIMIT 1000;";
$result = mysqli_query($conn,$sql);
$list = '';
while($row = mysqli_fetch_array($result)){
  $list = $list."<li><a href='index.php?id={$row['id']}'>{$row['title']}</a></li>";
};

$sql = "SELECT * FROM author";
$result = mysqli_query($conn,$sql);
$select_form = '<select name = "author_id">';
while($row = mysqli_fetch_array($result)){
  $select_form .= "<option value='{$row['id']}'>{$row['name']}</option>";

};
$select_form .= '</select>';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <h1><a href="index.php">WEB</a></h1>
    <ol><?= $list?></ol>
    <p>
      <a href="create.php">글쓰기</a>
      <a href="update.php">수정하기</a>
    </p>
    <form action="process_create.php" method="post">
      <p><input type="text" name="title" placeholder="제목을 입력하세요"></p>
      <p><textarea name="description" cols=70 rows=10 placeholder="내용을 입력하세요"></textarea></p>
      <p><?=$select_form?></p>
      <p><input type=submit value="완료"></p>
    </form>
  </body>
</html>
