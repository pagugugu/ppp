<?PHP

include('../common/__showMessage.php'); // 변경 추가됨
   
$code = $_POST['code'];     if (!$code)   __showMessage('상품코드명이 없습니다. 다시 입력하세요.');  //  추가 및 수정
$name = $_POST['name'];     if (!$name)   __showMessage('상품명이 없습니다. 다시 입력하세요.');  //  추가 및 수정
$price1 = $_POST['price1']; if (!$price1) __showMessage('가격이 없습니다. 다시 입력하세요.');  //  추가 및 수정

if(isset($_FILES['userfile']) && $_FILES['userfile']['name'] != "") 
    $userfile = $_FILES['userfile'];
if (!$userfile) __showMessage('상품 사진을 선택해 주세요.');  //  추가 및 수정
else {
    $savedir = "./photo";
    $userfile_name = $userfile['name'];  //  수정됨
    if (file_exists("$savedir/$userfile_name")) __showMessage('동일한 화일 이름이 이미 서버에 존재합니다');
    else 
		move_uploaded_file($userfile['tmp_name'], "$savedir/$userfile_name"); // 임시 경로에 있는 파일을 지정한 위치로 이동
}

//$con = mysqli_connect("localhost","shoproot","pw4shoproot");
//mysqli_select_db("shopmall");
include("./_connShopDB.php");  // 수정됨

// 그 외 필요한 POST 변수들 가져오기 
$class = $_POST['class'];  // 추가됨
$content = $_POST['content'];  // 추가됨
$link = $_POST['link'];
$price2 = $_POST['price2'];  // 추가됨
$artist = $_POST['artist'];
$company = $_POST['company'];
$sdate = $_POST['sdate'];
$deliprice = $_POST['deliprice'];

if ($price2 >= 50000) {
	$deliprice = 0;
} else {
	$deliprice = 2500;
}

$sql = "insert into product(class, code, name, artist, company, sdate, content, link, price1, price2, deliprice, userfile, hit) values ($class, '$code', '$name', '$artist', '$company', '$sdate', '$content', '$link', '$price1', '$price2', '$deliprice', '$userfile_name', 0)"; 
$result = mysqli_query($con, $sql); //   수정됨

mysqli_close($con);		

if (!$result) 
{
	echo $sql;
	unlink("$savedir/$userfile_name"); //추가함 .에러가 발생하면 사진 복사한 것도 지워야 함
	__showMessage('이미 사용중인 상품 코드입니다');
}
else {
   echo("
      <script>
      window.alert('상품 등록이 완료되었습니다')
      </script>
   ");
}

?>
<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>
