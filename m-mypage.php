<?PHP include ('_top.html'); ?>
      <div>
<head>
<style>
	body {
		margin-bottom: 40px;
		margin-right: 315px;
		margin-left: 315px;
		background-color: #ffffff;
	}

 table    { 
	width: 700px; 
	border: 0; 
	line-height: 25px; 
	border-collapse: collapse; 
	text-align: left;  
	border-bottom: 1px solid white; 
	margin: 0 auto;
	}  
th   {
	border-bottom: 1px solid gray;
	text-align: center;
	background-color: #000000;
	color: white;
	padding-top: 5px;
    padding-bottom: 5px;
	}
 td   { 
 	padding-top: 5x;
    padding-bottom: 5px;
	border-bottom: 1px solid gray; 
	padding-left: 10px;
	}   
caption  {
	font-size: 20px; 
	font-weight: bold;  
	margin: 15px 0 15px 0; 
	}
.myinfo {
	margin-top: 90px;
}
.buyinfo {
	margin-bottom: 100px;
	text-align: center;
}
.top_right {
	text-align: right;
	line-height: 25px; 
} 
.infos {
	padding-bottom: 10px;
}
.left {
	text-align: left;
}
	.button {
    display: inline-block;
    padding: 6px;
    background-color: #000;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
  }
  .button:hover {
	background-color: #727272;
  }
  .cancel {
	text-decoration: none;
	font-size: 13px;
  }
  .cancel:hover {
	color: red;
  }


</style>
</head>
<?PHP
  
include("./_connShopDB.php");  // 수정됨

// COOKIE 변수 가져오기
$UserID = $_COOKIE['UserID']; //추가됨
$result = mysqli_query($con, "select * from members where uid='$UserID'");
$row = mysqli_fetch_array($result); // 추가됨	
$uid    = $row['uid'];     // 수정됨
$uname  = $row['uname'];   // 수정됨
$email  = $row['email'];   // 수정됨
$zip    = $row['zipcode']; // 수정됨
$addr1  = $row['addr1'];   // 수정됨
$addr2  = $row['addr2'];   // 수정됨
$mphone = $row['mphone'];  // 수정됨
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>마이 페이지</title>
  <style>
  h1 {
	text-align: center;
	margin-top: 90px;
	margin-bottom: 40px;
	}

.menu ul {
  list-style-type: none;
  padding: 0;
  text-align: center; /* 이미지들 가운데 정렬 */
}

.menu ul li {
  display: inline-block;
  margin-right: 20px; /* 이미지들 간의 간격 조정 */
}
.menu ul li:last-child {
  margin-right: 0; /* 마지막 이미지의 간격 제거 */
}

.menu ul li a img {
  display: block;
  margin-bottom: 100px;
}

.menu h4 {
  margin-bottom: 10px;
}	
  </style>
</head>

<?php 
if ($UserID == "admin") {
?>

	<div class="menu">
  <h1>*** 관리 메뉴 ***</h1>
  <ul>
    <li>
      <h3>[ 회 원 관 리 ]</h3>
      <ul>
        <li><a href="admin-showMemberList.php"><img src="./image/admin01.png" alt="회원 목록 조회"></a></li>
      </ul>
    </li>
    <li>
      <h3>[ 상 품 관 리 ]</h3>
      <ul>
        <li><a href="p-inputForm.html"><img src="./image/admin02.png" alt="신규 판매상품 등록"></a></li>
        <li><a href="p-adminlist.php"><img src="./image/admin03.png" alt="판매상품 수정/삭제"></a></li>
      </ul>
    </li>
    <li>
      <h3>[ 주 문 관 리 ]</h3>
      <ul>
        <li><a href="admin-showOrderList.php"><img src="./image/admin04.png" alt="주문 내역 조회"></a></li>
      </ul>
    </li>
  </ul>
</div>

<?php
} else {
?>

<body class='members myInfo'>
<table class="myinfo">
  <caption> 회원 정보 </caption>
  <tr class='top_right'><td colspan='6'><a href='m-modifyForm.php' class="button">정보수정</a></td></tr>
  <tr><th>이름</th><td ><?= $uname ?></td>
  <th>휴대전화</th><td ><?= $mphone ?></td>
  <th>이메일</th><td ><?= $email ?></td></tr>
<tr><th>주소</th>
<td colspan='5'><?=$zip?> &nbsp;<?=$addr1?> &nbsp;<?=$addr2?></td></tr>
</table>
<br><br>


<table class="buyinfo">
<caption> 구매 내역 </caption>
<tr><td class='left' colspan='5'>* <span>주문 물품이 배송 이전 단계이면 온라인으로 주문 취소가 가능합니다.</span><br/>
* 배송중이거나 구매 완료된 제품에 대한 반품 및 환불 요청은 community 게시판에 남겨주세요.<br>&nbsp;</td></tr>
<tr><th>구매번호</th><th>구매일자</th><th>주문내역</th><th>금액</th><th>주문상태</th></tr>

<?php 
}
?>
<?PHP
if ($UserID != 'admin') {

$result = mysqli_query($con, "select * from receivers where id='$UserID' order by buydate desc");
$total = mysqli_num_rows($result);

if ($total == 0) 
		echo ("<tr><td colspan='5'>주문 내역이 존재하지 않습니다.</th></tr>");

else {
	$counter = 0;
	while($counter < $total) :

		include('./_searchNShowOrderList.php');  // admin-showOrderList.php에서도 공통 사용
    
		echo ("<td class='center'>$status");
		if ($oldstatus < 4) 
			echo ("<br><a href='se-cancelOrder.php?ordernum=$ordernum' class='cancel'>[주문 취소]</a>");

		echo ("</td></tr>");
		$counter++;
	endwhile;
} 
} else {

}
mysqli_close($con);	
?>
</table>
</body>
</html>

</div>
<?PHP include ('_bottomt.html'); ?>
