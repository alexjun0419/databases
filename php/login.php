<?php
session_start();
include("connection.php");

if (isset($_POST["submit"])) {
    //get submited credentials
    $email = $_POST['email'];
    $password = $_POST['password'];

    //create the query
    $sql = "select * from user where email='$email' and password='$password';";

    //execute the query
    $result = mysqli_query($mysqli, $sql);

    //convert result from query to array
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($row) { //if the user was found
        $_SESSION['Email'] = $row['Email'];
        $_SESSION['Password'] = $row['Password'];
        $_SESSION['UserID'] = $row['User_id'];

        header("Location:home.php");
    } else {  //if the user was not found
        echo '
        <script>
            window.location.href="../index.php";
            alert("Signin failed. Invalid email or password.")
        </script>
        ';
    }
}

//close connection
$mysqli->close();
?>