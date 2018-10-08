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
$author_name = '';
if(isset($_GET['id'])){
 $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
 $sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id='{$filtered_id}';";
 $result = mysqli_query($conn,$sql);
 $row = mysqli_fetch_array($result);
 $article = array(
   'title'=>htmlspecialchars($row['title']),
   'description'=>htmlspecialchars($row['description']),
   'name'=>htmlspecialchars($row['name'])
 );
 $update_link = '<a href="update.php?id='.$filtered_id.'">수정하기</a>';
 $delete_link = '
 <form action="process_delete.php" method="post">
   <input type="hidden" name="id" value="'.$filtered_id.'">
   <input type="submit" value="삭제하기">
 </form>
 ';
 $author_name = "by {$article['name']}";
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
    <p><a href="author.php">글쓴이</a></p>
    <ol><?= $list?></ol>
    <p>
      <a href="create.php">글쓰기</a>
      <?=$update_link?>
      <?=$delete_link?>
    </p>
    <h2><?=$article['title'] ?></h2>
    <p><?=$article['description'] ?></p>
    <p><?=$author_name ?></p>
  </body>
</html>
