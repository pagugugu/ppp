<?PHP

if (isset($_COOKIE['UserID'])) $UserID = $_COOKIE['UserID']; 
else	$UserID = "";
if ($UserID=="") {
	echo ("<script>
		window.alert('로그인 사용자만 이용하실 수 있어요');
		history.go(-1);
		</script>");
	exit;
}

// 다른 쿠키 변수 가져오기
$UserName = $_COOKIE['UserName']; 
$Session = $_COOKIE['Session']; 
?>

<?PHP include ('_top.html'); ?>

<head>
<style>
	body {
		margin-bottom: 40px;
		margin-right: 315px;
		margin-left: 315px;
		background-color: #ffffff;
	}

h3 {
	font-size: 19px;
    padding: 20px 0 14px;
    margin: 90px 0px 20px;
    font-weight: 700;
	margin-left: 150px;
}
hr {
	color: #ccc;
	width: 420px;
	margin-left: 150px;

}
label {
	line-height: 2;
    font-weight: 700;
    font-size: 12px;
	display: block;
}
input[type=text], textarea, select {
	color: black;
    padding: 10px;
    height: auto;
    border-width: 1px;
    border-style: solid;
	margin: 4px 0px 4px;
	font-size: 16px;
}
.deliy {
	margin-top: 90px;
}
.delinfo {
  text-align: left;
  margin-left: 150px;
  
}


table {
	margin: 0 auto;
	border-collapse: collapse;
	text-align: center;
}

th {
	padding: 20px 0 10px;
}

td {
	border-bottom: 1px solid #ccc;
	padding: 10px 0 10px;
}
td a {
	text-decoration: none;
	color: black;
}
td a:hover {
	color: #727272;
}
.pricetable {
	border: 2px solid #ddd;
}
.location {
	position: relative;
	top: -500px;
	left: 680px;
	width: 430px;
	
}
.name {
	font-size: 19px;
	font-weight: bold;
}
.left {
	text-align: left;

}
.button {
    display: inline-block;
    padding: 10px 15px;
    background-color: #000;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
	margin-top: 30px;
	margin-bottom: 30px;
	margin-left: 180px;
  }
  .button:hover {
	background-color: #3b3b3b;
  }

section {
  border: 1px solid white;
  width: 500px;
  height: 600px;
}
</style>
</head>
	
	<script language='Javascript'>
	 function go_zip(){ 
	  	window.open('zip-findForm.html', 'zipcode', 'width=470, height=180, scrollbars=yes');
  	}
  </script>

<?PHP
include("./_connShopDB.php");  // 수정됨

$Session = $_COOKIE['Session']; 

$result1 = mysqli_query($con, "select * from members where uid='$UserID'");
$rows = mysqli_fetch_array($result1);
        $uname = $rows['uname'];
        $zip = $rows['zipcode'];
        $addr1 = $rows['addr1'];
        $addr2 = $rows['addr2'];
        $mphone = $rows['mphone'];

$result = mysqli_query($con, "select * from shoppingbag where session='$Session'");
$total = mysqli_num_rows($result);

?>

<section>
<form method='post' action='se-endshopping.php' name='comma' class="deliy">
<span><p>
  <h3>배송 정보 입력</h3>
  <hr></p></span>
  <div class="delinfo">
  <span><p>
  <label>배송지 선택</label>
  <input type='radio' name='check' value="me" checked onclick='delAddr()'>주문고객 정보와 동일
  <input type='radio' name='check' value="new" onclick='delAddr()'>새 배송지 입력</span></p>

  <span>
  <p>
  <label>받는이</label>
  <input type='text' name='receiver' size='10' value='<?=$uname?>'> </span></p>
  
  <span>
  <p>
  <label>전화번호</label>
  <input type='text' name='phone' size='20' value='<?=$mphone?>'> </span></p>
  
  <span>
  <p>
  <label>배송주소</label>
  <input type='text' size='6' name='zip' value='<?=$zip?>' readonly>
  [<a href='javascript:go_zip()'>우편번호검색</a>]<br/>
  <input type='text' size='45' name='addr1' value='<?=$addr1?>' readonly><br/>
  <input type='text' size='30' name='addr2' value='<?=$addr2?>'> </span></p>
  
  <span>
  <p>
  <label>주문요구사항</label>
  <select name='field' onchange='delText()'>
    <option value="빠른 배송 부탁드립니다">빠른 배송 부탁드립니다.</option>
    <option value="집 앞에 놔주세요" selected>집 앞에 놔주세요.</option>
    <option value="택배함에 넣어주세요">택배함에 넣어주세요.</option>
    <option value="경비실에 맡겨주세요">경비실에 맡겨주세요.</option>
    <option value="직접 입력">직접 입력</option>
  </select> </span></p>

  <?php
  if (isset($_POST['field']) && $_POST['field'] === '직접 입력') {
    echo '<textarea name="message" rows="1" cols="50"></textarea>';
  } else {
    echo '<textarea name="message" rows="1" cols="47" style="display: none;"></textarea>';
  }
  ?>
  </section>

<script>
	function delAddr(){
		const receiverInput=document.querySelector('input[name="receiver"]');
		const phoneInput = document.querySelector('input[name="phone"]');
		const zipInput = document.querySelector('input[name="zip"]');
		const addr1Input = document.querySelector('input[name="addr1"]');
		const addr2Input = document.querySelector('input[name="addr2"]');
		const fieldSelect = document.querySelector('select[name="field"]');
		const messageTextarea = document.querySelector('textarea[name="message"]');

		if (document.querySelector('input[name="check"]:checked').value === "me") {
			receiverInput.value = "<?=$uname?>";
			phoneInput.value = "<?=$mphone?>";
			zipInput.value = "<?=$zip?>";
			addr1Input.value = "<?=$addr1?>";
			addr2Input.value = "<?=$addr2?>";
			fieldSelect.selectedIndex = 0;
			messageTextarea.value = "";
		} else {
			receiverInput.value = "";
			phoneInput.value = "";
			zipInput.value = "";
			addr1Input.value = "";
			addr2Input.value = "";
			fieldSelect.selectedIndex = 0;
			messageTextarea.value = "";
		}
}
	function delText() {
    const fieldSelect = document.querySelector('select[name="field"]');
    const textarea = document.querySelector('textarea[name="message"]');

    if (fieldSelect.value === '직접 입력') {
      textarea.style.display = 'block';
    } else {
      textarea.style.display = 'none';
    }
  }
</script>
<div class="location">
<div class="pricetable">
<table>
  <tr><td colspan='5' class="name"><?= $UserName; ?>님의 주문</td></tr>
  <tr><th width='250' class="left">상품</th>
  <th width='100'>합계</th></tr> 

<?PHP
if (!$total) {  ?>
  <tr bgcolor='#ffefff'><td colspan='5' class='center'>쇼핑백에 담긴 상품이 없습니다.</td></tr>
<?PHP
} else { 
    $counter=0;
    $totalprice=0;    // 총 구매 금액  

    while ($counter < $total) :
		$row = mysqli_fetch_array($result); // 추가됨
		$pcode    = $row['pcode'];	  // 수정됨
		$quantity = $row['quantity']; // 수정됨
      
		$subResult = mysqli_query($con, "select * from product where code='$pcode'");
		$subRow = mysqli_fetch_array($subResult); // 추가됨
		$pname    = $subRow['name'];	  // 수정됨
		$price    = $subRow['price2'];	  // 수정됨
        
		$subtotalprice = $quantity * $price;
		$totalprice = $totalprice + $subtotalprice; 
		$deliprice = 0;

		if ($totalprice >= 50000) {
			$deliprice = 0;
		} else {
			$deliprice = 2500;
		}

		$totalpay = $totalprice + $deliprice;


?>
		<td class="left"><a href='p-Info.php?code=<?=$pcode?>'><?=$pname?></a>&nbsp;&nbsp;&nbsp;x<?=$quantity?></td>
		<td class='right'><?=$subtotalprice?>&nbsp;원</td>
		</tr>
<?PHP

		$counter++;
    endwhile;
 	?>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
    <tr><td colspan='5' class="left">
		총 구매 금액: <?=$totalprice?>원<br>
		배송비 : <?=$deliprice?> 원 <br>
		총 결제 금액 : <strong> <?=$totalpay?> </strong>원</td>
		</tr></table>

<?PHP
}

mysqli_close($con);	//데이터베이스 연결해제
?>
  <input type='submit' value='구매완료' class="button">
</form>
</div>
</div>

<?PHP include ('_bottomt.html'); ?>