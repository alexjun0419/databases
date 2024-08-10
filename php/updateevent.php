<?php
session_start();
include("connection.php");

if (isset($_POST["update"])) {
    //get submited event details
    $eventId = $_SESSION['eventId'];
    $eventName = $_POST['eventName'];
    $startDate = $_POST['startDate'];
    $startTime = $_POST['startTime'];
    $venue = $_POST['venue'];
    $abstractDeadline = $_POST['abstractDeadline'];
    $max = $_POST['max'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $street = $_POST['street'];
    $zip = $_POST['zip'];
    $status = $_POST['status'];
    $endDate = $_POST['endDate'];
    $endTime = $_POST['endTime'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $university = $_POST['university'];
    $pubDate = $_POST['pubDate'];
    $pubTime = $_POST['pubTime'];

    $sql = "update event set Start_date='$startDate', Start_time='$startTime', Venue='$venue', Abstract_deadline='$abstractDeadline', Pub_date='$pubDate', Pub_time='$pubTime', Max_cap='$max', 
    Description='$description', Event_name='$eventName', Type='$type', City='$city', State='$state', Street='$street', Zip='$zip', Status='$status', End_date='$endDate', End_time='$endTime', Uni_id=$university
    where Event_id=$eventId;";

    try {
        //execute the query
        $update = mysqli_query($mysqli, $sql);
        header('location:./home.php');
    } catch (Exception $e) {
        echo '
        <script>
            window.location.href="./home.php";
            alert("Update of selected event failed. Please try again.")
        </script>
        ';
    }
}
//close connection
$mysqli->close();
?>
