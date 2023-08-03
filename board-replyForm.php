<?PHP include ('_top.html'); ?>
<div>

<?PHP
 
// _GET 배열에서 테이블 이름 변수, 게시판 글 번호 변수 가져오기 
$board = $_GET['board']; 
$id    = $_GET['id'];    

// MySQL 접속 및 DB 선택
include ("./_connShopDB.php");

// JSP: 여기부터 입력하세요. 
// 해당 게시물 검색하여 제목과 내용 추출
$sql = "SELECT * from $board WHERE id=$id;";
$result = mysqli_query($con, $sql); 

$row = mysqli_fetch_array($result); 
$topic   = $row['topic'];      
$content = $row['content'];   

// 원본 글 제목 앞에 "[Re]" 글자를 추가 
$topic = "[Re]" .  $topic;  

// 원본 글 본문의 앞뒤에 구분자 표시
$pre_content = "\n\n\n--------------< 원본글 >-------------\n" . $content . "\n";   
// JSP: 여기까지 입력하세요.
?>

<HTML html>
<head>
  <meta charset="UTF-8"/>   
  <title>답변글 입력</title>
  <link rel="stylesheet" href="./_board-style.css">
  <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
            }

         tr {
            border-bottom: 1px solid #737373;
         }

            .container {
                max-width: 700px;
                margin: 0 auto;
                padding: 20px;
            }

            .inputF {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .inputF caption {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 20px;
            margin-top: 90px;
            }

            .inputF th,
            .inputF td {
                padding: 10px;
            }

            .inputF th {
                background-color: #bcc3d1;;
                font-weight: bold;
                text-align: center;
            }

            .inputF input[type='text'],
            .inputF textarea,
            .inputF input[type='password'] {
                width: 80%;
                padding: 5px;
                border: 1px solid #ccc;
            }

            .bottom {
                width: 100%;
                text-align: center;
            
            }

            .bottom input[type='submit'],
            .bottom input[type='reset'] {
                padding: 10px 20px;
                background-color: black;
                color: white;
                border-radius: 5px;
                cursor: pointer;
            }

            
         .first {
            border-top: 3px solid #737373;
         }
        </style>
</head>

<body>
  <div class="container">
  <form method='post' action='board-replyInsert.php?board=<?=$board?>&id=<?=$id?>'>

  <table class='inputF'>
  <caption>게시판 답변</caption>
  <tr class="first"><th>이름</th>   
       <td><input type='text' name='writer' size='20'></td></tr>
   <tr><th>Email</th> 
       <td><input type='text' name='email' size='78'></td></tr>
      <th>카테고리</th>
           <td>
          <select name='category'>
         <option value='o1'>자유게시판</option>
         <option value='o2'>환불문의</option>
         <option value='o3'>교환문의</option>
         </select>
            </td>
   <tr><th>제목</th>   
       <td><input type='text' name='topic' size='78' value='<?=$topic?>'></td></tr>
  <tr><th>내용</th>   
       <td><textarea name='content' rows='12' cols='80'> <?=$pre_content?> </textarea></td></tr>
  <tr><th>암호</th>   
       <td><input type='password' name='passwd' size='20'></td></tr>
  </table>

  <table class='bottom'>
                    <tr>
                        <td><input type='submit' value='답변 완료'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  <input type='reset' value='지우기'> </td>
                    </tr>
                </table>
  </form>
   <!-- JSP 여기까지 -->

 </body>
</HTML>

</div>
<?PHP include ('_bottom.html'); ?>