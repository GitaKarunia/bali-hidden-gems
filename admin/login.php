<?php
session_start();

if(isset($_SESSION['login'])){
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Login Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

height:100vh;

display:flex;

justify-content:center;

align-items:center;

background:linear-gradient(135deg,#00b09b,#96c93d);

}

.login-box{

width:400px;

background:white;

padding:40px;

border-radius:20px;

box-shadow:0 10px 40px rgba(0,0,0,.2);

}

h1{

text-align:center;

margin-bottom:30px;

color:#0f766e;

}

input{

width:100%;

padding:15px;

margin-bottom:20px;

border-radius:10px;

border:1px solid #ccc;

font-size:16px;

}

button{

width:100%;

padding:15px;

background:#0f766e;

color:white;

border:none;

border-radius:10px;

font-size:18px;

cursor:pointer;

transition:.3s;

}

button:hover{

background:#115e59;

}

</style>

</head>

<body>

<div class="login-box">

<h1>Admin Login</h1>

<form action="proses_login.php" method="POST">

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button>LOGIN</button>

</form>

</div>

</body>
</html>