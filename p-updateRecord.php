<?PHP
   
include('../common/__showMessage.php'); // 변경 추가됨
   
$code    = $_GET['code'];   //추가됨
// 책 제목과 가격 유무 확인
$name = $_POST['name'];     if (!$name)  __showMessage('상품명이 없습니다. 다시 입력하세요.');  //  추가 및 수정
$price1 = $_POST['price1']; if (!$price1)__showMessage('가격이 없습니다. 다시 입력하세요.');  //  추가 및 수정
// 다른 입력 값들도 가져옴
$class   = $_POST['class'];  //추가됨
$content = $_POST['content'];//추가됨
$price2  = $_POST['price2']; //추가됨
$artist = $_POST['artist'];
$company  = $_POST['company'];
$link  = $_POST['link'];
$sdate  = $_POST['sdate'];
$deliprice  = $_POST['deliprice'];

if(isset($_FILES['userfile']) && $_FILES['userfile']['name'] != "")   // 추가됨
    $userfile = $_FILES['userfile'];
else $userfile = '';

if ($price2 >= 50000) {
	$deliprice = 0;
} else {
	$deliprice = 2500;
}

//$con = mysqli_connect("localhost","shoproot","pw4shoproot");
//mysqli_select_db("shopmall");
include("./_connShopDB.php");  // 수정됨

// 기존 상품 이미지를 그대로 사용하는 경우
if (!$userfile){
	$sql = "update product set class=$class, name='$name', content='$content', artist='$artist', company='$company',sdate='$sdate', link='$link',deliprice='$deliprice',artist='$artist', price1=$price1, price2=$price2 where code='$code'";
	echo $sql;
	$result = mysqli_query($con, $sql);// 수정됨

} else {
     // 기존 상품 이미지 파일을 삭제
	$tmp = mysqli_query($con, "select userfile from product where code='$code'");
	$row = mysqli_fetch_array($tmp); // 추가됨
	$fname = $row['userfile'];	  // 수정됨

  $savedir = "./photo";
	unlink("$savedir/$fname");
	
  // 새로 첨부한 이미지 파일을 저장	
  $newFileName = $userfile['name'];  // 수정됨
  if (file_exists("$savedir/$newFileName")) {
       __showMessage('동일한 화일 이름이 서버에 존재합니다');
  } else {
		move_uploaded_file($userfile['tmp_name'], "$savedir/$newFileName"); // 임시 경로에 있는 파일을 지정한 위치로 이동
  }
  $sql = "update product set class=$class, name='$name', content='$content', artist='$artist', company='$company',sdate='$sdate', link='$link',deliprice='$deliprice',artist='$artist', price1=$price1, price2=$price2, userfile='$newFileName' where code='$code'";
	echo $sql;
	$result = mysqli_query($con, $sql);
}




mysqli_close($con);		//데이터베이스 연결해제

if (!$result) {
	echo("
      <script>
      window.alert('상품 수정에 실패했습니다')
      </script>
    ");
    exit;
} else {
	echo("
      <script>
      window.alert('상품 수정이 완료되었습니다')
      </script>
   ");
} 

echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>