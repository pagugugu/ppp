<?PHP
include("./_connShopDB.php");  // 수정됨

$code = $_GET['code']; //추가됨 GET 변수 가져오기

// 상품 이미지 파일을 photo 폴더 내에서 삭제
$tmp = mysqli_query($con, "select userfile from product where code='$code'");
$row = mysqli_fetch_array($tmp); // 추가됨
$fname = $row['userfile']; // 수정됨... mysqli_result($tmp, 0, "userfile");

$savedir = "./photo";
unlink("$savedir/$fname");
	
$result = mysqli_query($con, "delete from product where code='$code'");

if (!$result) {
   echo("
      <script>
      window.alert('상품 삭제에 실패했습니다');
      history.go(-1)
      </script>
   ");
   exit;
} else {
   echo("
      <script>
      window.alert('상품이 정상적으로 삭제되었습니다');
      </script>
   ");
}

mysqli_close($con);

echo "<script>
		window.close();
		window.opener.location.reload();
		</script>";
echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>
