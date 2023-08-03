<?PHP
 
// 꼭 필요한 정보인 $writer, $topic, $content 가 입력되었는지 검사 
include("_board-checkInput.php"); // 게시판의 필수 입력 항목을 검사하는 코드 정의

// MySQL 접속 및 DB 선택
include ("./_connShopDB.php");

// GET 변수 가져오기 
$board  = $_GET['board']; 
$id     = $_GET['id'];    

$sql = "SELECT * FROM $board WHERE id=$id;";
$result = mysqli_query($con, $sql); 

// 기존 필드값을 유지할 항목을 추출함
$row = mysqli_fetch_array($result); 
$space = $row['space'];	 
$hit   = $row['hit'];	

$wdate = date("Y-m-d");	//글 수정한 날짜 저장

// $writer, $topic, $content 이외에 입력된 정보 가져오기 
$email  = $_POST['email']; 
$passwd = $_POST['passwd']; 

// 변경 내용을 테이블에 저장함
$sql = "UPDATE $board SET writer='$writer', email='$email', passwd='$passwd', topic='$topic', content='$content', hit=$hit, wdate='$wdate', space=$space WHERE  id=$id;";
echo $sql;

mysqli_query($con, $sql);  
mysqli_close($con);  

echo("<meta http-equiv='Refresh' content='0; url=board-show.php?board=$board'>");

?>
