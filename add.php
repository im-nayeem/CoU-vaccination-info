<?php $page="add"; //add var page to add active class in sidebar button
$title="Add New Data";  //title for the page
include 'includes/header&sidebar.php';
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
            
            //check if vaccinated but didn't provide vaccination info 
            foreach($entity as $key => $value) // fetch key from $entity and check if it is found in post
                if($_POST['vaccinated'] == "Yes" and
                    (!isset($_POST[$key]) or $_POST[$key]==""))
                    if($key=="other_effect" or $key=="second_dose") //other_effect field can be empty
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
            }
}
?>

<div class="content">

<?php include 'includes/stat.php'; //include stat.php to show statistics//
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
