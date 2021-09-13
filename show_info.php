<?php 

$page="show_info";
$title="All Information";
include 'includes/header&sidebar.php';
require 'includes/connect_db.php';

$conn = getDB();
?>

<div class="content">
    <?php include 'includes/stat.php';?><!--show stat-->
    <br>
<div class="stat">    
<hr>
<h3>Vaccination Info According to Department</h3>

<!-----------Form to get dept. name---------->
<form action="" class="case_stat" method="post">
            <select name="department"  required>
					<option selected disabled hidden>Select Department</option>
					<?php foreach($dept as $value):?>
						<option value="<?=$value;?>"><?=$value;?></option>
						<?php endforeach;?>
				</select>
               <button type="submit">Submit</button>
</form>

<?php 
    //------extract dept name and use it to query to get info------//
        $_name="CSE";
        if($_SERVER['REQUEST_METHOD']=="POST" and !empty($_POST['department']))
             $_name = $_POST['department'];

        
        $sql="select count(*) from student where department='{$_name}'";
        $case_total=getNum($sql);

        $sql="select count(*) from student where department='{$_name}' and vaccinated='Yes'";
        $case_vaccinated=getNum($sql);
        
        $percentage=0;
        if($case_total!=0)
             $percentage=round(($case_vaccinated*1.0/$case_total)*100,1);

?>
    <!------Show vaccination percentage bar-------->
<p><?=$case_vaccinated;?> students are vaccinated in department of <?=$_name;?> from total <?=$case_total;?> registered students.</p>

        <div class="total shape">
                <div class="shape done"  style="height:24px;
                width:<?=$percentage;?>%">
                     <?=$percentage;?>%
                </div>
          </div>        
        <h5><?=$percentage;?>% students are vaccinated in <?=$_name;?> department.</h5>
   
<br><br>
<hr>


<h3>Vaccination Info According to Session</h3>
<form action="" class="case_stat" method="post">
            <select name="session"  required>
					<option selected disabled hidden>Select Session</option>
					<?php foreach($session as $value):?>
						<option value="<?=$value;?>"><?=$value;?></option>
						<?php endforeach;?>
				</select>
               <button type="submit">Submit</button>
</form>

<?php 
//------extract session and use it to query to get info------//
        $year="2018-2019";
        if($_SERVER['REQUEST_METHOD']=="POST" and !empty($_POST['session']))
             $year = $_POST['session'];

        
        $sql="select count(*) from student where session='{$year}'";
        $case_total=getNum($sql);

        $sql="select count(*) from student where session='{$year}' and vaccinated='Yes'";
        $case_vaccinated=getNum($sql);
        
        $percentage=0;
        if($case_total!=0)
             $percentage=round(($case_vaccinated*1.0/$case_total)*100,1);

?>
    
    
<p><?=$case_vaccinated;?> students are vaccinated in session: <?=$year;?> from total <?=$case_total;?> registered students.</p>

        <div class="total shape">
                <div class="shape done"  style="height:24px;
                width:<?=$percentage;?>%">
                     <?=$percentage;?>%
                </div>
          </div>        
        <h5><?=$percentage;?>% students are vaccinated in session: <?=$year;?>.</h5>

<br>
<hr>




</div>
</div>


<?php include 'includes/footer.php'?>