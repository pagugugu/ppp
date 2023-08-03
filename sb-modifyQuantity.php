<meta charset="UTF-8"/>
<?PHP
  
$newnum = $_POST['newnum'];
if ($newnum < 1 || $newnum > 100) {
	echo ("<script>
		window.alert('변경하고자 하는 수량이 범위를 초과합니다');
		history.go(-1);
		</script>");
    exit;
}
	 
include("./_connShopDB.php");  // 수정됨

$pcode = $_GET['pcode']; //추가됨 .. 주소줄에 넘어옴
$Session = $_COOKIE['Session']; // 추가됨 ..// 쿠기 변수 가져오기

$sql = "update shoppingbag set quantity=$newnum where session='$Session' and pcode='$pcode'";
echo $sql; 
$result = mysqli_query($con, $sql);

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=sb-showbag.php'>");
?>