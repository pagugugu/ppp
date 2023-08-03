<?PHP
include('../common/__showMessage.php');  //메시지 출력
   
if (isset($_COOKIE['UserID'])) $UserID = $_COOKIE['UserID']; 
else	$UserID = "";
if ($UserID=="")  __showMessage('로그인 사용자만 구매 가능합니다');
 
if (isset($_POST['quantity']))	 {
	$quantity = $_POST['quantity'];
	if ($quantity < 1 || $quantity > 100)  __showMessage('변경하고자 하는 수량이 범위를 초과합니다');
}
else  $quantity = 1; 

$Session = $_COOKIE['Session'];  // 쿠키 변수에서 가져옴
$code = $_GET['code'];  // 주소줄에 전달되므로 GET 변수 가져옴

include("./_connShopDB.php");  // 수정됨

// 쇼핑백 테이블에서 상품 코드와 세션에 해당하는 레코드 검색
$sql = "select * from shoppingbag where session='$Session' and pcode='$code'";
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);

if ($total) {  // 이미 쇼핑백에 담은 물건이면 수량을 추가하여 업데이트
	$row = mysqli_fetch_array($result); // 추가됨
	$oldnum = $row['quantity'];  //   수정됨
    $quantity = $oldnum + $quantity;
	$sql = "update shoppingbag set quantity=$quantity where session='$Session' and pcode='$code'";
    mysqli_query($con, $sql);
} 
else { // 쇼핑백에 없으면 새로운 레코드 추가 
	$sql = "insert into shoppingbag(id, session, pcode, quantity) values ('$UserID','$Session', '$code', $quantity)";
    mysqli_query($con, $sql);
}

mysqli_close($con);	//데이터베이스 연결해제
echo ("<meta http-equiv='Refresh' content='0; url=sb-showbag.php'>");
?>