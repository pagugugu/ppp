<?php include ('_top.html'); ?>
<div>
<?php
include ("./_connShopDB.php");

// GET 변수 가져오기
$board = $_GET['board']; // 테이블 이름
$id    = $_GET['id'];    // 게시판 글의 id

$sql = "SELECT * FROM $board WHERE id=$id;";
$result = mysqli_query($con, $sql);

// 각 필드에 해당하는 데이터를 뽑아내는 과정
$row = mysqli_fetch_array($result);
$id      = $row['id'];
$writer  = $row['writer'];
$topic   = $row['topic'];
$hit     = $row['hit'];
$wdate   = $row['wdate'];
$email   = $row['email'];
$content = $row['content'];
$category = $row['category'];

$hit = $hit + 1;   // 조회수를 하나 증가
$sql = "UPDATE $board SET hit=$hit WHERE id=$id;";
mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>게시판</title>

  <style>
   body {
      margin-bottom: 40px;
      margin-right: 315px;
      margin-left: 315px;
      background-color: #ffffff;
   }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
     margin-top: 90px;
     margin-bottom: 100px;
     text-align: center;
    }

    h1 {
      font-size: 24px;
      margin-bottom: 30px;
     text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 50px;
    }

    th, td {
      padding: 10px;
      border: 1px solid #737373;
     text-align: center;
    }
   td a {
      color: black;
      text-decoration: none;
   }

   td a:hover {
      color: #ccc;
   }

    th {
      background-color: #f7f7f7;
      text-align: left;
    }

    .left {
      text-align: left;
    }

    pre {
      font-size: 15px;
      white-space: pre-wrap;
    }

    .button {
      display: inline-block;
      padding: 10px 20px;
      margin-right: 10px;
      background-color: black;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
    }

    .button:hover {
      background-color: #404040;
    }

    .link {
      color: #337ab7;
      text-decoration: none;
    }

   .ce {
      text-align: center;
   }   

  </style>
</head>

<body>
<div class="container">
  <h1>게시판</h1>

  <table>
    <tr>
      <th class="ce">번호</th>
      <th class="ce">글쓴이</th>
     <th class="ce">카테고리</th>
      <th class="ce">글쓴날짜</th>
      <th class="ce">조회</th>
    </tr>
    <tr>
      <td><?= $id ?></td>
      <td><a href="mailto:<?= $email ?>"><?= $writer ?></a></td>
     <td><?= $category ?></td>
      <td><?= $wdate ?></td>
      <td><?= $hit ?></td>
    </tr>
    <tr>
      <td colspan="5" class="left">제목: <?= $topic ?></td>
    </tr>
    <tr>
      <td colspan="5" class="left"><pre><?= $content ?></pre></td>
    </tr>
  </table>

  <div class="bottom">
    <a href="board-inputPasswd.php?board=<?= $board ?>&id=<?= $id ?>&mode=0" class="button">수정</a>
    <a href="board-inputPasswd.php?board=<?= $board ?>&id=<?= $id ?>&mode=1" class="button">삭제</a>
    <a href="board-replyForm.php?board=<?= $board ?>&id=<?= $id ?>" class="button">답변</a>
    <a href="board-show.php?board=<?= $board ?>" class="button">리스트</a>
  </div>
</div>
</body>
</html>

</div>
<?php include ('_bottomt.html'); ?>