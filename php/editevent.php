<?php
if(!isset($_GET['Event_id'])) {
    header("location:./home.php");
}
session_start();
include("connection.php");

$userId = $_SESSION["UserID"];
$eventId = $_GET['Event_id'];
$_SESSION['eventId'] = $eventId;


//create the query
$sql = "select * from event where Event_id=$eventId;";
$query = "select * from university;";

try {
    //execute the query
    $result = mysqli_query($mysqli, $sql);
    $event = $result->fetch_assoc();

    //execute the query
    $outcome = mysqli_query($mysqli, $query);
} catch (Exception $e) {
    echo '
    <script>
        window.location.href="./home.php";
        alert("Retrieval of the event you want to edit has failed. Please try again.")
    </script>
    ';
}
?>

<!doctype html>
<html class="mx-0">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Home</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link href="../css/styles.css" rel="stylesheet">

    </head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="./home.php">AEM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active mr-3" href="./home.php">Your Events <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active mr-3" href="./enrolledevents.php">Your Enrolled Events</a>
                <a class="nav-item nav-link active mr-3" href="./activeevents.php">Active Events</a>
                <a class="nav-item nav-link active" href="./allevents.php">All Events</a>
            </div>
        </div>
        
        <a href="./logout.php">
            <button type="button" class="btn btn-danger" name="logout">Logout</button>
        </a>
    </nav>

    <body class="mx-0"> 
            <form action="./updateevent.php" method='post' class="d-flex flex-column border-bottom border-top">
                <div>
                    <button type="submit" name="update" class="btn btn-primary btn-lg ml-4 mt-2 mb-2">Update</button>
                </div>
                
                <h1 class="display-4 text-center mt-4"><input value="<?php echo $event['Event_name']; ?>" required type="text" name="eventName"class="text-center" placeholder="Event Name"></h1>

                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75">
                        <b>Start date</b><br>
                        <input value="<?php echo $event['Start_date']; ?>" required type="date" name="startDate"class="text-center">                                   
                    </div>
                    <div class="w-75">
                        <b>Start time</b><br>
                        <input value="<?php echo $event['Start_time']; ?>" required type="time" name="startTime"class="text-center">                          
                    </div>
                    <div class="w-75">
                        <b>Venue</b><br>
                        <input value="<?php echo $event['Venue']; ?>" required type="text" name="venue"class="text-center">                     
                    </div>
                </div>
                
                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75">
                        <b>Abstract deadline</b><br>
                        <input value="<?php echo $event['Abstract_deadline']; ?>" required type="date" name="abstractDeadline"class="text-center">               
                    </div>
                    <div class="w-75">
                        <b>Max cap</b><br>
                        <input value="<?php echo $event['Max_cap']; ?>" required type="text" name="max"class="text-center"> 
                    </div>
                    <div class="w-75">
                        <b>City</b><br>
                        <input value="<?php echo $event['City']; ?>" required type="text" name="city"class="text-center"> 
                    </div>
                </div>

                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75">
                        <b>State</b><br>
                        <input value="<?php echo $event['State']; ?>" required type="text" name="state"class="text-center"> 
                    </div>
                    <div class="w-75">
                        <b>Street</b><br>
                        <input value="<?php echo $event['Street']; ?>" required type="text" name="street"class="text-center">   
                    </div>
                    <div class="w-75">
                        <b>Zip</b><br>
                        <input value="<?php echo $event['Zip']; ?>" required type="text" name="zip"class="text-center"> 
                    </div>
                </div>

                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75">
                        <b>Status</b><br>
                        <select name="status">
                        <?php 
                                if($event['Status'] == "Active"){
                                    echo "<option value='Active' selected>Active</option>";
                                    echo "<option value='Canceled'>Canceled</option>";
                                    echo "<option value='Postponed'>Postponed</option>";
                                }
                                else if($event['Status'] == "Canceled"){
                                    echo "<option value='Active'>Active</option>";
                                    echo "<option value='Canceled' selected>Canceled</option>";
                                    echo "<option value='Postponed'>Postponed</option>";                                
                                } else{
                                    echo "<option value='Active'>Active</option>";
                                    echo "<option value='Canceled'>Canceled</option>";
                                    echo "<option value='Postponed' selected>Postponed</option>";                                
                                }
                            ?>
                        </select>                   
                    </div>
                    <div class="w-75">
                        <b>End date</b><br>
                        <input value="<?php echo $event['End_date']; ?>" required type="date" name="endDate"class="text-center"> 
                    </div>
                    <div class="w-75">
                        <b>End time</b><br>
                        <input value="<?php echo $event['End_time']; ?>" required type="time" name="endTime"class="text-center"> 
                    </div>
                </div>

                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75">
                        <b>Type</b><br>
                        <select name="type">
                            <?php 
                                if($event['Type'] == "Oral Presentation"){
                                    echo "<option value='Oral Presentation' selected>Oral Presentation</option>";
                                    echo "<option value='Poster'>Poster</option>";
                                    echo "<option value='Online'>Online</option>";
                                }
                                else if($event['Type'] == "Poster"){
                                    echo "<option value='Oral Presentation'>Oral Presentation</option>";
                                    echo "<option value='Poster' selected>Poster</option>";
                                    echo "<option value='Online'>Online</option>";                                
                                } else{
                                    echo "<option value='Oral Presentation'>Oral Presentation</option>";
                                    echo "<option value='Poster'>Poster</option>";
                                    echo "<option value='Online' selected>Online</option>";                                
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="w-75">
                        <b>Description</b><br>
                        <input value="<?php echo $event['Description']; ?>" required type="text" name="description"class="text-center"> 
                    </div>

                    <div class="w-75">
                        <b>University</b><br>
                        <select required name="university">
                            <?php while($uni = $outcome->fetch_assoc()) {?>
                                <?php 
                                    if($event['Uni_id'] == $uni['Uni_id']){
                                        echo "<option value=".$event['Uni_id']." selected>" .$uni['Uni_name']. "</option>";
                                    }
                                    else{
                                        echo "<option value=".$uni['Uni_id'].">" .$uni['Uni_name']. "</option>";
                                    }
                                ?>
                            <?php } ?>
                        </select>                    
                    </div>
                </div>
                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75">
                        <b>Publish date</b><br>
                        <input value="<?php echo $event['Pub_date']; ?>" required type="date" name="pubDate"class="text-center">                                   
                    </div>
                    <div class="w-75">
                        <b>Publish time</b><br>
                        <input value="<?php echo $event['Pub_time']; ?>" required type="time" name="pubTime"class="text-center">                          
                    </div>
                </div>
            </form>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>

<?php
//close connection
$mysqli->close();
?>