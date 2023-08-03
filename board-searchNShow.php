<?PHP include ('_top.html'); ?>
<div>


<?PHP

// 검색 관련 사용자 입력 값 가져오기 
// JPS: 여기부터 입력하세요.
$key   = $_POST['key'];   // 검색어 
$field = $_POST['field']; // 검색 필드
// JPS: 여기까지 입력하세요.

if (!$key) {
  echo("<script>
   window.alert('검색어를 입력하세요');
   history.go(-1);
  </script>");
  exit;
}

include ("./_connShopDB.php");
include ("./_board-displayRecord.php");  // 레코드를 추출하여 테이블에 출력하는 함수

// JPS: 여기부터 입력하세요.
$board = $_GET['board']; // 테이블 이름 가져오기
$sql = "SELECT * FROM $board WHERE $field LIKE '%$key%' ORDER BY id DESC;";  
// JPS: 여기까지 입력하세요.

$result = mysqli_query($con, $sql); 
$total  = mysqli_num_rows($result);

?>

<HTML html>
<head>
  <meta charset="UTF-8"/>   
  <title>게시판</title>


  <style>
body {
		margin-bottom: 40px;
		margin-right: 315px;
		margin-left: 315px;
	}
	* {
      box-sizing: border-box;
    }
  	h2 {
		text-align: center;
		margin-bottom: 60px;
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
	.br-button {
    display: inline-block;
    padding: 10px 15px;
    background-color: #000;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
  }

  .br-button:hover {
    background-color: #333; }
	.br-button td a {
		text-decoration: none;
      color: white;
	}
	.loc_button {
		position: relative;
		left: 468px;
		top: -5px;
	}
	.blue  { color: blue; }
	.left  { text-align: left;  }
	.right { text-align: right; }

  </style>

</head>

<body>
<div class="container">
<h2>게시판</h2>
	<table>
  <tr class='top'><td class='left'>검색어: <span class='blue'><?=$key?></span>, 
	찾은 개수: <span class='blue'><?=$total?></span>개</td>
  <td class='loc_button'><a href='board-show.php?board=<?=$board?>' class="br-button">전체목록</a></td></tr>
  </table>

	<table class='board'>
  <tr><th>번호</th>
	    <th>글쓴이</th>
			<th width='450'>제목</th>
			<th>날짜</th>
			<th>조회</th>
	</tr>

<?PHP

  if (!$total){
    mysqli_close($con); 
    echo("<tr><td colspan='5'>아직 등록된 글이 없습니다.</td></tr></table></body></html>");
    exit;  
  } 

  $counter=0;
  while($counter < $total):
    displayRecord($counter, $result, $board); 
		   // $board 테이블에서 추출한 $result에서 $counter 번째 레코드를 추출하여 테이블에 출력하는 함수
    $counter++;
  endwhile;

  mysqli_close($con); 
?>
</div>
</table>
</body>
</html>

</div>
<?PHP include ('_bottomt.html'); ?>