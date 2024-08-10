<?php
session_start();
include("connection.php");

$userId = $_SESSION["UserID"];

//create the query
$sql = "select * from university;";

try {
    //execute the query
    $result = mysqli_query($mysqli, $sql);
} catch (Exception $e) {
    echo '
    <script>
        alert("Retrieval of universities failed. Please refresh.")
    </script>
    ';
}

//close connection
$mysqli->close();
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
        <form action="./eventcreation.php" method='post'>
            <button type="submit" name="create" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg ml-4 mt-2 mb-2">Done</button>

            <div class="d-flex flex-column border-bottom border-top">
                <h1 class="display-4 text-center mt-4"><input required type="text" name="eventName"class="text-center" placeholder="Event Name"></h1>

                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75">
                        <b>Start date</b><br>
                        <input required type="date" name="startDate"class="text-center">                                   
                    </div>
                    <div class="w-75">
                        <b>Start time</b><br>
                        <input required type="time" name="startTime"class="text-center">                          
                    </div>
                    <div class="w-75">
                        <b>Venue</b><br>
                        <input required type="text" name="venue"class="text-center">                     
                    </div>
                </div>
                
                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75">
                        <b>Abstract deadline</b><br>
                        <input required type="date" name="abstractDeadline"class="text-center">               
                    </div>
                    <div class="w-75">
                        <b>Max cap</b><br>
                        <input required type="text" name="max"class="text-center"> 
                    </div>
                    <div class="w-75">
                        <b>City</b><br>
                        <input required type="text" name="city"class="text-center"> 
                    </div>
                </div>

                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75">
                        <b>State</b><br>
                        <input required type="text" name="state"class="text-center"> 
                    </div>
                    <div class="w-75">
                        <b>Street</b><br>
                        <input required type="text" name="street"class="text-center">   
                    </div>
                    <div class="w-75">
                        <b>Zip</b><br>
                        <input required type="text" name="zip"class="text-center"> 
                    </div>
                </div>

                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75">
                        <b>Status</b><br>
                        <select name="status">
                            <option value="Active">Active</option>
                            <option value="Canceled">Canceled</option>
                            <option value="Postponed">Postponed</option>
                        </select>                   
                    </div>
                    <div class="w-75">
                        <b>End date</b><br>
                        <input required type="date" name="endDate"class="text-center"> 
                    </div>
                    <div class="w-75">
                        <b>End time</b><br>
                        <input required type="time" name="endTime"class="text-center"> 
                    </div>
                </div>

                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75">
                        <b>Type</b><br>
                        <select name="type">
                            <option value="Oral Presentation">Oral Presentation</option>
                            <option value="Poster">Poster</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    
                    <div class="w-75">
                        <b>Description</b><br>
                        <input required type="text" name="description"class="text-center"> 
                    </div>

                    <div class="w-75">
                        <b>University</b><br>
                        <select required name="university">
                            <?php while($row = $result->fetch_assoc()) {?>
                            <option value="<?php echo $row['Uni_id']?>"><?php echo $row['Uni_name']?></option>
                            <?php } ?>
                        </select>                    
                    </div>
                </div>

                <div class="d-flex justify-content-evenly text-center text-break mb-4">
                    <div class="w-75 d-flex flex-column align-items-center">
                        <div><b>Sponsors</b></div>
                        <input placeholder="Sponsor 1" class="mb-2" type="text" name="sponsor1"class="text-center"> 
                        <input placeholder="Sponsor 2" class="mb-2" type="text" name="sponsor2"class="text-center"> 
                        <input placeholder="Sponsor 3" class="mb-2" type="text" name="sponsor3"class="text-center"> 
                    </div>

                    <div class="w-75 d-flex flex-column align-items-center">
                        <div><b>Presenters</b></div>
                        <div>
                            <input placeholder="First name" required class="mb-2" type="text" name="presenter1first"class="text-center"> 
                            <input placeholder="Last name" required class="mb-2" type="text" name="presenter1last"class="text-center"> 
                        </div>
                        <div>
                            <input placeholder="First name" class="mb-2" type="text" name="presenter2first"class="text-center"> 
                            <input placeholder="Last name" class="mb-2" type="text" name="presenter2last"class="text-center"> 
                        </div>
                        <div>
                            <input placeholder="First name" class="mb-2" type="text" name="presenter3first"class="text-center"> 
                            <input placeholder="Last name"  class="mb-2" type="text" name="presenter3last"class="text-center"> 
                        </div>
                    </div>

                    <div class="w-75 d-flex flex-column align-items-center">
                        <div><b>Keynote speakers</b></div>
                            <div>
                                <input placeholder="First name" required class="mb-2" type="text" name="keynote1first"class="text-center"> 
                                <input placeholder="Last name" required class="mb-2" type="text" name="keynote1last"class="text-center"> 
                            </div>
                            <div>
                                <input placeholder="First name" class="mb-2" type="text" name="keynote2first"class="text-center"> 
                                <input placeholder="Last name" class="mb-2" type="text" name="keynote2last"class="text-center"> 
                            </div>
                            <div>
                                <input placeholder="First name" class="mb-2" type="text" name="keynote3first"class="text-center"> 
                                <input placeholder="Last name" class="mb-2" type="text" name="keynote3last"class="text-center"> 
                            </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>