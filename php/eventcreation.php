<?php
session_start();
include("connection.php");

$userId = $_SESSION["UserID"];

if (isset($_POST["create"])) 
{
    //get submited event details
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
    //create the query
    $sql = "insert into event (Start_date, Start_time, Venue, Abstract_deadline, Max_cap, Description, Event_name, Type, City, State, Street, Zip, Status, End_date, End_time, User_id, Uni_id)
    values ('$startDate','$startTime','$venue','$abstractDeadline','$max','$description','$eventName','$type','$city','$state','$street','$zip','$status','$endDate','$endTime', $userId, $university);";

    try {
        $result = mysqli_query($mysqli, $sql);

        if($result){
            $event_id = mysqli_insert_id($mysqli);         
            
            $presenter1first = $_POST['presenter1first'];
            $presenter1last = $_POST['presenter1last'];
            $keynote1first = $_POST['keynote1first'];
            $keynote1last = $_POST['keynote1last'];

            $sql = "insert into presenters (Fname, Lname, Event_id)
            values ('$presenter1first', '$presenter1last', $event_id);";

            $result = mysqli_query($mysqli, $sql);

            $sql = "insert into keynote_speakers (Fname, Lname, Event_id)
            values ('$keynote1first', '$keynote1last', $event_id);";

            $result = mysqli_query($mysqli, $sql);

            if($_POST['sponsor1'])
            {
                $sponsor1 = $_POST['sponsor1'];

                $sql = "insert into sponsors (Spon_name, Event_id)
                values ('$sponsor1', $event_id);";

                $result = mysqli_query($mysqli, $sql);
            }

            if($_POST['sponsor2'])
            {
                $sponsor2 = $_POST['sponsor2'];

                $sql = "insert into sponsors (Spon_name, Event_id)
                values ('$sponsor2', $event_id);";

                $result = mysqli_query($mysqli, $sql);
            }

            if($_POST['sponsor3'])
            {
                $sponsor3 = $_POST['sponsor3'];

                $sql = "insert into sponsors (Spon_name, Event_id)
                values ('$sponsor3', $event_id);";

                $result = mysqli_query($mysqli, $sql);
            }

            if($_POST['presenter2first'] && $_POST['presenter2last'])
            {
                $presenter2first = $_POST['presenter2first'];
                $presenter2last = $_POST['presenter2last'];

                $sql = "insert into presenters (Fname, Lname, Event_id)
                values ('$presenter2first', '$presenter2last', $event_id);";

                $result = mysqli_query($mysqli, $sql);
            }

            if($_POST['presenter3first'] && $_POST['presenter3last'])
            {
                $presenter3first = $_POST['presenter3first'];
                $presenter3last = $_POST['presenter3last'];

                $sql = "insert into presenters (Fname, Lname, Event_id)
                values ('$presenter3first', '$presenter3last', $event_id);";

                $result = mysqli_query($mysqli, $sql);
            }

            if($_POST['keynote2first'] && $_POST['keynote2last'])
            {
                $keynote2first = $_POST['keynote2first'];
                $keynote2last = $_POST['keynote2last'];

                $sql = "insert into keynote_speakers (Fname, Lname, Event_id)
                values ('$keynote2first', '$keynote2last', $event_id);";

                $result = mysqli_query($mysqli, $sql);
            }

            if($_POST['keynote3first'] && $_POST['keynote3last'])
            {
                $keynote3first = $_POST['keynote3first'];
                $keynote3last = $_POST['keynote3last'];

                $sql = "insert into keynote_speakers (Fname, Lname, Event_id)
                values ('$keynote3first', '$keynote3last', $event_id);";

                $result = mysqli_query($mysqli, $sql);
            }
        }

        header("location: ./home.php");

    } catch (mysqli_sql_exception $e) {
        echo '
        <script>
            window.location.href="./createevent.php";
            alert("Failed to create event. Please try again.")
        </script>
        ';
        } 
}

//close connection
$mysqli->close();
?>