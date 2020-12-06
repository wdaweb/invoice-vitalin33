<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>白金會員中心</title>
</head>
<body>
<h1>白金會員中心</h1>
<span ><a href="logout.php">登出</a></span>
<?php 
    session_start();
    if(isset($_SESSION['login'])){
    echo "尊爵的".$_SESSION['login']."你好，歡迎你";
    }
    ?>
  
</body>
</html>