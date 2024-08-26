<?php
include '../connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $select = $conn->query("select*from marks,trade,trainee,modules,user 
    where sid=traineeid and tid=marks.tradeid and uid=userid and mid=marks.moduleid and tid='{$_GET['view']}' and  sid='{$_GET['sid']}'");
    $selecttot = $conn->query("select sum(total),sum(total)/count(*) as per,count(*)*100 as totalm,count(*) as a from marks where tradeid='{$_GET['view']}' and  traineeid='{$_GET['sid']}'");
     $selectp = $conn->query("select count(*) as a from trainee where tradeid='{$_GET['view']}'");
     $totp = mysqli_fetch_array($selectp);
    $t= mysqli_fetch_array($selecttot);
        $x = mysqli_fetch_array($select);

        if (mysqli_num_rows($select)>0) {
          
?>
    <div class="table">
    <div class="pdf"><button onclick='pdf()'>download pdf ></button></div>

       <table border='1' width='100%'>
          <tr>
            <td>name</td>
            <td colspan='4'><?=$x['firstname'].' '.$x['lastname']?></td>
          </tr>
          <tr>
            <td>class</td>
            <td colspan='4'><?=$x['tname']?></td>
          </tr>
            <tr>
          <td>module</td>
          <td colspan="4">marks</td>

            </tr>
            <tr>
                <td></td>
                <td>fa</td>
                <td>sa</td>
                <td>ca</td>
                <td>tot</td>
            </tr>
        <?php $y=1; foreach($select as $x){?>
            
            <tr>
                <td><?=$x['mname']?></td>
                <td><?=$x['fass']?></td>
                <td><?=$x['sass']?></td>
                <td><?=$x['cass']?></td>
                <td><?=$x['total']?></td>
            </tr>
            <?php }?>
            <tr>
              <th>totalmarks</th>
              <th colspan='4'><?=$t['sum(total)']?>/<?=$t['totalm']?></th>
            </tr>
            <tr>
              <th>percentage</th>
              <th colspan='4'><?=round($t['per'],2)?>%</</th>
            </tr>
            <tr>
              <th>position</th>
              <th colspan='4'><?=$_GET['p']?>/<?=$totp['a']?></</th>
            </tr>
       </table>
    </div>
<?php
        }else {
          ?>
          <h1>!! no result available</h1>
          <?php
        }
        ?>
 
</body>
</html>
<script src="html2.js"></script>
<script src="html2.js"></script>
<script>
    
        let a = document.querySelector("table");
    function pdf(){
        a.style.margin='1pc'
        html2pdf().from(a).save('report-<?=$x['firstname'].' '.$x['lastname']?>');
    }
</script>

