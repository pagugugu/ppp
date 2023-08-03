<?PHP include ('_top.html'); ?>
      <div>

<?PHP
 
include("./_connShopDB.php");  // 수정됨

// COOKIE 변수 가져오기
$UserID = $_COOKIE['UserID']; //추가됨
$result = mysqli_query($con, "select * from members where uid='$UserID'");

$row = mysqli_fetch_array($result); // 추가됨	
$uname  = $row['uname'];	  // 수정됨
$email  = $row['email'];	  // 수정됨
$zip    = $row['zipcode'];	  // 수정됨
$addr1  = $row['addr1'];	  // 수정됨
$addr2  = $row['addr2'];	  // 수정됨
$mphone = $row['mphone'];	  // 수정됨
?>	

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>회원 수정 폼</title>
  <link rel="stylesheet" href="./_shop-style.css">

<script language='Javascript'>
	function go_zip(){
		window.open('zip-findForm.html','ZIP','width=470, height=180, scrollbars=yes');
	}
</script>

<style>
	body {
		margin-bottom: 40px;
		margin-right: 315px;
		margin-left: 315px;
		background-color: #ffffff;
	}

.form_style {
	margin-left: 400px;
	margin-right: 400px;
}
h2 {
	text-align: center;
	margin-top: 90px;
	margin-bottom: 50px;
	}

.joinForm {
  position:absolute;
  width:400px;
  height:400px;
  padding: 30px, 20px;
  background-color:#FFFFFF;
  text-align:center;
  top:40%;
  left:50%;
  transform: translate(-50%,-50%);
  border-radius: 15px;
  
}

.textForm {
  border-bottom: 2px solid #adadad;
  margin: 30px;
  padding: 10px 10px;
  position: relative;
}


.input_form {
  width: 100%;
  border:none;
  outline:none;
  color: #636e72;
  font-size:16px;
  height:25px;
  background: none;
  z-index: 20;
}
.btn {
  position:relative;
  left:50%;
  transform: translateX(-50%);
  margin-bottom: 90px;
  margin-top: 15px;
  width:50%;
  height:40px;
  background: black;
  color:white;
  font-weight: bold;
  border:none;
  cursor:pointer;
  display:inline;
}

.zip {
	position: absolute;
	top: 10px;
	left: 0;
	margin: 0;
	transform: translateX(220%);

}
  </style>

<body>

  <h2>회원정보 수정</h2>
  <form action='m-updateRecord.php' method='post' name='comma' class="form_style">

		<div class="textForm">
		<strong style="font-size: 17px;"><?=$UserID?></strong>
		</div>
		
		<div class="textForm">
		<input type="password" name="upass1"  class="input_form" placeholder="비밀번호">
      </div>
	  <div class="textForm">
        <input type="password" name="upass2"  class="input_form" placeholder="비밀번호 확인">
      </div>
	  <div class="textForm">
        <input type="text" name="uname"  value='<?=$uname?>' class="input_form" placeholder="이름">
      </div>
	  <div class="textForm">
        <input type="text" name="mphone"  value='<?=$mphone?>' class="input_form" placeholder="휴대전화">
      </div>
	  <div class="textForm">
		
        <input type="text" name="email"  value='<?=$email?>' class="input_form" placeholder="이메일">
      </div>
	  
	  <div class="textForm">
		<p class="zip">[<a href='javascript:go_zip()'> 우편번호검색 </a>]</p>
        <input type="text" name="zip"  class="input_form" placeholder="우편번호"  value='<?=$zip?>' readonly>
		<br>
		</div>
		<div class="textForm">
		<input type='text' name='addr1' class="input_form" placeholder="주소" value='<?=$addr1?>' readonly><br>
		</div>
		<div class="textForm">
	     <input type='text' name='addr2' class="input_form" value='<?=$addr2?>' placeholder="세부주소"></td>
      </div>
	  <input type="submit" class="btn" value="수  정"/>
</form>


</body>
</html>

</div>
<?PHP include ('_bottomt.html'); ?>