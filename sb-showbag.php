

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

	caption {
      margin-top: 90px;
      font-size: 23px;
      font-weight: bold;
      margin-bottom: 30px;
    }

    table {
      margin: 0 auto;
      width: 100%;
      border-collapse: collapse;
	  margin-bottom: 120px;
    }
	.total_second {
		width: 30%;
	}

    th,
    td {
      padding: 10px;
	  
    }

    th {
      background-color: #f2f2f2;
      font-weight: bold;
      text-align: center;
	  border-top: 1px solid #aaa;
    }

    td.center {
      text-align: center;
    }

    td.right {
      text-align: right;
    }

table.total-table {
  margin: 0 auto;
  width: 60%;
  border-collapse: collapse;
  margin-bottom: 30px; /* 수정: 테이블 간의 간격을 좁힙니다 */
}

table.total-table th,
table.total-table td {
  padding: 10px;
  border-bottom: 1px solid #ccc;
}

table.total-table th {
  background-color: #f2f2f2;
  font-weight: bold;
  text-align: center;
   
}

table.total-table td.center {
  text-align: center;
}

table.total-table td.right {
  text-align: right;
}

table.total-table .total {
  font-weight: bold;
}

table.total-table2 {
  margin: 0 auto;
  width: 60%;
  border-collapse: collapse;
  margin-bottom: 50px; /* 수정: 테이블 간의 간격을 좁힙니다 */
}

table.total-table2 th,
table.total-table2 td {
  padding: 10px;
}

table.total-table2 th {
  background-color: #f2f2f2;
  font-weight: bold;
  text-align: center;
   
}

table.total-table2 td.center {
  text-align: center;
}

table.total-table2 td.right {
  text-align: right;
}

table.total-table2 .total {
  font-weight: bold;
}


.button-container {
  text-align: center;
  margin-top: 20px;
  margin-bottom: 50px; /* 수정: 버튼 아래 간격을 조정합니다 */
}

.button-container a {
  display: inline-block;
  padding: 10px 20px;
  margin-right: 10px;
  background-color: #323232;
  color: #fff;
  text-decoration: none;
  font-weight: bold;
  border-radius: 5px;
}

.button-container a:hover {
  background-color: black;
}

.product_name {
	color: black;
	text-decoration: none;
	font-weight: bold;
	margin-left: 20px;
}
.product_name:hover {
	color: #727272;
	text-decoration: none;
	font-weight: bold;
}
.price {
	background-color: #f4f9fd;
	}
	.line {
		border-top: 1px dashed #bbb;
	}
	.br_class {
		white-space: pre-line;
	}
</style>
</head>

      <div class='pAdminList sbList'>
<table class="total-table">
<caption>쇼핑 카트</caption>
  <tr><th width='100'>상품사진</th>
	<th width='300'>상품이름</th>
	<th width='90'>가격</th>
	<th width='50'>수량</th>
	<th width='100'>품목별합계</th>
	<th width='50'>삭제</th></tr>

<?PHP

include("./_connShopDB.php");  // 수정됨

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$sql = "select * from shoppingbag where session='$Session'";
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);

if (!$total) {  ?>
  <tr>
  <td colspan='6' style='text-align: center'><br>쇼핑백에 담긴 상품이 없습니다.<br></td></tr>

<?PHP
} 
else {
    $counter=0;
    $totalprice=0;    // 총 구매 금액  

    while ($counter < $total) :
       $row = mysqli_fetch_array($result); // 추가됨
       $pcode    = $row['pcode'];	  // 수정됨
       $quantity = $row['quantity'];  // 수정됨
   
       // product 테이블에서 pcode에 해당하는 상품 정보 검색하기 
   	   $subSql = "select * from product where code='$pcode'";
       $subResult = mysqli_query($con, $subSql);
       $subRow = mysqli_fetch_array($subResult); // 추가됨
       $userfile = $subRow['userfile'];  // 수정됨
       $pname    = $subRow['name'];  // 수정됨
       $price    = $subRow['price2'];  // 수정됨
	   $deliprice    = $subRow['deliprice'];
       
       $subtotalprice = $quantity * $price;
       $totalprice = $totalprice + $subtotalprice; 

	   if ($totalprice >= 50000) {
		   $deliprice = 0;
	   } else {
		   $deliprice = 2500;
	   }

	   $totalpay = $totalprice + $deliprice;


?>
		  <td>
			<a href='#' onclick="window.open('./photo/<?=$userfile?>', '_new', 'width=450,   height=450')"><img src='./photo/<?=$userfile?>' width="100px"></a></td>
			<td><a href='p-Info.php?code=<?=$pcode?>' class="product_name"><?=$pname?></a></td>
			<td class='right'><?=$price?>&nbsp;원</td>
			<td><form method='post' action='sb-modifyQuantity.php?pcode=<?=$pcode?>'>
  			   <input type='text' name='newnum' size='3' value='<?=$quantity?>'>&nbsp;
			     <input type='submit' value='변경'>
			</form></td>
			<td class='right'><?=$subtotalprice?>&nbsp;원</td>
			<td><a href="sb-deleteItem.php?pcode=<?=$pcode?>"><img src="./image/delete.png" width="30px" style="margin-left: 10px"></td>
			</tr>
<?PHP
		$counter++;
  endwhile;
	  } 
	  if (!$total) {
		  $totalprice = 0;
		  $deliprice = 0;
		  $totalpay = 0;
	  }
	  
	?>

		</table>
		<table class="total-table2 price">
    <tr>
        <td colspan="2" align="center">총 상품 금액</td>
        <td><?= $totalprice ?>&nbsp;원</td>
      </tr>
	  <tr>
        <td colspan="2" align="center">총 배송비</td>
        <td><?= $deliprice ?>&nbsp;원</td>
      </tr>
	   <tr class="line">
        <td colspan="2" align="center">총 결제 금액</td>
        <td><?= $totalpay ?>&nbsp;원</td>
      </tr>
	  </table>
	  <?PHP

mysqli_close($con);	//데이터베이스 연결해제
?>



<div class="button-container">
<?php if ($total) { ?>
<a href='se-buy.php'>구매결정</a> 
<?php } ?>
<a href='p-list.php'>쇼핑계속</a>
</div>
<?PHP include ('_bottomt.html'); ?>