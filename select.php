<?php
$conn = mysqli_connect(
  "localhost",
  "root",
  "858891qq",
  "opentutorials");

// 1 row
echo '<h1>Single row</h1>';
$sql = "SELECT * FROM topic WHERE id = 19 LIMIT 1000;";
$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_array($result);
echo '<h2>'.$row['title'].'</h2>';
echo $row['description'];


// multi rows
echo '<h1>multi row</h1>';
$sql = "SELECT * FROM topic LIMIT 1000;";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)){
  echo "<li><a href=\"index.php?id={$row['title']}\">{$row['title']}</a></li>";
  echo $row['description'];
};
?>
