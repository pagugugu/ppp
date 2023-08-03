<?PHP 
    include ('_checkAdmin.php');  // 19장. 관리자만 접근 가능하도록 UserID 검사 
?> 

<?PHP
include("./_connShopDB.php");  // 수정됨

// POST 변수 가져오기
$code = $_GET['code']; //추가됨
$result = mysqli_query($con, "select * from product where code='$code'");
$row = mysqli_fetch_array($result); // 추가됨
$name = $row['name']; // 수정됨...mysqli_result($result,0,"name");
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title >관리자용 상품 삭제 확인</title>
  <link rel="stylesheet" href="./_shop-style.css">
<style>
	table {
		margin-left: 100px;
		margin-top: 20px;
	}
	.del {
		margin-left: 50px;
	}

</style>

</head>

<body class='inputF'>
<table > 
 <form method='post'    action='p-deleteRecord.php?code=<?=$code?>'>
 <caption style="text-align: left; margin-bottom: 20px;">상품 삭제 확인</caption>
	<tr><th>상품코드: </th><td><?=$code?></td></tr>
	<tr><th>상품이름: </th><td><?=$name?></td></tr>

	<tr><td width='300' colspan='2' class='bottom'>위 상품을 삭제하시겠습니까?<br>
			  <input type='submit' value='삭제' class="del"><br>
      <a href='p-adminList.php' onclick="window.close(); return false;" class="del">돌아가기</a></td></tr>
</form> 
</table>
</body>
</html>


