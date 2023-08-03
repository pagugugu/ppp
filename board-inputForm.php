<?php

if (isset($_COOKIE['UserID'])) {
    $UserID = $_COOKIE['UserID'];
} else {
    $UserID = "";
}
if ($UserID == "") {
    echo ("<script>
        window.alert('로그인 사용자만 이용하실 수 있어요');
        history.go(-1);
        </script>");
    exit;
}
?>

<?php include('_top.html'); ?>
<div>

    <?php
    // 게시판에 사용할 테이블 이름을 $_GET 배열에서 가져오기
    $board = $_GET['board'];
    ?>

    <html>

    <head>
        <meta charset="UTF-8" />
        <title>게시판 입력</title>
        <link rel="stylesheet" href="./_board-style.css">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
				margin-bottom: 40px;
				margin-right: 315px;
				margin-left: 315px;
				background-color: #ffffff;
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
                background-color: #bcc3d1;
                font-weight: bold;
                text-align: center;
            }

            .inputF input[type='text'],
            .inputF textarea,
            .inputF input[type='password'], select {
                width: 80%;
                padding: 5px;
                border: 1px solid #ccc;
            }

            .bottom {
                width: 100%;
                text-align: center;
				margin-bottom: 100px;
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
            <form method='post' action='board-insertRecord.php?board=<?= $board ?>'>

                <table class='inputF'>
                    <caption><h2>게시판 등록</h2></caption>
                    <tr class="first">
                        <th>이름</th>
                        <td><input type='text' name='writer' size='20' ></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type='text' name='email' size='78'></td>
                    </tr>
					<th>카테고리</th>
					<td>
					<select name='category'>
					<option value='o1'>자유게시판</option>
					<option value='o2'>교환/환불 신청</option>
					<option value='o3'>상품 문의</option>
					<option value='o4'>기타 문의</option>
					</select>
					</td>
                    <tr>
                        <th>제목</th>
                        <td><input type='text' name='topic' size='78'></td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td><textarea name='content' rows='12' cols='80'></textarea></td>
                    </tr>
                    <tr>
                        <th>암호</th>
                        <td><input type='password' name='passwd' size='20'></td>
                    </tr>
                </table>

                <table class='bottom'>
                    <tr>
                        <td><input type='submit' value='등록하기'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type='reset' value='지우기'> </td>
                    </tr>
                </table>

            </form>
        </div>
    </body>

    </html>

</div>
<?php include('_bottomt.html'); ?>