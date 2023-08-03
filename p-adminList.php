
<?PHP 
    include ('_checkAdmin.php');  // 19장. 관리자만 접근 가능하도록 UserID 검사 
?> 

<?PHP include ('_top.html'); ?>

<head>
<style>
	body {
		margin-bottom: 40px;
		margin-right: 315px;
		margin-left: 315px;
		background-color: #ffffff;
	}

	caption {
		margin-top: 90px;
		margin-bottom: 50px;
		font-size: 24px;
		font-weight: bold;
	}
	table {
		margin-bottom: 100px;
		border-collapse: collapse;
	}
    table th {
      background-color: #f2f2f2;
      color: black;
      padding: 10px;
      font-weight: bold;
	  border-top: 1.5px solid black;
	  border-bottom: 1.5px solid black;
    }
    
    table td {
      padding: 15px;
	  border-bottom: 1px solid darkgray;
    }
	table tr.lineH25 {
  line-height: 25px;
}
.change {
	color: #008080;
	font-weight: bold;
	text-decoration: none;
	}
.delete {
	color: #800080; 
	font-weight: bold;
	text-decoration: none;
	}

</style>
</head>
      <div class='pAdminList'>
<table align='center'>
  <caption>상품 목록</caption>
	<tr class='lineH25'>
	<th>상품코드</th>
	<th colspan='2'>상품명</th>
     	<th>권장가격</th>
		<th>판매가격</th>
		<th>수정/삭제</th>
	</tr>

<?PHP
include("./_connShopDB.php");  // 수정됨
	
$result = mysqli_query($con, "select * from product order by name");
$total  = mysqli_num_rows($result);
							
if (!$total) {
?>
  <tr><th colspan='6'>아직 등록된 상품이 없습니다</th></tr>

<?PHP
} 
else {
	$counter = 0;
	while ($counter < $total) :
		$row = mysqli_fetch_array($result); // 추가됨
		$code     = $row['code'];  
		$name     = $row['name'];   
		$userfile = $row['userfile'];
		$price1   = $row['price1']; 
		$price2   = $row['price2']; 
?>
    <td class='center'><?=$code?></td>
 	  <td><img src='./photo/<?=$userfile?>' width="100px"></td>
		<td><a href='p-Info.php?code=<?=$code?>'><?=$name?></a></td>
		<td class='right price1'><?=$price1?>원</td>
		<td class='right'><?=$price2?>원</td>
		<td class='center'><a href='p-modifyForm.php?code=<?=$code?>' class="change">수정</a> | <a href='p-deleteConfirm.php?code=<?=$code?>' class= "delete" target="popup"  onclick="window.open('p-deleteConfirm.php?code=<?=$code?>', 'popup', 'scrollbars=no, resizable=no,width=350,height=350,left=0,top=70 '); return false;">삭제</a></td></tr>
<?PHP
		$counter++;
	endwhile;
}
mysqli_close($con);
?>

</table>
</body>
</html>
	     
</div>
<?PHP include ('_bottomt.html'); ?>

