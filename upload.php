<?php
$servername="localhost";
$username="root";
$password="Routesoft-Admin";
$dbname="freelancing";

//connect to database
$conn=new mysqli($servername, $username, $password, $dbname);

//check if connection was successfully
if($conn->connect_error){
  die("connect_failed" .$conn->connect_erro);
}
echo "connection was successful <br>";

//into data into our database
$sql="INSERT INTO support(Your_computer_issue, contacts)
VALUES('Audio_problem', 0704656765)";

//check if data was inserted succesfully
if($conn->query($sql)===TRUE){
  echo("Data was inserted successfully <br>");
}
else{
  echo "Error:" .$sql   .$conn->error;
}
echo "Today's date is: ", date('Y-M-D');



?>
