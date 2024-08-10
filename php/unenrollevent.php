<?php
if(!isset($_GET['Event_id'])) {
    header("location:./enrolledevents.php");
}
session_start();
include("connection.php");

$userId = $_SESSION["UserID"];
$eventId = $_GET['Event_id'];

//create the query
$sql = "delete from enrolled_by where User_id = $userId and Event_id = $eventId;";

try {
    $result = mysqli_query($mysqli, $sql);

    header("location: ./enrolledevents.php");
} catch (mysqli_sql_exception $e) {
    echo '
    <script>
        window.location.href="./enrolledevents.php";
        alert("Failed to unenroll from event. Please try again.")
    </script>
    ';
    } 
//close connection
$mysqli->close();
?>