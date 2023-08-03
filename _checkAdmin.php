<?PHP
  // 19장. 쿠키 배열에서 UserID와 UserName 변수 가져오는 코드 분리후 재사용 
  include ('_getCookieIDnName.php');  

  if ($UserID != 'admin') {
	  echo ("<script>
		  window.alert('관리자만 접근 가능한 기능입니다');
  		history.go(-1);
	  	</script>");
      exit;
  } 
?>

