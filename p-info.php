<?PHP include ('_top.html'); ?>
      <div>

<?PHP
   
//$con = mysqli_connect("localhost","shoproot","pw4shoproot");
//mysqli_select_db("shopmall");
include("./_connShopDB.php");  // 수정됨

$code = $_GET['code'];  // 추가됨. GET 변수 가져오기
$result = mysqli_query($con, "select * from product where code='$code'");
$total = mysqli_num_rows($result);



$row = mysqli_fetch_array($result); // 추가됨
$name    = $row['name'];	 // 수정됨
$artist    = $row['artist'];
$company    = $row['company'];
$sdate    = $row['sdate'];
$content = $row['content'];	 // 수정됨
$content = nl2br($content);   // 줄바꿈 기호를 인식해서 br 태그로 변경
$link = $row['link'];
$price1  = $row['price1'];	 // 수정됨
$price2  = $row['price2'];	 // 수정됨
$deliprice = $row['deliprice'];
$userfile= $row['userfile']; // 수정됨
$hit     = $row['hit'];	     // 수정됨

$hit++;			// 13장 추가 내용: 조희 수를 중가하고 테이블 변경

mysqli_query($con, "update product set hit=$hit where code='$code'");  // 13장 추가
// echo "update product set hit=$hit where code='$code'";
mysqli_close($con);
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>상품 정보</title>
  <style>
body {
		margin-bottom: 40px;
		margin-right: 315px;
		margin-left: 315px;
	}
  .buttonL {
  background-color: black;
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 20px;
  padding: 10px 20px;
  width: 150px;
  margin-left: 20px;
}

.buttonL:hover {
  background-color: #333333;
}
.tp-main {
	margin: 30px auto 0;
    width: 960px;
    text-align: left;
	margin-top: 130px;
}
.tp-img {
	float: left;
    width: 250px;
}

.tp-popname {
	display: block;
    padding-bottom: 10px;
    line-height: 1.7em;
    font-weight: normal;
}
.popname {
	font-size: 23px;
	margin-right: 2px;
    line-height: 1.2em;
    color: #333;
    font-size: 23px;
    font-weight: 600;
}
.divi {
	margin: 4px 4px 0 4px;
    width: 1px;
    height: 12px;
    text-indent: -999em;
}
.gd_pub {
	color: #666;
	padding-bottom: 30px;
}
.pri_info {
	float: left;
    padding: 19px 0 0 0;
    width: 430px;
}
tbody {
	display: table-row-group;
    vertical-align: middle;
    border-color: inherit;
}
tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
th {
	display: table-cell;
}
td {
    display: table-cell;
    vertical-align: inherit;
}
.salepri {
	color: #ff6666;
}
.justpri {
	color: #666666;
}
.product_info {
	margin-top: 35px;
	padding-top: 10px;
	width: 80%;
	transform: translateX(-50%);
    left: 50%;
    position: relative;
}
.chang { 
	margin-bottom: 100px;
}

.chang td {
	border-bottom: 1px solid #eee;
	padding: 10px;
}
.center {
	border-bottom: 1px solid #eee;
	padding: 10px 0 10px;
}
.product_info td {
	padding: 10px;
} 
.buttob {
  background-color: black;
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 20px;
  padding: 10px 20px;
  width: 100px;
  margin-left: 20px;
  position: relative;
  top: 160px;
}
.buttonb:hover {
  background-color: #333333;
}
.quan {
	position: relative;
	top: 160px;
}
  </style>
</head>
<body>

<div class="tp-main">	
<!-- 상품 설명 (이미지 + 정보)  -->
<div class="tp-img">
<!--이미지 + 음악 링크 영역  -->
<div>
<a href='#' onclick="window.open('./photo/<?=$userfile?>', '_new', 'width=450, height=450')">
<img src='./photo/<?=$userfile?>'></a>  
  </div> 
<!-- 이미지 영역 끝  -->
  <br><br>
<!-- 음악 링크 영역 -->
  <div class='listen-button'>
    <a href="<?=$link?>" target='_blank'>
      <button class="buttonL">Listen</button>
    </a>
  </div>
<!-- 음악 링크 영역 끝  -->
  </div>
