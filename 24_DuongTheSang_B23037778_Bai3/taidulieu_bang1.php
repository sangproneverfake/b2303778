<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM student";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $result = $conn->query($sql);
  $result_all = $result -> fetch_all(MYSQLI_ASSOC);
 ?>
 <h1>Bang du lieu sinh vien</h1>
 <table border=1><tr><th>ID</th><th>Hoten</th><th>email</th><th>ngaysinh</th><th colspan="2">Hanh dong</th></tr>
<?php
    foreach ($result_all as $row) {
		$date = date_create($row['Birthday']);
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["fullname"]. "</td><td>" . $row["email"]. "</td><td>" . 
		$date ->format('d-m-Y')
		. "</td><td>";
?>
        <form method="post" action="xoa.php"> 
		<input type="submit" name="action" value="xoa"/>
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
        </form>
<?php
    	echo "</td>";
		echo "<td>";
?>
        <form method="post" action="form_sua.php"> 
		<input type="submit" name="action" value="sua"/>
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
        </form>
<?php
    	echo "</td></tr>";
    }
   echo "</table>";
} else {
  echo "0 ket qua tra ve";
}
$conn->close();
?>
