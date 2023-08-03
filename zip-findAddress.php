<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>우편 번호 검색 결과</title>
  <link rel="stylesheet" href="./_shop-style.css">
</head>
<script   language='JavaScript'>
	function   okzip(zip, address) {
		opener.document.comma.zip.value = zip;
		opener.document.comma.addr1.value =   address;
		opener.comma.addr2.value='';
		opener.comma.addr2.focus();
		self.close();
	}
</script>

<body class='zip'>
<div class='center'>
   
<?PHP
include("./_connShopDB.php");  // 수정됨

// POST 변수 가져오기
$key = $_POST['key']; //추가됨

//수정됨 mysqli_query($con, "set names 'euckr'");
$result = mysqli_query($con, "select * from zipcode where dong like '%$key%'");
$total = mysqli_num_rows($result);
	  	
$i = 0;
?>

<small>[<strong class='blue'><?=$key?></strong>]으로 검색한 결과입니다. 우편번호를 선택하세요.</small>
<br/>
<table border='1' align='center'>

<?PHP
	
while($i < $total):
	$row = mysqli_fetch_array($result); // 추가됨
	$zip = $row['zipcode'];	  // 수정됨
	$sido = $row['sido'];	  // 수정됨
	$gugun = $row['gugun'];	  // 수정됨
	$dong = $row['dong'];	  // 수정됨
	$bunji = $row['bunji'];	  // 수정됨

	$address = $sido . " " . $gugun   . " " .  $dong;

  echo("   
	<tr><td>&nbsp;<a href=\"javascript: okzip('$zip',  '$address')\">$zip</a>
	&nbsp;&nbsp;&nbsp;&nbsp;$sido $gugun $dong $bunji </td></tr>");

	$i++;
endwhile;
mysqli_close($con);
?>

</table>
</body>
</html>
