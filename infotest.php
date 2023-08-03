<?php
include("_top.html");

//$con = mysqli_connect("localhost","shoproot","pw4shoproot");
//mysqli_select_db("shopmall");
include("./_connShopDB.php");  // 수정됨

$code = $_GET['code'];  // 추가됨. GET 변수 가져오기
$result = mysqli_query($con, "select * from product where code='$code'");
$total = mysqli_num_rows($result);

$row = mysqli_fetch_array($result); // 추가됨
$name    = $row['name'];	 // 수정됨
$content = $row['content'];	 // 수정됨
$content = nl2br($content);   // 줄바꿈 기호를 인식해서 br 태그로 변경
$link = $row['link'];
$price1  = $row['price1'];	 // 수정됨
$price2  = $row['price2'];	 // 수정됨
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
  <link rel="stylesheet" href="./_shop-style.css">
  <style>
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
    }

    .buttonL:hover {
      background-color: #333333;
    }

    .pInfo {
      text-align: center;
    }

    .pInfo img {
      width: 200px;
      height: 200px;
      object-fit: cover;
    }

    .pInfo ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
      text-align: left;
    }

    .pInfo ul li {
      margin-bottom: 10px;
    }

    .price1 {
      color: #999999;
      text-decoration: line-through;
    }

    .center {
      text-align: center;
    }

    .desc {
      text-align: center;
    }

    .desc hr {
      margin-top: 20px;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="pInfo">
    <div>
      <a href="#" onclick="window.open('./photo/<?=$userfile?>', '_new', 'width=450, height=450')">
        <img src='./photo/<?=$userfile?>'></a>
      <br><br>
      <a href="<?=$link?>" target='_blank'><button class="buttonL">Listen</button></a>
    </div>

    <div class="desc">
      <ul>
        <li><strong>상품코드: </strong>&nbsp;&nbsp;<?=$code?><br/><br/></li>
        <li><strong>상품이름: </strong>&nbsp;&nbsp;<?=$name?><br/><br/></li>
        <li><strong>상품가격: </strong>&nbsp;&nbsp;<span class='price1'><?=$price1?>원</span><br/><br/></li>
        <li><strong>할인가격: </strong>&nbsp;&nbsp;<strong><?=$price2?>원</strong><br/><br/></li>
      </ul>

      <div class='center'>
        <form method='post' action='sb-tobag.php?code=<?=$code?>'>
          <input type='text' size='3' name='quantity' value='1'>&nbsp;&nbsp;
          <input type='submit' value='담기'>
        </form>
      </div>
    </div>

    <div class="desc">
      <hr size='1'>
      <h3>[상품 상세 설명]</h3>
      <hr size='1'>
      <p><?=$content?></p>
    </div>
  </div>

  <?php include('_bottom.html'); ?>
</body>
</html>
