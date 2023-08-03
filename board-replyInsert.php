<?PHP

include("_board-checkInput.php"); // 게시판의 필수 입력 항목을 검사하는 코드 정의

include ("./_connShopDB.php");

// GET 변수 가져오기 
$board = $_GET['board']; 
$id =    $_GET['id']; 

// 답변 글은 원본 글보다 깊이가 1 증가됨
$sql = "SELECT space FROM $board WHERE id=$id;";
$result = mysqli_query($con, $sql); 

$row = mysqli_fetch_array($result); 
$space = $row['space'];	 
$space=$space+1; // 깊이 증가

$wdate=date("Y-m-d"); // 단변 글을 쓴 날짜 저장

// 답변글이 추가되면 글의 개수가 하나 증가하므로 글 번호를 정리
$tmp = mysqli_query($con, "SELECT id FROM $board;");
$total = mysqli_num_rows($tmp); 

while($total >= $id):
	mysqli_query($con, "UPDATE $board SET id=id+1 WHERE id=$total;"); 
	$total--;
endwhile;

$email = $_POST['email']; 
$passwd = $_POST['passwd']; 

// 원래 글 번호 위치에 답변 글을 삽입함
$sqlAdd = "INSERT INTO  $board(id, writer, email, passwd, topic, content, hit, wdate, space) VALUES ($id, '$writer', '$email', '$passwd', '$topic','$content', 0, '$wdate',   $space);";

echo $sqlAdd;
mysqli_query($con, $sqlAdd); 
mysqli_close($con); 

echo("<meta http-equiv='Refresh' content='0; url=board-show.php?board=$board'>");
?>
