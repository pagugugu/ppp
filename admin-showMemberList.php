<?PHP include ('_top.html'); ?>
      <div>

<?PHP 
    include ('_checkAdmin.php');  // 관리자만 접근 가능하도록 UserID 검사 
?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>관리자용 회원 목록 조회</title>
  <style>
		body {
		margin-bottom: 40px;
		margin-right: 315px;
		margin-left: 315px;
		background-color: #ffffff;
	}

    table {
      width: 800px;
      border-collapse: collapse;
      margin: 0 auto;
      background-color: white;
      color: black;
	  margin-bottom: 100px;
    }
    
    table caption {
      font-size: 24px;
      font-weight: bold;
      padding: 10px;
	  margin-top: 90px;
    }
    
    table th {
      background-color: #140f0f;
      color: white;
      padding: 10px;
      font-weight: bold;
    }
    
    table td {
      padding: 15px;
	  border-bottom: 1px solid darkgray;
    }
    
    table tr.bgBlue {
      background-color: black;
      color: white;
    }
    
    table tr.lineH25 {
      line-height: 25px;
    }
    
    table td a {
      text-decoration: none;
	  text-align: center;
    }
	.wait {
		color: #FFA500;
		font-weight: bold;
	}
	.approved {
		color: #008000;
		font-weight: bold;
	}
	


  </style>
</head>
<body>
  <div>
    <table>
      <caption>[회원 목록 조회]</caption>
      <tr>
        <td colspan="6" class="top right">
          <a href="m-mypage.php"><img src="./image/back.png" alt="back" width="25px"></a>
        </td>
      </tr>
      <tr class="bgBlue lineH25">
        <th>ID</th>
        <th width="60">이름</th>
        <th>주소</th>
        <th>전화번호</th>
        <th>이메일</th>
        <th width="45">승인</th>
      </tr>
<?PHP
include("./_connShopDB.php");  // 수정됨
	
$result = mysqli_query($con, "select * from members order by uname");
$total = mysqli_num_rows($result);

$counter = 0;	
while($counter < $total):
	$row = mysqli_fetch_array($result); // 추가됨
	$uid      = $row['uid'];     // 수정됨...  mysqli_result($result, $counter, "UID");
	$uname    = $row['uname'];   // 수정됨...  
	$zip      = $row['zipcode']; // 수정됨...  
	$addr1    = $row['addr1'];   // 수정됨...  
	$addr2    = $row['addr2'];   // 수정됨...  
	$mphone   = $row['mphone'];  // 수정됨...  
	$email    = $row['email'];   // 수정됨...  
	$approved = $row['approved'];// 수정됨...  

	$address = "(" . $zip .   ")" . "&nbsp;" . $addr1 . "&nbsp;" .   $addr2;

?>	
    <td><?=$uid?></td>
		<td><?=$uname?></td>
		<td class='left'><?=$address?></td>
		<td><?=$mphone?></td>
		<td><?=$email?></td>

<?PHP		
	if ($approved == 0) {
?>
		<td><a href='admin-changeMemberStatus.php?uid=<?=$uid?>' class="wait">대기</a></td></tr>
<?PHP
	} else {
?>
		<td><a href='admin-changeMemberStatus.php?uid=<?=$uid?>' class="approved">완료</a></td></tr>
<?PHP
	}
      
	$counter++;
endwhile;
mysqli_close($con);
?>

</table>
</div>

</div>

<?PHP include ('_bottomt.html'); ?>