<?PHP 
/* 
    $board ���̺��� ������ $result���� $counter ��° ���ڵ带 �����Ͽ� ���̺� ����ϴ� �Լ�
		board-show.php, board-show0.php, board-searchResult.php���� ���
		include("./_board-displayRecord.php"); �� �� �Ʒ� �Լ� ȣ��
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
       	$t = $t . "&nbsp;";     // �亯 ���� ��� ���� �� �κп� ���� ���� �߰�
    }

    // Ȧ��, ¦�� �ٿ� ���� ������ �ٸ��� ���� 
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