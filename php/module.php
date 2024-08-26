<?php
include '../connect.php';
$select = $conn->query("select*from modules");
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
        <label for="">modules</label>
        <a href="?modules&&add" class='add'><button>add</button></a>
       <table border='1' width='100%'>
        <thead>
            <td>moduleid</td>
            <th>modulename</th>
            <th>credit</th>
            <th colspan='2'>action</th>
        </thead>
        <?php $y=1; foreach($select as $x){?>
            <tr>
                <td><?=$y++?></td>
                <td><?=$x['mname']?></td>
                <td><?=$x['mcredit']?></td>
                <td><a href="?modules&&up=<?=$x['mid']?>"><button>update</button></a></td>
                <td><a onclick="return confirm('are you sure you want to delete <?=$x['mname']?>')" href="delete.php?modules=<?=$x['mid']?>"><button>delete</button></a></td>
            </tr>
            <?php }?>
       </table>
    </div>
    <div class='<?=isset($_GET['add'])?"form":"formh"?>'>
         
        <form action="add.php" method="post">
            <a href='?modules' class="close">&times;</a>
            <div class="hf">add module</div>
            <label for="">module name</label>
            <input type="text" name="mname" id="">
            <label for="">module credit</label>
            <input type="number" name="credit" id="" min='1'>
            <input type="submit" value="add module" name='addmodule'>
        </form>
    </div>
    <div class='<?=isset($_GET['up'])?"form":"formh"?>'>
         <?php 
         $select2 = $conn->query("select*from modules where mid='{$_GET['up']}'") ;
         $z= mysqli_fetch_array($select2);
         ?>
        <form action="add.php" method="post">
            <a href='?modules' class="close">&times;</a>
            <div class="hf">update module</div>
            <input type="hidden" name="id" value='<?=$_GET['up']?>'>
            <label for="">module name</label>
            <input type="text" name="mname" id="" value="<?=$z['mname']?>">
            <label for="">module credit</label>
            <input type="number" name="credit" id="" min='1' value="<?=$z['mcredit']?>">
            <input type="submit" value="update module" name='updatemodule'>
        </form>
    </div>
</body>
</html>

