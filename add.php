<?php $page="add"; //add var page to add active class in sidebar button
$title="Add New Data";  //title for the page
require 'includes/connect_db.php';//requires php file that contain code to connect DB

$conn=getDB(); 
//get connection to database from getBD() in connect_db.php file

?>
<?php 


        //--------------Validate input form------------------//
        $error=[];
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $second_dose="";
            if($_POST['vaccinated'] == "Yes" and isset($_POST['second_dose']) )
                $second_dose=$_POST['second_dose'];

                if(!isset($_POST['department']))
                    $error[]="Field <strong>Department</strong> can't be empty.";
            
            //check if vaccinated but didn't provide vaccination info 
            foreach($entity as $key => $value) // fetch key from $entity and check if it is found in post
                if($_POST['vaccinated'] == "Yes" and
                    (!isset($_POST[$key]) or $_POST[$key]==""))
                    if($key=="other_effect" or $key=="second_dose" or $key=="dept") //other_effect field can be empty
                        continue;
                    else
                        $error[]="Field <strong>{$value}</strong> can't be empty as you're vaccinated. Try again!";

            $sql="SELECT * FROM student WHERE id={$_POST['id']}";
            $duplicate=get_element($conn,$sql);
            if(!empty($duplicate))
                $error[]="There is another student with <strong>ID={$_POST['id']}</strong>. ID must be unique.";
        }
    // -----------End of Validation-----------------------//


/**If there is no error after validation and POST array in not empty then send data to database*/
if($_SERVER["REQUEST_METHOD"] == "POST" and empty($error) and !empty($_POST))
{
            $count=0;
           
            $sql="INSERT INTO student VALUES(?,?,?,?,?,?)";
            $stmt=prepare_sql($conn,$sql); // call function to prepare sql
            
            if($stmt) //if $stmt is not false then procced
            {
                    mysqli_stmt_bind_param($stmt,"sssiss",$_POST['name'],$_POST['email'],$_POST['department'],$_POST['id'],$_POST['session'],$_POST['vaccinated']);
                    $count+=is_success($stmt,$conn);

                    if($_POST['vaccinated']=="No" and $count==1)//if not vaccinated and inserted successfully then redirect
                        {
                            redirect("view.php?entty=id&value={$_POST['id']}");
                            exit;
                        }
            }

    /** if vaccinated then send vaccination information to vaccination table*/
            if($_POST['vaccinated']=="Yes")
            {
                $sql = "INSERT INTO vaccination_info VALUES(?,?,?,?,?,?)";
                $stmt = prepare_sql( $conn , $sql );
                
                if($stmt)
                {
                    mysqli_stmt_bind_param($stmt,"isssss",$_POST['id'],$_POST['vaccination_id'],$_POST['vaccine_name'],$_POST['vaccination_date'],$_POST['first_dose'],$second_dose);
                    
                    $count+=is_success($stmt,$conn);
                }

                $sql = "INSERT INTO side_effect VALUES( ?,?,?,?,?,? )";
                $stmt = prepare_sql($conn , $sql);

                if( $stmt )
                {

                    mysqli_stmt_bind_param($stmt,"isssss",$_POST['id'],$_POST['vaccination_id'],$_POST['fever'],$_POST['headache'],$_POST['vomitting'],$_POST['other_effect']);

                    $count+=is_success($stmt,$conn);
                }
            
                if($count==3) //if inserted into 3 tables successfully then redirect
                 {
                    redirect("view.php?entty=id&value={$_POST['id']}");
                     exit;
                 }
                else
                {
                    $sql="
                    DELETE FROM side_effect where id={$_POST['id']};
                     DELETE FROM vaccination_info where id={$_POST['id']};
                      DELETE FROM student where id={$_POST['id']};
                    ";
                    mysqli_multi_query($conn,$sql);
                    $error[]="Couldn't insert information.Try again!";
                }
            }
}
?>
<?php include 'includes/header&sidebar.php';?>

<div class="content">

<?php  // show statistics(little code added from stat.php)//
   

    /**function get number of element in an entity or get number of element based on entty */
          function getNum($sql)
          {
              global $conn;
              $result=mysqli_query($conn,$sql);
              return mysqli_fetch_array($result)[0];
          }

     //----total students and how many are vaccinated---//
          $total=getNum("SELECT count(*) FROM student;");

          $vaccinated=getNum("SELECT count('vaccinated') FROM student where vaccinated='Yes';");

          $v_percent=0;
          if($total!=0)
            $v_percent=round(($vaccinated*1.0/$total)*100,1);
          
  //----how many students taken first and second dose----//
          $first_dose=getNum("SELECT count('first_dose') FROM vaccination_info where first_dose='Yes';");

          $second_dose=getNum("SELECT count('second_dose') FROM vaccination_info where second_dose='Yes';");

          if($total!=0)
          {
              $first_dose = round(($first_dose*1.0/$total)*100,1);
              $second_dose = round(($second_dose*1.0/$total)*100,1);
          }

      //-----------side effects-------------//

        $total_effect=getNum("SELECT count(*) FROM side_effect where headache='Yes' 
        OR fever='Yes' OR vomitting='Yes' OR
         NOT ( other_effect='' OR other_effect='No' OR other_effect='Nothing');");

          $headache=getNum("SELECT count('headache') FROM side_effect where headache='Yes';");

          $fever=getNum("SELECT count('fever') FROM side_effect where fever='Yes';");

          $vomitting=getNum("SELECT count('vomitting') FROM side_effect where vomitting='Yes';");

          $other_effect=getNum("SELECT count('other_effect') FROM side_effect where NOT ( other_effect='' OR other_effect='No' OR other_effect='Nothing');");

          if($vaccinated!=0)
          {
            $total_effect = round(($total_effect*1.0/$vaccinated)*100,1);
              $fever = round(($fever*1.0/$vaccinated)*100,1);
              $headache = round(($headache*1.0/$vaccinated)*100,1);
              $vomitting = round(($vomitting*1.0/$vaccinated)*100,1);
              $other_effect = round(($other_effect*1.0/$vaccinated)*100,1);

          }
          
        
        ?>
<div class="stat">
    <strong>Vaccinated: </strong>
      <p>Total <?=$total;?> students have registered. Among them <?=$vaccinated;?> students are vaccinated.</p>
    <br>
    <?php if($total!=0):?>
        <div class="total shape">
                <div class="shape done"  style="height:24px;
                width:<?=$v_percent;?>%">
                     <?=$v_percent;?>%
                </div>
          </div>
          <h5><?=$v_percent;?>% students are vaccinated.</h5>
     <?php endif;?>
          
</div>

<!-----End of Stat---------->

<?php
      include 'includes/form.php'; //-----include form-----//

?>




    <!---------If there is error found in validation print errors ---->
            <?php if(!empty($error)):?>
                <?php foreach($error as $vul):?> 
                        <li><strong>Error:</strong> <?=$vul;?></li>
                <?php endforeach;?>
            <?php endif;?>


        
      



 </div> <!-- end of content div -->


<?php include 'includes/footer.php';?>
