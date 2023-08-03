<meta charset="UTF-8"/>

<?PHP
  
include("./_connShopDB.php");  // ¼öÁ¤µÊ

$ordernum = $_GET['ordernum'];
$result = mysqli_query($con, "select * from receivers where ordernum='$ordernum'");
$total = mysqli_num_rows($result);

if ($total) {
	$row = mysqli_fetch_array($result); // Ãß°¡µÊ
	$session = $row['session'];   // ¼öÁ¤µÊ
 
	mysqli_query($con, "delete from receivers where ordernum='$ordernum'");
    // JSP ¼öÁ¤ ³»¿ë
	// mysqli_query($con, "delete from orderlist where session='$session'");
	 mysqli_query($con, "delete from orderlist where ordernum='$ordernum'");
}

mysqli_close($con);

?>

<meta http-equiv='Refresh' content='0; url=m-mypage.php'>