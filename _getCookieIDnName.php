<?PHP 
  // _getCookieIDnName.php  
	// 19장 _checkAdmin.php와 
	// 20장 _top.html, _left.html에서 include('_getCookieIDnName.php')하여 재사용;

	// 15장 변경 부분 
	if (isset($_COOKIE['UserID'])) $UserID = $_COOKIE['UserID']; 
	else	$UserID = "";
	if (isset($_COOKIE['UserName'])) $UserName = $_COOKIE['UserName']; 
	else 	$UserName = ""; 

?>