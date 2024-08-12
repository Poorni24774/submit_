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

function insert_data($conn, $id, $first_name, $last_name, $email, $phone_number) {
    $sql = "INSERT INTO data_table (ID, First_Name, Last_Name, E_Mail, Phone_Number) VALUES ('$id', '$first_name', '$last_name', '$email', '$phone_number')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function update_data($conn, $id, $first_name, $last_name, $email, $phone_number) {
    $sql = "UPDATE data_table SET First_Name='$first_name', Last_Name='$last_name', E_Mail='$email', Phone_Number='$phone_number' WHERE ID='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

function delete_data($conn, $id) {
    $sql = "DELETE FROM data_table WHERE ID='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connect_db($servername, $username, $password, $dbname);
    $action = $_POST['action'];
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    if ($action == 'insert') {
        insert_data($conn, $id, $first_name, $last_name, $email, $phone_number);
    } elseif ($action == 'update') {
        update_data($conn, $id, $first_name, $last_name, $email, $phone_number);
    } elseif ($action == 'delete') {
        delete_data($conn, $id);
    }

    $conn->close();
    header("Location: index.php");
}
?>
