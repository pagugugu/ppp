<head>
<style>
table {
	margin-top: 20px;
	margin-bottom: 100px;
	margin-left: 50px;
	margin-right: 50px;
}

table td {
  padding-left: 20px; 
  padding-right: 20px;
  padding-bottom: 20px;
  vertical-align: top;
}
.info_a {
	font-size: 20px;
	color: black;
	text-decoration: none;
}
.info_a:hover {
	font-size: 20px;
	color: #ababab;
	text-decoration: none;
}
.info_b {
	font-size: 15px;
	color: #717171;
}
.info_c {
	font-size: 18px;
	color: #2f2f2f;
	font-weight: bold;
}
</style>
</head>

<body>
<div class='pList'>
 <table>
 <tr>

<?PHP	  

include("./_connShopDB.php");  // 수정됨

if(isset($_GET['class']) )   // 수정됨
    $class = $_GET['class'];
else $class = 0;   

switch($class) {
   case 0:      // 초기화면에 출력할 인기 상품 목록
       $result = mysqli_query($con, "select * from product order by hit desc");
		break;
		
   default:     // 카테고리별 메뉴 화면에 출력할 상품 목록
       $result = mysqli_query($con, "select * from product where class=$class order by hit desc");
		break;
}

$total = mysqli_num_rows($result);
	
if (!$total){
?>
	<th style="text-align: center;">아직 등록된 상품이 없습니다</th>
	
<?PHP
} 
else {

	$counter = 0;
	// echo ("<img class='hr' src='images/Class$class.jpg'>");  // 20장 추가 

	while ($counter < $total &&   $counter < 15) :
    // 20장 수정 및 추가     
/*		if ($counter > 0 && ($counter % 5) == 0) 
			echo("</tr><tr><td colspan='5'><hr size='1' color='green' width='100%'></td></tr><tr>");
*/
    // 20장 추가 
		if ($counter > 9 && ($counter % 5) == 0) echo ("</tr><tr><td colspan='5'> </td></tr><tr>");
		else if ($counter > 1 && ($counter % 5) ==0) echo ("</tr><tr><td colspan='5'></td></tr><tr>");

		$row = mysqli_fetch_array($result); // 추가됨
		$code     = $row['code'];     // 수정됨...mysqli_result($result,$counter,"code");
		$name     = $row['name'];     // 수정됨
		$userfile = $row['userfile']; // 수정됨
		$price2   = $row['price2'];   // 수정됨
		$artist   = $row['artist'];
		$company   = $row['company'];

		switch(strlen($price2)) {
			case 6: 
			   $price2 = substr($price2, 0, 3) . "," . substr($price2, 3,   3);
			   break;
			case 5:
			   $price2 = substr($price2, 0, 2) . "," . substr($price2, 2,   3);
			   break;
			case 4:
			   $price2 = substr($price2, 0, 1) . "," . substr($price2, 1,   3);
			   break;	   
		}
?>

		<td><a href='p-Info.php?code=<?=$code?>' class="info_a"> 
		<img src='./photo/<?=$userfile?>'><br/><span><?=$name?></span></a><br>
		<span class="info_b"><?=$artist?><strong> / </strong><span class="info_b"><?=$company?><br><br>
		<span class="info_c"><?=$price2?>원</span></td>
   
<?PHP
		$counter++;
	endwhile;
}
mysqli_close($con);
?>
</tr>
</table>

</div>
</body>
