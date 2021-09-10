<?php
    $title = "Visitors";
    include 'includes/connect_db.php';
    $conn=getDB();
    $sql="select * from visitor";
$ar=get_element($conn,$sql);

$arr=$ar[0];
    
    include 'includes/header&sidebar.php';
   
?>  
<div class="content">
        <h3>Unique: <?=sizeof($ar);?></h3>
        <table>
            <tr>
                <th>IP</th>
                <th>Visited</th>
                <th>City</th>
                <th>Map</th>
            </tr>
            
            <?php foreach($ar as $arr):?>
            <tr><?php foreach($arr as $value):?>
                <td><?=$value;?></td>
                <?php endforeach;?></tr>
                <?php endforeach;?>
        </table>
        
       



      </div>
      
    <?php include 'includes/footer.php';?>