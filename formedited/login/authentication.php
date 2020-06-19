<?php
include('connection.php');
$username = $_POST['user'];
$password = $_POST['pass'];
$targetfile = 'payrest.php';


//to prevent from mysqli injection
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

//password '111611010110510899' for username 'client1'
//client2 '211611010110510899'
//for it doing loap...

$sql = "select *from login where username = '$username' and password = '$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if($count == 1){
 echo "<h1><center> Login successful </center></h1>";
    echo "<a href='../payrest.php'>ссылка</a>";

}
else{
    echo "<h1> Login failed. Invalid username or password.</h1>";
}
?>