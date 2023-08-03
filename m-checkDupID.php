<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>아이디 중복 검사</title>
  <link rel="stylesheet" href="./_shop-style.css">
  <style>
  .checkDup {
	margin-top: 20px;
	margin-bottom: 20px;
	}
  </style>
</head>

<script language='Javascript'>
  // ID의 길이 검사
function a() {
   var id = document.idcheck.newid.value;
   if (id == '') {
        window.alert('아이디를 입력해 주세요!');
   } else {
if (id.length < 5) 
             window.alert('아이디를 5글자 이상 입력해 주세요!');
          else 
             document.idcheck.submit();
   }
}

function b() {
    opener.comma.uid.value = document.idcheck.id.value;
    this.close();
}
</script>

<body class='checkId center'>
<div>
<form method='post' action='m-checkDupId.php' name='idcheck' class="checkDup">
<?PHP

include("./_connShopDB.php");  // 수정됨

if(isset($_GET['id'])) $id = $_GET['id']; // m-join2.html에서 id_check() 함수를 통해서 GET으로 전달됨
else $id = $_POST['newid'];  // 현재 폼에서 받아옴
$result = mysqli_query($con, "select * from members where uid='$id'");
$total = mysqli_num_rows($result);
mysqli_close($con);
?>

<strong class='red'><?=$id?></strong>은(는)&nbsp;

<?PHP
if ($total == 0) 
	echo("사용 가능한 아이디입니다.<br/>사용하시겠습니까?<br/><br/>
	  [<a href='javascript:b()'> <input type='hidden' name='id' value='$id'>YES</a>]<br/><br/><br/>
  "); 
else 
	echo("이미 사용중인 아이디입니다.<br/>다른 아이디를 입력해 주세요.<br/><br/><br/>");
?>

* <strong>아이디</strong> <input type='text' name='newid' size='20'>&nbsp;&nbsp;
<a href='javascript:a()'>ID중복검사</a><br/>
</form>
</div>
</body>
</html>
