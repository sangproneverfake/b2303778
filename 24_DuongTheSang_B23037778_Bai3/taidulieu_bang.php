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
	print_r ($result);
	echo '<br>';
	echo '<br>';
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Hoten: " . $row["fullname"]. " " . $row["email"].' ngaysinh: '.$row['Birthday']. "<br>";
  }
  echo '<br>';
  echo '<br>';
  $result -> free_result();
  $result = $conn->query($sql);
  $result_all = $result -> fetch_all();
  print_r($result_all);
    echo "<table border=1><tr><th>ID</th><th>Hoten</th><th>email</th><th>ngaysinh</th></tr>";
    foreach ($result_all as $row) {
		$date = date_create($row[3]);
        echo "<tr><td>" . $row[0]. "</td><td>" . $row[1]. "</td><td>" . $row[2]. "</td><td>" . 
		$date ->format('d-m-Y')
		. "</td></tr>";
    }
   echo "</table>";
   //cách 4:
  $result = $conn->query($sql);
  while ($row = $result->fetch_row()) {
    echo "id: $row[0] - Hoten: $row[1] - Email: $row[2] - Ngaysinh: " . date('d-m-Y', strtotime($row[3])) . "<br>";
  }
  $result->free_result();
  echo '<br><br>';
  //cách 5:
  $result = $conn->query($sql);
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    echo "id: " . $row["id"] . " - Hoten: " . $row["fullname"] . " - Email: " . $row["email"] . " - Ngaysinh: " . date('d-m-Y', strtotime($row["Birthday"])) . "<br>";
  }
  $result->free_result();
  echo '<br><br>';
  //cách 6:
  $result = $conn->query($sql);
  while ($row = $result->fetch_object()) {
    echo "id: $row->id - Hoten: $row->fullname - Email: $row->email - Ngaysinh: " . date('d-m-Y', strtotime($row->Birthday)) . "<br>";
  }
  $result->free_result();
  echo '<br><br>';
} else {
  echo "0 ket qua tra ve";
}
$conn->close();
?>