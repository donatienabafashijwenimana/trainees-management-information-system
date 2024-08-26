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
            <div class="hf">create account</div>
            <label for="">username</label>
            <input type="text" name="uname" id="">
            <label for="">password</label>
            <input type="password" name="password" id="">
            <input type="submit" value="create" name='create'>
            <a href="login.php">login</a>
        </form>
    </div>
</body>
</html>
<?php
include 'connect.php';
if(isset($_POST['create'])){
    $uname=$_POST['uname'];
    $password = $_POST['password'];
    $select = $conn->query("select*from user where uname='$uname'");
    if (!preg_match('/^[a-zA-Z]*$/',$uname)) {
        ?>
        <script>
           alert('incorect username')
        </script><?php

    }elseif(mysqli_num_rows($select)>0){
        ?>
        <script>
            alert('username exist')
        </script><?php
    }elseif (strlen($password)!==4) {
        ?>
        <script>
            alert('incorect password')
        </script><?php
    }else{
        $insert = $conn->query("insert into user values(null,'$uname','$password')");
        if ($insert) {
            ?>
        <script>
            alert('school manager registered')
        </script><?php
        }

    }
}
?>