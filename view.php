<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "update";

function connect_db($servername, $username, $password, $dbname) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function fetch_data($conn) {
    $sql = "SELECT ID, First_Name, Last_Name, E_Mail, Phone_Number FROM data_table";
    return $conn->query($sql);
}

$conn = connect_db($servername, $username, $password, $dbname);
$result = fetch_data($conn);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["ID"]. "</td>
                <td>" . $row["First_Name"]. "</td>
                <td>" . $row["Last_Name"]. "</td>
                <td>" . $row["E_Mail"]. "</td>
                <td>" . $row["Phone_Number"]. "</td>
                <td class='actions'>
                    <button class='update' onclick=\"editRecord('".$row["ID"]."', '".$row["First_Name"]."', '".$row["Last_Name"]."', '".$row["E_Mail"]."', '".$row["Phone_Number"]."')\">Update</button>
                    <form style='display:inline;' method='POST' action='data.php' onsubmit='return confirmDelete(this);'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='id' value='".$row["ID"]."'>
                        <input type='submit' class='delete' value='Delete'>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
