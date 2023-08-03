<meta charset="UTF-8"/>
<?PHP

// POST 변수 가져오기
$uname = $_POST['uname'];  // 추가됨
$uid   = $_POST['uid'];    // 추가됨
$email = $_POST['email'];  // 추가됨
   
include("./_connShopDB.php");  // 수정됨

$result = mysqli_query($con, "select * from members where uname='$uname' and uid='$uid' and email='$email'");
$total = mysqli_num_rows($result);

if (!$total)   {
   echo("
      <script>
      window.alert('입력하신 아이디와 이름과 이메일 주소를 동시에 만족하는 사용자 아이디가 없습니다.');
      history.go(-1);
      </script>
   ");
   exit;
} else {
	$row = mysqli_fetch_array($result); // 추가됨
	$upass = $row['upass'];  // 수정됨...	$upass = mysqli_result($result, 0, "upass");
   echo("
      <script>
      window.alert('귀하의 비밀번호는 $upass 입니다.');
      </script>
   ");
}

mysqli_close($con);	
echo   ("<meta http-equiv='Refresh' content='0; url=m-loginForm.html'>");  // 수정됨

?>
