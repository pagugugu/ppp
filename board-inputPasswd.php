<?php include('_top.html'); ?>
<div>

<?php
// _GET 배열에서 테이블 변수, 게시판 글 번호, 수정/삭제 모드 변수 가져오기
$board = $_GET['board'];
$id = $_GET['id'];
$mode = $_GET['mode'];
?>


<html>

<head>
  <meta charset="UTF-8" />
  <title>ID/PW 찾기</title>
  <style>
	body {
		margin-bottom: 40px;
		margin-right: 315px;
		margin-left: 315px;
		background-color: #ffffff;
	}

    .container {
      background-color: white;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
      width: 400px;
      height: 200px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
	  margin : 150px;
	  margin-left: 400px;
    }

    .container h4 {
      font-size: 20px;
      font-weight: bold;
      color: #000000;
      background-color: white;
      padding: 10px;
      margin-top: -1px;
      position: absolute;
      top: 40px;
      left: 50%;
      transform: translateX(-50%);
    }

    .container .form-table {
      margin-top: 30px;
      width: 100%;  
    }

    .container label {
      display: block;
      text-align: left;
      margin-bottom: 5px;
      color: #000000;
      font-weight: bold;
    }

    .container input[type="password"] {
      border: none;
      border-bottom: 1px solid #000000;
      padding: 5px;
      width: 100%;
      box-sizing: border-box;
      margin-bottom: 30px;
	  margin-top: 30px;

    }

    .container input[type="submit"] {
      background-color: #000000;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      width: 40%;
    }

    .container input[type="submit"]:hover {
      background-color: #333333;
    }
  </style>
</head>

<body>
  <div class="container">
    <h4>암호 입력</h4>
    <form method='post' action='board-checkPasswd.php?board=<?= $board ?>&id=<?= $id ?>&mode=<?= $mode ?>'>

      <table class='form-table'>
        <tr>
          <td>
            <input type='password' size='15' name='pass' placeholder="암호를 입력해주세요." required>
            <input type='submit' value='입력'>
          </td>
        </tr>
      </table>
    </form>
  </div>
</body>

</html>

</div>
<?php include('_bottomt.html'); ?>
