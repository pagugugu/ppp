<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>주문 상세 정보</title>

  <style>
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
  font-size: 14px;
}

caption {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}
tr {
	text-align: center;
}

th, td {
  padding: 8px;
  text-align: center;
  border: 1px solid gray; 
}

th {
  background-color: #f2f2f2;
  text-align: center;
}

.bgPink {
  background-color: pink;
}

.bgIvory {
  background-color: ivory;
}

.right {
  text-align: right;
}

.left {
  text-align: left;
}

.center {
	text-align: center;
}
.min {
	background-color: #f8f8f8;
}


</style>
</head>

<body class='members'>

<?PHP
  
include("./_connShopDB.php");  // 수정됨

$ordernum = $_GET['ordernum'];
$result = mysqli_query($con, "select * from receivers where ordernum='$ordernum'");
$total = mysqli_num_rows($result);

$row = mysqli_fetch_array($result); // 추가됨
$session  = $row['session'];  // 수정됨
$sender   = $row['sender'];	  // 수정됨
$receiver = $row['receiver']; // 수정됨
$phone    = $row['phone'];	  // 수정됨
$address  = $row['address'];  // 수정됨
$message  = $row['message'];  // 수정됨
$buydate  = $row['buydate'];  // 수정됨
$status   = $row['status'];	  // 수정됨
	 
switch ($status) {
		  case 1: $status = "주문신청"; break;
		  case 2: $status = "주문접수";  break;
		  case 3: $status = "배송준비중"; break;
		  case 4: $status = "배송중";   break;
		  case 5: $status = "배송완료";  break;
		  case 6: $status = "구매완료"; break;
		}

// JSP 수정 내용: 주문 번호로 orderlist 검색함
//$subresult = mysqli_query($con, "select * from orderlist where session='$session'");
$subresult = mysqli_query($con, "select * from orderlist where ordernum='$ordernum'");

$subtotal = mysqli_num_rows($subresult);

?>

<table class='border1' align='center'>
<caption>주문 상세 정보</caption> 
<tr><th> 주문 번호 </th><td ><?=$ordernum?></td>
    <th> 주문 상태 </th><td ><?= $status ?></td>
    <th> 주문 일시 </th><td ><?= $buydate ?></td> </tr>

<tr><td colspan='3' class="min"> 상품 이름 </td>
<td class="min">수량</td>
<td class="min">단가</td>
<td class="min">금액</td></tr>

<?PHP
$subcounter=0;
$totalprice=0;
          
while ($subcounter < $subtotal) :
  $subRow   = mysqli_fetch_array($subresult); // 추가됨
	$pcode    = $subRow['pcode'];	  // 수정됨
	$quantity = $subRow['quantity'];  // 수정됨
	   
	$tmpresult = mysqli_query($con, "select * from product where code='$pcode'");
  $tmpRow    = mysqli_fetch_array($tmpresult); // 추가됨
	$pname     = $tmpRow['name'];	// 수정됨
	$price     = $tmpRow['price2'];	// 수정됨
		   
	$subtotalprice = $quantity * $price;
	$totalprice = $totalprice + $subtotalprice;

		$deliprice = 0;

		if ($totalprice >= 50000) {
			$deliprice = 0;
		} else {
			$deliprice = 2500;
		}

		$totalpay = $totalprice + $deliprice;


?>	
	<tr'><td colspan='3' class="left"><?=$pname?></td>
	<td><?=$quantity?></td>
	<td class='right'><?=$price?></td>
	<td class='right'><?=$subtotalprice?></td>
	</tr>

<?PHP
     $subcounter++;
endwhile;
mysqli_close($con);

?>	

<tr><th >배송비</th><td colspan='5' class='right'><strong><?= $deliprice ?></strong></td>
<tr><th >주문 총 금액</th><td colspan='5' class='right'><strong><?= $totalprice ?></strong></td>
</tr>
</table>

<br/>
<table class='border1' align='center'>
  <caption>배송 정보</caption>
  <tr><th>주문자 이름</th><th class="center">수신자 이름</th><th>수신 주소</th><th>수신자 연락처</th></tr>
  <tr><td><?= $sender ?></td>
  <td><?= $receiver ?></td>
  <td><?= $address ?></td>
  <td><?= $phone ?></td></tr>
  <tr><th>주문 메시지</th>
	<td class='left' colspan='3'> <?= $message ?></td></tr>
</table>