<!-- 이미지 + 음악 링크 영역 끝 -->

  <div class="sh_info">
<!-- 짧은 정보  -->
  <div class="tp-popname">
<!-- 노래 제목 -->
	<h2 class="popname"><strong><?=$name?></strong></h2>
  </div>
<!-- 노래 제목 끝 -->

  <span class="gd_pub">
	<span class="gd-autho"> 
		<?=$artist?><em class="divi">|</em>
		<?=$company?><em class="divi">|</em><?=$sdate?>
		</span>
  </span>

  <div class="pri_info">
<!-- 가격 테이블 -->
	<table>
		<colgroup>
			<col width="110">
			<col width="*">
		</colgroup>
		<tbody>
		<tr>
			<th scope="row"> 정가 </th>
		<td>
		<span class>
			<em class="justpri"><?=$price1?></em>
		</span>
		</td>
		</tr>

		<tr>
			<th scope="row"> 할인가 </th>
		<td>
		<span class>
			<em class="salepri"><?=$price2?></em>
		</span>
		</td>
		</tr>
		<tr>
			<th scope="row"> 배송비 </th>
		<td>
		<span class>  
		<?php
			if ($deliprice == 2500) {
				echo "<em class='delivery'>" . $deliprice . "원 (5만원 이상 무료배송)</em>";
			} else if ($deliprice == 0) {
				echo "<em class='delivery'> 무료 </em>";
			}
      ?>
		</span>
		</td>
		</tr>
	</tbody>
	</table>
	</div>
<!-- 가격 테이블 끝 -->

<!-- 담기 버튼  -->
    <div>
      <form method='post' action='sb-tobag.php?code=<?=$code?>'>
        <input type='text' size='3' name='quantity' value='1' class="quan">&nbsp;&nbsp;
        <input type='submit' value='담기' class="buttob">
      </form>
    </div>
<!-- 담기 버튼 끝  -->
	</div>
<!-- 짧은 정보 끝 -->
</div>
<!-- 상품 설명 (이미지 + 정보) -->
  <br/><br/><br/>
  <br/><br/><br/>
  <br/>
  <div class="product_info">
	<table align='center'>
	<tr><th class='center'>[상품 상세 설명]</th></tr>
	<tr><td><?=$content?><br><br><br><br><br><br></td></tr>
	</table>

	<table class="chang">
	<tr><td>교환/반품/품절 안내</td></tr>
	<tr><td>
		여러분들이 환불이나 교환을 원하신다면, 우리에게 문의를 남겨주셔야 해요. 그래서 저희는 이 마법 같은 안내글로 여러분들에게 어떻게 게시판 커뮤니티에 글을 남겨야 하는지 알려드리려고 해요. 함께 마법을 부려봐요!
	</td></tr>
	<tr><td>
		제목은 화려하게! 
		커뮤니티의 주목을 받으려면 마법같은 제목이 필요해요. "환불의 마법을 풀어주세요!"나 "교환의 요정을 찾아라!"와 같은 재미있고 눈길을 끄는 제목을 생각해보세요. 이런 제목을 보면 누구든 궁금증이 생기고 들어와볼 거예요!
	</td></tr>
	<tr><td>
		마법사처럼 친근한 내용으로!
		커뮤니티는 사람들이 모여있는 공간이니까요. 저희와 함께 마법을 부리면서도 친근하게 내용을 전달해보세요. 유머 감각을 발휘하거나 재치있는 비유를 사용하면 사람들의 호기심을 자극할 수 있어요. 게시글이 마치 마법사가 쓴 것처럼 느껴질 거예요!
	</td></tr>
	<tr><td>
		문제 해결을 위한 협력 부탁!
		글에는 환불/교환에 대한 필요한 정보를 담아주세요. 제품 정보, 주문번호, 구매 일자 등을 자세히 작성하면 저희도 더 빠르게 도움을 드릴 수 있어요. 그리고 협력을 부탁드립니다! 여러분의 문제를 해결하기 위해 함께 노력하고자 하는 우리의 의지를 느낄 수 있도록 하세요.
	</td></tr>
	</table>
	</div>
</div>
</div>
			 
</div>
</body>
<?PHP include ('_bottomt.html'); ?>