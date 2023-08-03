<meta charset="UTF-8"/>
<?PHP
   
include("./_connShopDB.php");  // 수정됨

$pcode = $_GET['pcode']; //추가됨 .. GET 변수 가져오기
$Session = $_COOKIE['Session']; //추가됨 .. 쿠키 변수 가져오기 
$sql = "delete from shoppingbag where session='$Session' and pcode='$pcode'";
$result = mysqli_query($con, $sql);

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=sb-showbag.php'>");
?>