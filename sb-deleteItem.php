<meta charset="UTF-8"/>
<?PHP
   
include("./_connShopDB.php");  // ������

$pcode = $_GET['pcode']; //�߰��� .. GET ���� ��������
$Session = $_COOKIE['Session']; //�߰��� .. ��Ű ���� �������� 
$sql = "delete from shoppingbag where session='$Session' and pcode='$pcode'";
$result = mysqli_query($con, $sql);

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=sb-showbag.php'>");
?>