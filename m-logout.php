<?PHP

// 16Àå. ¼îÇÎ¹é  
if (isset($_COOKIE['UserID'])) 
{ 
	$UserID = $_COOKIE['UserID']; 

	include("./_connShopDB.php");  // ¼öÁ¤µÊ
	mysqli_query($con, "delete from shoppingbag where id='$UserID'");
	mysqli_close($con);
}  // 16Àå. ¼îÇÎ¹é

SetCookie("UserID", "", time()); // ÄíÅ° º¯¼ö ÇØÁ¦
SetCookie("UserName", "", time()); // ÄíÅ° º¯¼ö ÇØÁ¦

//16Àå. ¼îÇÎ¹é  
SetCookie("Session", "", time());
	 
echo   ("<meta http-equiv='Refresh' content='0; url=index.html'>");  // 20Àå. index.html·Î ¼öÁ¤µÊ

?>
