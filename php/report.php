<?php
include '../connect.php';
$selcttrade = $conn->query("select*from trade");
$selecttrainee = $conn->query("select*from trainee");
$selectmodule = $conn->query("select*from modules");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <label for="">report</label>
   <div class="report">
    <form action="#" method="post">
        <select name="trade" id="">
            <?php
            foreach($selcttrade as $y){?>
            <option value="<?=$y['tid']?>"><?=$y['level'].' '.$y['tname']?></option>
            <?php }?>
        </select>
        <input type="submit" value="generate" name='generate'>
    </form>
   </div>
   <?php if(isset($_POST['generate'])){
    $select = $conn->query("select*,sum(total)/count(*) as tot from trainee left join trade on trade.tid=tradeid left join 
    marks on marks.traineeid=sid left join modules on mid=moduleid left join user on uid=userid where tid='{$_POST['trade']}' 
    group by sid order by tot desc");
    if (mysqli_num_rows($select)<=0) {

    ?>
    <h1>!! no result found</h1>
    <?php }else{?>
        <div class="pdf"><button onclick='pdf()'>download  pdf ></button></div>
    <div class="table">
       <table border='1' width='100%'>
        <thead>
            <th>position</th>
            <th>trainee</th>
            <th>trade</th>
            <th>total marks</th>
            <th colspan='2' class='action'>action</th>
        </thead>
        <?php $y=1; foreach($select as $x){?>
            <tr>
                <td><?=$y++?></td>
                <td><?=$x['firstname'].' '.$x['lastname']?></td>
                <td><?=$x['level'].' '.$x['tname']?></td>
                <td><?=round($x['tot'])?>%</td>
                <td class='action'><a href="?view=<?=$x['tid']?>&&sid=<?=$x['sid']?>&&p=<?=$y++?>"><button>view</button></a></td>
            </tr>
            <?php } ?>
       </table>
    </div>
   
<?php 
    }
}else{?>
<h1>?select trade to view marks</h1>
<?php } 
?>
 
</body>
</html>
    <script src="html2.js"></script>
<script>
    
        let a = document.querySelector("table");
        let b = document.querySelector("th");
    function pdf(){
        
        html2pdf(a)..save("report-<?=$x['level'].' '.$x['tname']?>");
    }
    function submiting(e){
        // e.preventDefault();
        alert('js')
    }
    // submiting();
</script>
