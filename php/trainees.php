<?php
include '../connect.php';
$selectt = $conn->query("select*from trade");
$select = $conn->query("select* from trainee,trade where tradeid=tid");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="table">
        <label for="">trainees</label>
        <a href="?trainees&&add" class='add'><button>add</button></a>
       <table border='1' width='100%'>
        <thead>
            <td>trainee id</td>
            <th>trainee name</th>
            <th>gender</th>
            <th>trade</th>
            <th colspan='2'>action</th>
        </thead>
        <?php $y=1; foreach($select as $x){?>
            <tr>
                <td><?=$y++?></td>
                <td><?=$x['firstname']." ".$x['lastname']?></td>
                <td><?=$x['gender']?></td>
                <td><?=$x['level'].' '.$x['tname']?></td>
                <td><a href="?trainees&&up=<?=$x['sid']?>"><button>update</button></a></td>
                <td><a onclick="return confirm('are you sure want to delete <?=$x['firstname'].' '.$x['lastname']?>')"  href="delete.php?trainee=<?=$x['sid']?>"><button>delete</button></a></td>
            </tr>
            <?php }?>
       </table>
    </div>
    <div class='<?=isset($_GET['add'])?"form":"formh"?>'>
         
        <form action="add.php" method="post">
            <a href='?trainees' class="close">&times;</a>
            <div class="hf">add trainee</div>
            <label for="">first name</label>
            <input type="text" name="fname" id="" pattern="^[a-zA-Z]{3-20}$">
            <label for="">last name</label>
            <input type="text" name="lname" id="" pattern="^[a-zA-Z]{3-20}$" >
            <label for="g">gender</label>
            <input type="radio" name="gender" value='male' checked>male
            <input type="radio" name="gender" value='female'>female
            <select name="tradeid" id="">
                <?php foreach($selectt as $z){?>
                    <option value="<?=$z['tid']?>"><?=$z['level'].' '.$z['tname']?></option>
                    <?php }?>
            </select>
            <input type="submit" value="add trainee" name='addtrainee'>
        </form>
    </div>
    <div class='<?=isset($_GET['up'])?"form":"formh"?>'>
         <?php 
         $select2 = $conn->query("select* from trainee,trade where tradeid=tid and sid='{$_GET['up']}'") ;
         $z= mysqli_fetch_array($select2);
         ?>
       <form action="add.php" method="post">
            <a href='?trainees' class="close">&times;</a>
            <div class="hf">update trainee</div>
            <input type="hidden" name="id" value='<?=$_GET['up']?>'>
            <label for="">first name</label>
            <input type="text" name="fname" value='<?=$z['firstname'];?>'>
            <label for="">last name</label>
            <input type="text" name="lname" id="" value=<?=$z['lastname'];?>>
            <label for="g">gender</label>
            <input type="radio" name="gender" value='male' <?=$z['gender']=='male'?"checked":"";?>>male
            <input type="radio" name="gender" value='female' <?=$z['gender']=='female'?"checked":"";?>>female
            <select name="tradeid" id="">
            <option value="<?=$x['tid']?>"><?=$z['level'].' '.$x['tname']?></option>
                <?php foreach($selectt as $z){?>
                    <option value="<?=$z['tid']?>"><?=$z['level'].' '.$z['tname']?></option>
                    <?php }?>
            </select>
            <input type="submit" value="update trainee" name='updatetrainee'>
        </form>
    </div>
</body>
</html>

