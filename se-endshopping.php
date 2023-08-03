<meta charset="UTF-8"/>
<?PHP
include("../common/__showMessage.php");  // 메시지를 보여주고 이전으로 돌아가는 함수 

// 꼭 필요한 정보인 $receiver, $phone, $addr1 이 입력되었는지 검사 
$receiver = $_POST['receiver']; if (!$receiver) __showMessage('수신자 이름이 없습니다. 다시 입력하세요.');
$phone    = $_POST['phone'];    if (!$phone)  __showMessage('수신자의 전화번호가 없습니다. 다시 입력하세요.');
$addr1    = $_POST['addr1'];    if (!$addr1)  __showMessage('배송 주소가 없습니다. 다시 입력하세요.');



include("./_connShopDB.php");  // 수정됨

$buydate = date("Y-m-d H:i:s");	// 구매 날짜 저장

$UserID = $_COOKIE['UserID']; 
//JSP 수정 내용 1) 주문번호를 길게... 날짜만 사용하면 같은 날 두 번 구매 못함
// $ordernum = strtoupper(substr($UserID, 0, 3)) . "-" . substr($buydate, 0, 10); 
$ordernum = strtoupper(substr($UserID, 0, 3)) . "-" . substr(preg_replace("/\s+|:+/", "-", 
$buydate), 0, 22); 

// 다른 정보도 가져와야 함
$Session = $_COOKIE['Session']; 
$UserName = $_COOKIE['UserName']; 
$zip    = $_POST['zip'];
$addr2  = $_POST['addr2'];
$message1 = $_POST['field'];
$message2 = $_POST['message'];

if ($message1 === '직접 입력') {
    $message = $message2;
} else {
    $message = $message1;
}

$address = "(" . $zip .  ")" . "&nbsp;" . $addr1 . "&nbsp;" . $addr2;

// 배송지 주소와 구매 번호를 테이블에 저장
$sql = "insert into   receivers(id, session, sender, receiver, phone, address, message, buydate,   ordernum, status) values ('$UserID', '$Session', '$UserName', '$receiver','$phone', '$address', '$message', '$buydate', '$ordernum', 1)";
mysqli_query($con, $sql);

// 전체 쇼핑백 테이블에서 구매 정보를 읽어내어 복사
$result = mysqli_query($con, "select * from shoppingbag where session='$Session'");
$total = mysqli_num_rows($result);

$counter=0;

while ($counter < $total) :
	$row      = mysqli_fetch_array($result); // 추가됨
	$pcode    = $row['pcode'];    // 수정됨
  $quantity = $row['quantity']; // 수정됨


    $sql = "insert into orderlist(id, session, pcode, quantity, ordernum) values ('$UserID', '$Session', '$pcode','$quantity','$ordernum')";
	mysqli_query($con, $sql); 
	 	 	 
    $counter++;
endwhile;

// 구매 완료한 정보는 쇼핑백 테이블에서 모두 삭제
mysqli_query($con, "delete from shoppingbag where session='$Session'");

mysqli_close($con);	 

$msg = "구매가 정상적으로 처리되었습니다. \\n주문 번호는 ". $ordernum ."이며 My Page에서 주문 조회가 가능합니다.";

echo ("
<script>
 	window.alert('$msg');
</script>
");

echo ("<meta http-equiv='Refresh' content='0; url=p-list.php'>");

?>


