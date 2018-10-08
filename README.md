# freeboard
The website I made for the first time
<?php
$conn = mysqli_connect(
  "localhost",
  "root",
  "858891qq",
  "opentutorials");

$sql = "SELECT * FROM author LIMIT 1000";
$result = mysqli_query($conn,$sql);

// 글쓴이 목록 생성
$author_list = '
  <table  border=1>
    <tr>
      <td>id</td><td>이름</td><td>프로필</td>
    </tr>
      ';

while($row = mysqli_fetch_array($result)){
  $filtered = array(
    'id' => htmlspecialchars($row['id']),
    'name' => htmlspecialchars($row['name']),
    'profile' => htmlspecialchars($row['profile'])
  );
  $author_list .= "<tr>
    <td>{$filtered['id']}</td>
    <td>{$filtered['name']}</td>
    <td>{$filtered['profile']}</td>
    <td>
      <a href='author.php?id={$filtered['id']}'>수정</a>
    </td>
    <td>
      <form action = 'process_delete_author.php' method = 'post'
      onsubmit=\"if(!confirm('정말로 삭제하시겠습니까?')){return false;}\">
        <input type='hidden' name='id' value='{$filtered['id']}'>
        <input type='submit' value='삭제'>
      </form>
    </td>
    ";
};
$author_list .= '</table>';

// 글쓴이 정보 업데이트 하기
$escaped = array(
  'name' => '',
  'profile' => ''
);
$label_submit = 'create author';
$form_action = 'process_create_author.php';
$form_id = '';
if(isset($_GET['id'])){
  $filtered_id = mysqli_real_escape_string($conn,$_GET['id']);
  settype($filtered_id,'integer');
  $sql = "SELECT * FROM author WHERE id={$filtered_id}";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $escaped['name'] = htmlspecialchars($row['name']);
  $escaped['profile'] = htmlspecialchars($row['profile']);
  $label_submit = 'update author';
  $form_action = 'process_update_author.php';
  $form_id = "<input type='hidden' name='id' value={$filtered_id}>";

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
    <p><a href="index.php">게시글 보기</a></p>
    <?=$author_list?>
    <br>
    <p>글쓴이 생성하기</p>
    <form action=<?=$form_action?> method="post">
      <p><?= $form_id ?></p>
      <p><input type="text" name="name" placeholder="글쓴이명" value="<?=$escaped['name']?>"></p>
      <p><input type="text" name="profile" placeholder="프로필" value="<?=$escaped['profile']?>"></p>
      <p><input type="submit" value="<?=$label_submit?>"></p>

    </form>
  </body>
</html>
