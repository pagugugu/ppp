<meta charset="UTF-8"/>

<?PHP
   
include("../common/__showMessage.php");  // 수정됨
include("./_connShopDB.php");  // 수정됨

// GET 변수 가져오기
$uid = $_GET['uid']; //추가됨

//주의: members 테이블에서 검색함
$result = mysqli_query($con, "select approved from members where uid='$uid'");
$total = mysqli_num_rows($result);

if ($total > 0) {
	$row = mysqli_fetch_array($result); // 추가됨
	$status = $row['approved']; // 수정됨...
	if ($status == 0) $status = 1;
	else $status = 0;
} 
else 
	__showMessage('회원 정보 조회에 실패했습니다');

//주의: members 테이블에서 검색함
$result = mysqli_query($con, "update members set approved=$status where uid='$uid'");

if ($result) {
	switch ($status) {
		case   1:
			echo ("<script>
				  window.alert('승인이 완료되었습니다');
				  history.go(1);
				  </script>");
			break;
		case 0:
			echo ("<script>
				  window.alert('대기 상태로 변경합니다');
				  history.go(1);
				  </script>");
			break;	
	}
} 
else __showMessage('회원 상태 변경에 실패했습니다');
	
mysqli_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=admin-showMemberList.php'>");

?>
