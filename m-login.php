<?PHP

include("../common/__showMessage.php");  // 수정됨
include("_connShopDB.php");  // 수정됨

// POST 변수 가져오기
$uid   = $_POST['uid'];   //추가됨
$upass = $_POST['upass']; //추가됨
$sql = "select * from members where uid='$uid'";
//echo $sql;
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);

if (!$total)
	 __showMessage('아이디가 존재하지 않습니다');
else {
	$row      = mysqli_fetch_array($result); // 추가됨
	$pass     = $row['upass'];	  // 수정됨
	$uname    = $row['uname'];	  // 수정됨
	$approved = $row['approved']; // 수정됨

	if ($approved == 0) 
		 __showMessage('관리자의 회원 승인이 완료되지 않았습니다');		
	if ($pass != $upass) {
		//echo "<br/>ID: " . $uid . " 입력 PW: " . $upass . "<br/> DB: " . $uname . "와 " . $pass; 
		__showMessage('비밀번호가 맞지 않습니다.');
	}
	else {
		// 만료 시간을 0으로 하면 브라우저 닫을 때까지 유지
		// time()+1800 은 30분임. 초단위로 설정
		SetCookie("UserID", "$uid", time()+1800); // 15장: 쿠키 변수 설정
		SetCookie("UserName", "$uname", time()+1800); // 15장. 쿠키 변수 설정

		$session = md5(uniqid(rand()));  //16장. 쇼핑백 
		SetCookie("Session", $session, time()+1800); //16장. 쇼핑백 
		mysqli_query($con, "delete from shoppingbag where id='$uid'");  //16장. 쇼핑백	
			 
		echo   ("<meta http-equiv='Refresh' content='0; url=index.html'>");  // 20장. index.html로 수정됨
	}
}
mysqli_close($con);

?>