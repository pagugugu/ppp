<?PHP

include("_board-checkInput.php"); // 게시판의 필수 입력 항목을 검사하는 코드 정의

// MySQL 접속 및 DB 선택
include ("./_connShopDB.php");
 
// 게시판의 테이블 이름을 $_GET 배열에서 가져오기 
$board = $_GET['board']; 

$sql = "SELECT * FROM $board;";
$result = mysqli_query($con, $sql); 
$total = mysqli_num_rows($result); 

// 글에 대한 id부여
if (!$total) 	$id = 1;  
else          $id = $total + 1;

$wdate = date("Y-m-d");	// 글 쓴 날짜 저장

// $writer, $topic, $content 이외에 입력된 정보 가져오기 
$email  = $_POST['email']; 
$passwd = $_POST['passwd']; 

// 테이블에 입력 글 내용을 저장
// $sqlAdd = "INSERT INTO $board VALUES($id, '$writer', '$email', '$passwd', '$topic', '$content', 0, '$wdate', 0);";  // 이것도 가능
 
$sqlAdd = "INSERT INTO $board(id, writer, email, passwd, topic, content, hit, wdate, space) VALUES($id, '$writer', '$email', '$passwd', '$topic', '$content', 0, '$wdate', 0);";

mysqli_query($con, $sqlAdd); 
echo $sqlAdd; 

mysqli_close($con);	// 데이터베이스 연결해제

//board-show.php 프로그램을 호출하면서 테이블 이름을 전달
echo("<meta http-equiv='Refresh' content='0; url=board-show.php?board=$board'>");

?>
