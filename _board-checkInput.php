<?PHP
// 게시판 입력 검사 파일
// 꼭 필요한 정보인 $writer, $topic, $content 가 입력되었는지 검사 

// board-insertRecord.php, board-updateRecord.php, board-replyInsert.php 에서 공통으로 사용하는 코드
// 해당 부분에서 include("_board-checkInput.php");  하면 됨

include("../common/__showMessage.php");  // 메시지를 보여주고 이전으로 돌아가는 함수 
 
// 꼭 필요한 정보인 $writer, $topic, $content 가 입력되었는지 검사 
$writer  = $_POST['writer'];  if (!$writer)  __showMessage("이름이 없습니다. 다시 입력하세요");
$topic   = $_POST['topic'];   if (!$topic)   __showMessage("제목이 없습니다. 다시 입력하세요");
$content = $_POST['content']; if (!$content) __showMessage("내용이 없습니다. 다시 입력하세요");
?>

<?PHP
/*
if (!$writer){
	echo("
		<script>
		window.alert('이름이 없습니다. 다시 입력하세요')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$topic){
	echo("
		<script>
		window.alert('제목이 없습니다. 다시 입력하세요')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$content){
	echo("
		<script>
		window.alert('내용이 없습니다. 다시 입력하세요')
		history.go(-1)
		</script>
	");
	exit;
}
*/
?>