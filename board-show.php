<?php include ('_top.html'); ?>
<div>

<?php
// 게시판 이름을 GET 변수에서 가져오기 
$board = $_GET['board']; 
?>

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

    * {
      box-sizing: border-box;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #f5f5f5;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	  margin-top: 90px;
	  margin-bottom: 100px;
    }

    h1 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
	  text-align: center;
    }

    .search-form {
      margin-bottom: 20px;
	  display: flex;
	  justify-content: flex-end;
    }

    .search-form select,
    .search-form input[type="text"],
    .search-form input[type="submit"] {
      padding: 10px;
      font-size: 16px;
      border: none;
    }

    .search-form select {
      margin-right: 10px;
    }

    .search-form input[type="text"] {
      width: 200px;
    }

    .search-form input[type="submit"] {
      background-color: #333;
      color: #fff;
      cursor: pointer;
    }

    .board {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .board th,
    .board td {
      padding: 10px;
      border-bottom: 1px solid #ccc;
      text-align: center;
	  background-color: #fff;
    }

    .board th {
      background-color: #333;
      color: #fff;
      font-weight: bold;
    }
	.board td a {
    color: #000;
    text-decoration: none;
  }
  .board td a:hover {
    color: gray;
    text-decoration: none;
  }

    .board .right {
      text-align: right;
    }

    .pagination {
      text-align: center;
    }

    .pagination a {
      display: inline-block;
      padding: 5px 10px;
      margin-right: 5px;
      text-decoration: none;
      background-color: #333;
      color: #fff;
    }

    .pagination a:hover {
      background-color: #666;
    }

	.write-button-container {
		position: relative;
		top: 45px;
		width: 100px;
	}

	.write-button {
    display: inline-block;
    padding: 10px 15px;
    background-color: #000;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
  }

  .write-button:hover {
    background-color: #333; }
  </style>
</head>

<body>
  <div class="container">
    <h1>게시판</h1>
	 <div class="write-button-container">
      <a href="board-inputForm.php?board=<?=$board?>" class="write-button">쓰기</a>
    </div>

    <form class="search-form" method='post' action='board-searchNShow.php?board=<?= $board ?>'>
      <select name='field'>
        <option value='writer'>글쓴이</option>
        <option value='topic'>제목</option>
        <option value='content'>내용</option>
      </select>
      <input type='text' name='key' placeholder="검색어를 입력하세요">
      <input type='submit' value='찾기'>
    </form>

	

    <table class='board'>
      <tr>
        <th>번호</th>
        <th>글쓴이</th>
        <th>제목</th>
        <th>날짜</th>
        <th>조회</th>
      </tr>

      <?php
      include ("./_connShopDB.php");
      include ("./_board-displayRecord.php");

      $sql = "SELECT * FROM $board ORDER BY id DESC;";
      $result = mysqli_query($con, $sql);
      $total = mysqli_num_rows($result);

      if (!$total) {
        mysqli_close($con);
        echo("<tr><td colspan='5'>아직 등록된 글이 없습니다.</td></tr></table></body></html>");
        exit;
      }

      $pagesize = 4;
      $totalpage = (int)($total / $pagesize);
      if (($total % $pagesize) != 0) $totalpage = $totalpage + 1;

      if (isset($_GET['cpage'])) $cpage = $_GET['cpage'];
      else $cpage = 1;

      $index = ($cpage - 1) * $pagesize;
      mysqli_data_seek($result, $index);

      $counter = 0;
      while ($counter < $pagesize):
        if ($index == $total) break;

        displayRecord($counter, $result, $board);

        $counter++;
        $index++;
      endwhile;

      mysqli_close($con);
      ?>
    </table>

    <div class="pagination">
      <?php
      if (isset($_GET['cblock'])) $cblock = $_GET['cblock'];
      else $cblock = 1;

      $blocksize = 3;
      $pblock = $cblock - 1;
      $nblock = $cblock + 1;
      $startpage = ($cblock - 1) * $blocksize + 1;
      $pstartpage = $startpage - 1;
      $nstartpage = $startpage + $blocksize;

      if ($pblock > 0) {
        echo ("<a href='board-show.php?board=$board&cblock=$pblock&cpage=$pstartpage'>이전블록</a>");
      }

      $i = $startpage;
      while ($i < $nstartpage) {
        if ($i > $totalpage) break;
        echo ("<a href='board-show.php?board=$board&cblock=$cblock&cpage=$i'>$i</a>");
        $i = $i + 1;
      }

      if ($nstartpage <= $totalpage) {
        echo ("<a href='board-show.php?board=$board&cblock=$nblock&cpage=$nstartpage'>다음블록</a>");
      }
      ?>
    </div>
  </div>
</body>
</html>

</div>
<?PHP include ('_bottomt.html'); ?>