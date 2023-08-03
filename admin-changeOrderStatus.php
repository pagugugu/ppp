<meta charset="UTF-8"/>
<?PHP 
   
include("./_connShopDB.php");  // ¼öÁ¤µÊ

$ordernum = $_GET['ordernum']; // Ãß°¡µÊ 
$result = mysqli_query($con, "select status from receivers where ordernum='$ordernum'");
$total = mysqli_num_rows($result);

if ($total > 0) {
	$row = mysqli_fetch_array($result); // Ãß°¡µÊ
	$status = $row['status'];	  // ¼öÁ¤µÊ
	$status = $status + 1;
} else {
	$status = 1;
}

$result = mysqli_query($con, "update receivers set status=$status where ordernum='$ordernum'");

mysqli_close($con);	

echo ("<meta http-equiv='Refresh' content='0; url=admin-showOrderList.php'>");

?>
