<?php

session_start();

include("../api/koneksi.php");

$username=$_POST['username'];
$password=$_POST['password'];

$query=pg_query($conn,"
SELECT *
FROM admin
WHERE username='$username'
AND password='$password'
");

if(pg_num_rows($query)>0){

$_SESSION['login']=true;

header("Location:dashboard.php");

}else{

echo"

<script>

alert('Username atau Password salah');

location='login.php';

</script>

";

}

?>