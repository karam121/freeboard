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
  $escaped_title = htmlspecialchars($row['title']);
  $list = $list."<li><a href='index.php?id={$row['id']}'>{$escaped_title}</a></li>";
};


$article = array(
  'title'=>'Welcome',
  'description'=>'Hello, Web! Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut e'
);
$update_link = '';
$delete_link = '';
if(isset($_GET['id'])){
 $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
 $sql = "SELECT * FROM topic WHERE id='{$filtered_id}';";
 $result = mysqli_query($conn,$sql);
 $row = mysqli_fetch_array($result);
 $article = array(
   'title'=>htmlspecialchars($row['title']),
   'description'=>htmlspecialchars($row['description'])
 );
 $update_link = '<a href="update.php?id='.$filtered_id.'">수정하기</a>';
 $delete_link = '
 <form action="process_delete.php" method="post">
   <input type="hidden" name="id" value="'.$filtered_id.'">
   <input type="submit" value="삭제하기">
 </form>
 ';
}

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
      <?=$update_link?>
      <?=$delete_link?>
    </p>
    <form action="process_update.php" method="post">
      <p><input type="hidden" name="id" value="<?=$filtered_id?>"</p>
      <p><input type="text" name="title" placeholder="제목을 입력하세요" value="<?=$article['title']?>"></p>
      <p><textarea name="description" cols=70 rows=10 placeholder="내용을 입력하세요"><?=$article['description']?></textarea></p>
      <p><input type=submit value="완료"></p>
    </form>
  </body>
</html>
