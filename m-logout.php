<?PHP

// 16��. ���ι�  
if (isset($_COOKIE['UserID'])) 
{ 
	$UserID = $_COOKIE['UserID']; 

	include("./_connShopDB.php");  // ������
	mysqli_query($con, "delete from shoppingbag where id='$UserID'");
	mysqli_close($con);
}  // 16��. ���ι�

SetCookie("UserID", "", time()); // ��Ű ���� ����
SetCookie("UserName", "", time()); // ��Ű ���� ����

//16��. ���ι�  
SetCookie("Session", "", time());
	 
echo   ("<meta http-equiv='Refresh' content='0; url=index.html'>");  // 20��. index.html�� ������

?>
