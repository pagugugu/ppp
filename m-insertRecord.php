<?PHP

include ("_checkResisterMembers.php"); // 변경됨

include("./_connShopDB.php");  // 수정됨

$mphone = $_POST['mphone']; //  추가됨
$email  = $_POST['email'];  //  추가됨
$zip    = $_POST['zip'];    //  추가됨
$addr1  = $_POST['addr1'];  //  추가됨
$addr2  = $_POST['addr2'];  //  추가됨
$sql = "insert into members(uid, upass,uname, mphone, email, zipcode, addr1, addr2, approved) values ('$uid', '$upass1', '$uname', '$mphone', '$email', '$zip', '$addr1', '$addr2', 0)";
//echo $sql; 
$result = mysqli_query($con, $sql); // 수정됨
mysqli_close($con);
	
if ($result) {
	$msg = "JNU Online Bookstore 회원 가입을 축하드립니다.\\n관리자의 승인을 거쳐야 로그인이 가능합니다.";
    echo ("
	    <script>
		  window.alert('$msg');
		  history.go(1);
		</script>
    ");
} 
else 
{
    echo ("<script>
       		window.alert('회원가입에 실패했습니다. 다시 한 번 시도해 주세요');
      		history.go(-1);
      		</script>
    ");
}
	
echo   ("<meta http-equiv='Refresh' content='0; url=index.html'>");
//echo   ("<meta http-equiv='Refresh' content='0; url=left.html'>");
	
?>

