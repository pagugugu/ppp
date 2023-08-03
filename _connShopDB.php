<?PHP
//데이타베이스에 연결 .. PHP7부터 변경됨 
// $con = mysqli_connect("localhost", "shoproot", "pw4shoproot");
// mysqli_select_db("shopmall");
$con = mysqli_connect('localhost', 'root01', 'pw4root', 'team01');
 
if (!$con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "<br/>Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "<br/>Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>
