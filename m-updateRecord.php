<?PHP
   
include ("_checkModifyMember.php"); // 변경됨

//$con = mysqli_connect("localhost","shoproot","pw4shoproot");
//mysqli_select_db("shopmall",   $con);
include("./_connShopDB.php");  // 수정됨

	
$zip    = $_POST['zip'];    //  추가됨
$addr1  = $_POST['addr1'];  //  추가됨
$addr2  = $_POST['addr2'];  //  추가됨
$UserID = $_COOKIE['UserID']; //  추가됨
$sql = "update members set upass='$upass1', uname='$uname', mphone='$mphone', email='$email', zipcode='$zip', addr1='$addr1', addr2='$addr2' where uid='$UserID'";
echo $sql;
$result = mysqli_query($con, $sql);  // 수정됨
	
if ($result) {
	echo ("<script>
		window.alert('회원 정보 수정이 완료되었습니다');
		history.go(1);
		 </script>
     ");
} else {
    echo ("<script>
		window.alert('회원 정보 수정에 실패했습니다. 다시 한번 시도해 주세요');
		history.go(-1);
		 </script>
	");	   
}
	
mysqli_close($con);  //  수정됨
	
echo ("<meta http-equiv='Refresh'  content='0; url=m-logout.php'>");
	
?>