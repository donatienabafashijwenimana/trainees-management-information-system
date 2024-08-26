<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="header">
        trainee information management information system 
    </div>
    <div class="form">
        <form action="#" method="post">
            <div class="hf">login</div>
            <label for="">username</label>
            <input type="text" name="uname" id="">
            <label for="">password</label>
            <input type="password" name="password" id="">
            <input type="submit" value="login" name='create'>
            <a href="register.php">create account</a>
        </form>
    </div>
</body>
</html>
<?php
session_start();
include 'connect.php';
if(isset($_POST['create'])){
    $uname=$_POST['uname'];
    $password = $_POST['password'];
    $select = $conn->query("select*from user where uname='$uname' and password='$password'");
    if(mysqli_num_rows($select)>0){
       
       $row= mysqli_fetch_array($select);
       $_SESSION['id']=$row['uid'];
       $_SESSION['uname']= $row['uname'];
       ?>
        <script>
            alert('<?=$uname ?> login sucessfully')
            window.location.href='php/home.php'
        </script><?php
        

    }else{
        ?>
        <script>
            alert('login failed')
        </script><?php
    }
}