
<!-- using this we are establishing our connection with the database
i.e employee which is running in localhost server -->
<?php

// this means if there is any error , don't show it in the web page
error_reporting(0);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if($conn){
    // echo "Connection OK";
}

else{
    // this will print the connection failed if there is some issue and rest part will show
    // the reason for an error.
    echo "Connection Failed".mysqli_connect_error();
}

?>