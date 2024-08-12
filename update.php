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

function fetch_record($conn, $id) {
    $sql = "SELECT * FROM data_table WHERE ID='$id'";
    return $conn->query($sql)->fetch_assoc();
}

function update_record($conn, $id, $first_name, $last_name, $email, $phone_number) {
    $sql = "UPDATE data_table SET First_Name='$first_name', Last_Name='$last_name', E_Mail='$email', Phone_Number='$phone_number' WHERE ID='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn = connect_db($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $row = fetch_record($conn, $id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    update_record($conn, $id, $first_name, $last_name, $email, $phone_number);
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Form</title>
</head>
<body>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $row['First_Name']; ?>" required><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $row['Last_Name']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['E_Mail']; ?>" required><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo $row['Phone_Number']; ?>" required><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
