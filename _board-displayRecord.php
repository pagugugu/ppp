<?PHP 
/* 
    $board 테이블에서 추출한 $result에서 $counter 번째 레코드를 추출하여 테이블에 출력하는 함수
		board-show.php, board-show0.php, board-searchResult.php에서 사용
		include("./_board-displayRecord.php"); 한 후 아래 함수 호출
		displayRecord($counter, $result, $board); 
*/
  
function displayRecord($counter, $result, $board)
{
   $row = mysqli_fetch_array($result); 
	 $id    = $row['id'];				 $writer= $row['writer'];
	 $topic = $row['topic'];		 $hit   = $row['hit'];	
	 $wdate = $row['wdate'];		 $space = $row['space']; 

    $t="";
    if ($space>0) {
      for ($i=0 ; $i<=$space ; $i++)
       	$t = $t . "&nbsp;";     // 답변 글의 경우 제목 앞 부분에 공백 문자 추가
    }

    // 홀수, 짝수 줄에 따라 배경색을 다르게 지정 
		if ( ($counter % 2) == 0 ) echo ("<tr bgcolor=#ffefff>");
    else      echo ("<tr bgcolor=#ffffef>");

    echo("
      <td>$id</td>
      <td>$writer</td>
      <td class='left'>$t<a href='board-viewContent.php?board=$board&id=$id'>$topic</a></td>
      <td>$wdate</td>
			<td>$hit</td>
      </tr>
    ");
}

?>