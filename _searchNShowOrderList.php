<head>
<style>
	.buynum {
		text-decoration: none;
		color: blue;
	}
	.buynum:hover {
		text-decoration: underline;
	}
</style>
</head>

<?PHP
  // 사용자용 m-myPage.php 하단에 구매 정보 출력 부분 
	// 주문 목록 정보를 검색한 결과에서 주문 번호로 상품의 이름, 가격 검색하고 표로 출력함
	// 관리자용 주문 관리 페이지 admin-showOrderList.php에서도 사용 
	// include('./_searchNShowOrderList.php'); 
	
		$row = mysqli_fetch_array($result); // 추가됨	
		$session  = $row['session'];  // 수정됨
		$buydate  = $row['buydate'];  // 수정됨
		$ordernum = $row['ordernum']; // 수정됨
		$status   = $row['status'];   // 수정됨
		$oldstatus = $status;
	 
		switch ($status) {
		  case 1: $status = "주문신청"; break;
		  case 2: $status = "주문접수"; break;
		  case 3: $status = "배송준비중"; break;
		  case 4: $status = "배송중";  break;
		  case 5: $status = "배송완료"; break;
		  case 6: $status = "구매완료"; break;
		}
	 
		// JSP 수정 내용: 주문 번호로 orderlist 검색함
		//$subresult = mysqli_query($con, "select * from orderlist where session='$session'");
		$subresult = mysqli_query($con, "select * from orderlist where ordernum='$ordernum'");

		$subtotal =  mysqli_num_rows($subresult);

    $subcounter = 0;
    $totalprice = 0;

    while ($subcounter <   $subtotal) :
			$subRow   = mysqli_fetch_array($subresult); // 추가됨
      $pcode    = $subRow['pcode'];     // 수정됨...
      $quantity = $subRow['quantity'];  // 수정됨...
      $tmpresult = mysqli_query($con, "select * from product where code='$pcode'");
			$tmpRow   = mysqli_fetch_array($tmpresult); // 추가됨
   		$pname = $tmpRow['name'];   // 수정됨...
   		$price = $tmpRow['price2']; // 수정됨...
       
      $subtotalprice = $quantity * $price;
      $totalprice = $totalprice + $subtotalprice;
      $subcounter++;
    endwhile;
	
		$items = $subtotal - 1;

	?>

    <td>
		<a href='#' class="buynum" onclick="window.open('se-viewOrderDetail.php?ordernum=<?=$ordernum?>', '_new',   'width=750, height=400, scrollbars=yes');"><?=$ordernum?></a></td>
		<td class='center'><?=$buydate?></td>
		<td class='left'><?=$pname?> 외 <?=$items?>종</td>
		<td class='right'><?=$totalprice?>원</td>
