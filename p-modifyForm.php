<?php include ('_top.html'); ?>

<?PHP 
    include ('_checkAdmin.php');  // 19장. 관리자만 접근 가능하도록 UserID 검사 
?> 

<?PHP
    
//$con = mysqli_connect("localhost","shoproot","pw4shoproot");
//mysqli_select_db("shopmall");
include("./_connShopDB.php");  // 수정됨

$code = $_GET['code'];  // 추가됨. GET 변수 가져오기
$result = mysqli_query($con, "select * from product where code='$code'");

$row = mysqli_fetch_array($result); // 추가됨
$class   = $row['class'];	  // 수정됨
$name    = $row['name'];	  // 수정됨
$artist    = $row['artist'];
$company    = $row['company'];
$sdate    = $row['sdate'];
$link    = $row['link'];
$price1  = $row['price1'];	  // 수정됨
$price2  = $row['price2'];	  // 수정됨
$deliprice    = $row['deliprice'];
$content = $row['content'];	  // 수정됨
$userfile= $row['userfile'];  // 수정됨
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>관리자용 상품 수정</title>
  <link rel="stylesheet" href="./_shop-style.css">
  <style>
  	caption {
		margin-top: 90px;
		margin-bottom: 30px;
		font-size: 24px;
        font-weight: bold;
		}
		table {
                border-collapse: collapse;
                width: 60%;
                margin: auto;
                margin-top: 20px;
                margin-bottom: 50px;
            }

            th {
                background-color: #f2f2f2;
                text-align: right;
                padding: 10px;
            }

            td {
                padding: 10px;
            }

            input[type="text"],
            textarea {
                width: 80%;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            select {
                width: 80%;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
                appearance: none;
                background-size: 15px;
            }

            .bottom {
                text-align: center;
				justify-content: flex-end;
				
            }

            .bottom input[type="submit"] {
                background-color: #323232;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
				margin-top: 50px;
            }

            .bottom input[type="submit"]:hover {
                background-color: black;
            }
  </style>
</head>

<body class='inputF'>
<table align='center'> 
 <caption>상품 수정</caption>
 <form method='post' action='p-updateRecord.php?code=<?=$code?>' enctype='multipart/form-data'>
  <tr><th width='300px'>상품코드</th><td><strong class='blue'><?=$code?></strong></td></tr>
	<tr><th>상품분류</th><td><select name='class'>
   <?PHP 
   switch($class) {
     case 1:
		  echo ("<option value=1 selected>POP</option>
			       <option value=2>K-POP</option>
             <option value=3>J-POP</option>");
  		break;
	   case 2:
		  echo ("<option value=1>POP</option>
			       <option value=2 selected>K-POP</option>
             <option value=3>J-POP</option>");
    		break;
    	case 3:
       echo ("<option value=1>POP</option>
         			<option value=2>K-POP</option>
              <option value=3 selected>J-POP</option>");
    		break;
    }
  ?>

  </select></td></tr>

  <tr><th>음반이름</th><td><input type='text' name='name' value='<?=$name?>'></td></tr>
  <tr><th>아티스트</th><td><input type='text' name='artist' value='<?=$artist?>'></td></tr>
  <tr><th>음반회사</th><td><input type='text' name='company' value='<?=$company?>'></td></tr>
  <tr><th>판매날짜</th><td><input type='text' name='sdate' placeholder="YYYY-MM-DD" value='<?=$sdate?>'></td></tr>
  <tr><th>상품설명</th><td><textarea name='content' rows='15' cols='75'><?=$content?></textarea></td></tr>
  <tr><th>상품링크</th><td><input type='text' name='link' value='<?=$link?>'></td></tr>
  <tr><th>정상가격</th><td><input type='text' name='price1' value='<?=$price1?>'>원</td></tr>
  <tr><th>할인가격</th><td><input type='text' name='price2' value='<?=$price2?>'>원</td></tr>
  <tr><th>상품사진</th><td><input type='file' size='30' name='userfile'><-- <?=$userfile?></td></tr>
  <tr><td class='bottom' colspan='5'><input type='submit' value='수정완료'></td></tr>
 </form>
</table>
</body>
</html>
