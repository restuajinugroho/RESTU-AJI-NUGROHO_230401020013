<?php
include 'config.php';

$id = $_GET['id'];

$sqli = "DELETE FROM users WHERE id=$id";

if ($conn->query($sqli) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

header("Location: index.php");
exit;
?>