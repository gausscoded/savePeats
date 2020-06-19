<?php
$host = "localhost";
$user = "root";
$password = '';
$db_name = "savepeats";

$con = mysqli_connect($host, $user, $password, $db_name);
if(mysqli_connect_errno()) {
    die("Failed to connect with MySQL: ". mysqli_connect_error());
}
$sql = "INSERT INTO login(firstname, lastname, email)
VALUES ('Gogo', 'Gulberdi', 'gogo.gulberdi@gmail.com')";
?>

//<?php
//$servername = "localhost";
//$username   = "username";
//$password   = "password";
//$dbname     = "dbname";
//
////Create connection
//$conn = mysqli_connect($servername, $username, $password, $dbname);
//
////Check connection
//if (!$conn){
//    die("Connection failed:" .mysqli_connect_error());
//}
//$sql = "INSERT INTO dbtable (firstname, lastname, email)
//VALUES ('Gogo', 'Gulberdi','gogo.gulberdi@gmail.com')";
//
//if (mysqli_query($conn,$sql)) {
//    echo "New user successfully added ";
//}else{
//    echo "Error:" .$sql . "<br>" .mysqli_error($conn);
//}
//
//mysqli_close($conn);
//?>


