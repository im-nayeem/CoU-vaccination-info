<?php 
$title = "Student's Information";
require 'includes/connect_db.php';
include 'includes/header&sidebar.php';
?>

<div class="content">
<?php

    if($_SERVER['REQUEST_METHOD']=="GET") //extract data from $_GET to print details
    {

        $table=""; //varibles to extract data from $_GET which will be used in query
        $entty="";
        $value="";
        $sort_by="";

        
        if(isset($_GET['entty']) and isset($_GET['value'])) //extract entity name and value from $_GET
                {
                    $entty = $_GET['entty'];
                    $table = $tables[$entty];
                    $value = $_GET['value'];
                }
        if(isset($_GET['sort_by']))
                $sort_by=$_GET['sort_by'];
        
        if($entty!='' and $value!='') 
            {
                $conn=getDB();
                $sql = "SELECT * FROM {$table} WHERE {$entty}='{$value}'";
                if($sort_by!='' and $table==$tables[$sort_by])
                    $sql=$sql." ORDER BY {$sort_by} ASC";
                $arr=get_element($conn,$sql);

                    if(sizeof($arr)==1) //if there is single element extract vaccination info
                    {
                        if($table=='student')
                        {
                            $sql = "SELECT
                            vaccination_info.vaccination_id,
                            vaccination_info.vaccine_name,
                            vaccination_info.vaccination_date,
                            vaccination_info.first_dose,
                            vaccination_info.second_dose,
                            side_effect.fever,
                            side_effect.headache,
                            side_effect.vomitting,
                            side_effect.other_effect 
                            FROM vaccination_info,side_effect
                            WHERE vaccination_info.id={$arr[0]['id']} and 
                            vaccination_info.vaccination_id = side_effect.vaccination_id";
                            
                            $arr_v=get_element($conn,$sql);
                            $arr_v=array_merge($arr,$arr_v); //merge vaccination info with basic info(join)
                        }
                        else
                            $arr_v=$arr;
                            
                    }
                    if($entty=='vaccinated' and ($value=='Yes' or $value=='yes'))
                    {
                        $sql="SELECT
                            student.name,
                            student.id,
                            student.department,
                            student.session,
                            vaccination_info.vaccination_id,
                            vaccination_info.vaccine_name,
                            vaccination_info.vaccination_date,
                            vaccination_info.first_dose,
                            vaccination_info.second_dose,
                            side_effect.fever,
                            side_effect.headache,
                            side_effect.vomitting,
                            side_effect.other_effect 
                            FROM student INNER JOIN vaccination_info ON 
                            student.id = vaccination_info.id INNER JOIN side_effect
                            ON
                            vaccination_info.vaccination_id=side_effect.vaccination_id";

                            if($sort_by!='')
                                $sql=$sql." ORDER BY {$tables[$sort_by]}.{$sort_by} ASC";

                            $arr=get_element($conn,$sql);
                    }
                    
            }
        }
        
    ?>
   
     
<?php if(!empty($arr) and sizeof($arr)>1):?> <!--if number of element is not one then print all-->
    <h2>Student's Information:</h2>
    <?php if($_SERVER['REQUEST_METHOD']=="GET"):?>
        <p>Information based on <?=$entity[$entty];?>: <?=$value;?>.[Total: <?=sizeof($arr);?>] (Click on any data to get details)</p>
    <?php endif;?>
    <div class="multiple">
    <table>
    <tr>
         <!----set table header----->
       <?php foreach($arr[0] as $key=>$value):?> 
        <?php if($key=='email')continue;?> 
         <th><?=$entity[$key]?></th> 
       <?php endforeach;?>
     </tr>
    <!-----print all the element------>
   <?php foreach($arr as $data):?>
     <tr>
     <?php foreach($data as $key=>$value):?>
        <?php if($key=='email')continue;?>
        <td><a href="view.php?entty=<?=$key?>&value=<?=$value?>"><?=$value?></a></td>
       <?php endforeach; ?>
     <?php endforeach;?>
 </table>
 </div>
 <?php endif;?>


    
 <?php if(!empty($arr) and sizeof($arr)==1):?> <!---if number of element is single then print details-->
   
  <div class="single">
    <h2>Student's Information:</h2>
    <p>Information based on <?=$entity[$entty];?>: <?=$value;?>.<br>(Click on any data to get details)</p>
    <table>
    <?php foreach($arr_v as $data):?>
     <?php foreach($data as $key=>$value):?>
        <?php if($key=='email')continue;?>
        <tr>
            <th><?=$entity[$key]?>:</th>
            <td><a href="view.php?entty=<?=$key?>&value=<?=$value?>"><?=$value?></a></td>
     </tr>
       <?php endforeach; ?>
     <?php endforeach;?>
     </table>
  </div>
<?php endif;?>
    
</div>

<?php include 'includes/footer.php';?>