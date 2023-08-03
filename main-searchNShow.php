<?PHP include ('_top.html'); ?>

<head>
<style>
	body {
		margin-bottom: 40px;
		margin-right: 315px;
		margin-left: 315px;
		background-color: #ffffff;
	}
	.tab {
			margin-top: 90px;
			margin-bottom: 100px;
	}

</style>
</head>

<body>

<?php

$key   = $_POST['key'];   // 검색어 

if (!$key) {
  echo("<script>
   window.alert('검색어를 입력하세요');
   history.go(-1);
  </script>");
  exit;
}

include ("./_connShopDB.php");  // mySQL 접속

$sql = "SELECT * FROM product WHERE name LIKE '%$key%';";  

$result = mysqli_query($con, $sql); 
$total  = mysqli_num_rows($result);
?>

<table align='center' class="tab">
  <caption>상품 목록</caption>
   <tr><th>상품코드</th><th colspan='2'>상품명</th>
        <th>권장가격</th><th>판매가격</th><th>수정/삭제</th>
   </tr>

<?PHP

if (!$total) {
?>
  <tr><th colspan='6'>아직 등록된 상품이 없습니다</th></tr>

<?PHP
} 
else {
   $counter = 0;
   while ($counter < $total) :
      $row = mysqli_fetch_array($result); // 추가됨
      $code     = $row['code'];    // 수정됨...mysqli_result($result,$counter,"code");
      $name     = $row['name'];    // 수정됨...mysqli_result($result,$counter,"name");
      $userfile = $row['userfile'];// 수정됨...mysqli_result($result,$counter,"userfile");
      $price1   = $row['price1'];  // 수정됨...mysqli_result($result,$counter,"price1");
      $price2   = $row['price2'];  // 수정됨...mysqli_result($result,$counter,"price2");

      if ( ($counter % 2) == 0 ) echo ("<tr bgcolor=#ffefff>");
    else                       echo ("<tr bgcolor=#ffffef>");
?>
    <td class='center'><?=$code?></td>
      <td><img src='./photo/<?=$userfile?>'></td>
      <td><a href='p-Info.php?code=<?=$code?>'><?=$name?></a></td>
      <td class='right price1'><?=$price1?>원</td>
      <td class='right'><?=$price2?>원</td>
      <td class='center'><a href='p-modifyForm.php?code=<?=$code?>'>수정</a>/<a href='p-deleteConfirm.php?code=<?=$code?>'>삭제</a></td></tr>
<?PHP
      $counter++;
   endwhile;
}
mysqli_close($con);
?>

</table>
<?PHP include ('_bottomt.html'); ?>
</body>

</html>