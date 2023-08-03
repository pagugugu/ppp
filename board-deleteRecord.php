<?PHP
  
include ("./_connShopDB.php");

// GET 변수 가져오기 
$board = $_GET['board']; 
$id    = $_GET['id'];    

$sql = "DELETE FROM $board WHERE id=$id;";
mysqli_query($con, $sql);  
echo("
	<script>
	window.alert('글이 삭제 되었습니다.');
	</script>
");

//JSP – 여기부터 입력하세요
// 삭제된 글보다 글 번호가 큰 게시물은 글 번호를 1씩 감소
$sql = "SELECT id FROM $board ORDER BY id DESC;";
$tmp = mysqli_query($con, $sql);  

// 가장 마지막 글 번호 추출
$row = mysqli_fetch_array($tmp); 
$last = $row['id'];	

$i = $id + 1;       // 삭제된 글의 번호보다 1이 큰 글 번호부터 변경
while($i <= $last):
	$sql = "UPDATE $board SET id=id-1 WHERE id=$i";
	mysqli_query($con, $sql);  
	$i++;
endwhile;
//JSP – 여기까지

mysqli_close($con);  

// 글 삭제 결과를 보여주기 위한 글 목록 보기 프로그램 호출
echo("<meta http-equiv='Refresh' content='0; url=board-show.php?board=$board'>");

?>
