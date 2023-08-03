<?PHP include ('_top.html'); ?>
      <div>

<?PHP 
    include ('_checkAdmin.php');  // 관리자만 접근 가능하도록 UserID 검사 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>관리자용 주문 목록 보기</title>
  <style>
	body {
		margin-bottom: 40px;
		margin-right: 315px;
		margin-left: 315px;
		background-color: #ffffff;
	}

	    table {
      width: 800px;
      border-collapse: collapse;
      margin: 0 auto;
      background-color: white;
      color: black;
	  margin-bottom: 100px;
    }
    
    table caption {
      font-size: 24px;
      font-weight: bold;
      padding: 10px;
	  margin-top: 90px;
    }
    
    table th {
      background-color: white;
      color: black;
      padding: 10px;
      font-weight: bold;
	  border-top: 2px solid black;
	  border-bottom: 2px solid black;
    }
    
    table td {
      padding: 15px;
	  border-bottom: 1px solid darkgray;
    }
    
    table tr.bgBlue {
      background-color: black;
      color: white;
    }
    
    table tr.lineH25 {
      line-height: 25px;
    }
    
    table td a {
      text-decoration: none;
	  text-align: center;
    }
	.blue {
		color: blue;
		font-weight: bold;
		}

  </style>
</head>

<body>
<div>
<table>
  <caption>[주문 내역 조회]</caption>
  <tr><td colspan='5' class='top right'>
  <a href="m-mypage.php"><img src="./image/back.png" alt="back" width="25px"></a>
  </td></tr>

  <tr class='bgBlue lineH25'>
  <th>주문번호</th>
  <th>주문일자</th>
  <th>주문내역</th>
  <th>주문총액</th>
  <th>상태변경</th>
  </tr>

<?PHP
include("./_connShopDB.php");  // 수정됨
	
$result = mysqli_query($con, "select * from receivers order by buydate desc");
$total = mysqli_num_rows($result);

if ($total == 0) 
		echo ("<tr><td colspan='5'>주문 내역이 존재하지 않습니다.</th></tr>");

else {
	$counter = 0;
	while ($counter < $total):
    include('./_searchNShowOrderList.php');

    if ($oldstatus < 6) {
        echo ("<td ><a href='admin-changeOrderStatus.php?ordernum=$ordernum'>
		<strong>$status</strong></a></td></tr>");
    } else {
        echo ("<td><strong>$status</strong></td></tr>");
    }	
		$counter++;

	endwhile;

} 
mysqli_close($con);
?>

</table>

</body>

</div>
<?PHP include ('_bottomt.html'); ?>