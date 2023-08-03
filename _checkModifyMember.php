<?PHP
// m-updateRecord.php(교재 register2.php)를 위한 코드

include("../common/__showMessage.php");  // 메시지를 보여주고 이전으로 돌아가는 함수 

// 꼭 필요한 정보인 $upass1, $upass2, $uname, $mphone, $email 가 입력되었는지 검사 
// $uid는 수정할 수 없음... _checkRegisterMember.php에서 uid 확인하는 부분만 제거하면 됨

$upass1  = $_POST['upass1']; if (!$upass1)           __showMessage('비밀번호를 입력해 주세요');
$upass2  = $_POST['upass2']; if ($upass1 != $upass2) __showMessage('비밀번호와 비밀번호 확인이 일치하지 않습니다');
$uname   = $_POST['uname'];  if (!$uname)            __showMessage('이름을 입력해 주세요');
$mphone  = $_POST['mphone']; if (!$mphone)           __showMessage('휴대폰 번호를 입력해 주세요');
$email   = $_POST['email'];  if (!$email)            __showMessage('이메일 주소를 입력해 주세요');

?>