<?php 
$page="home"; //add var page to add active class in sidebar button
$title="CoU Student's Vaccination Information"; //title for the page

require "includes/connect_db.php";

	$conn=getDB();

?>
<?php
 if(isset($_POST['entity'])) 
{
	if(isset($_POST['sort_by']))
		 redirect("view.php?&entty={$_POST['entity']}&value={$_POST['entity_val']}&sort_by={$_POST['sort_by']}");
	else
		redirect("view.php?&entty={$_POST['entity']}&value={$_POST['entity_val']}");
}
?>
<?php  include "includes/header&sidebar.php";?>
<div class="content">
    
<?php include 'includes/stat.php'; ?>
		<!--include stat.php to show statistics-->


<!--- Show all student's basic info on button click-->
<button class="btn" onclick="document.getElementById('all_data').style.display='block';">All Student's Data</button>
	<div id="all_data">
		<button class="hide" onclick="document.getElementById('all_data').style.display='none';">Hide>></button>
		<div class="show">
			<?php
				$sql="SELECT * from student;";
				$arr=get_element($conn,$sql);
				include 'includes/show_table.php';
			?>
		</div>
	</div>


<!--- show all vaccinated students on button click(details view with all tables) -->
<button class="btn" onclick="document.getElementById('v_std').style.display='block';">Vaccinated Students</button>
<div id="v_std">
<button class="hide" onclick="document.getElementById('v_std').style.display='none';">Hide>></button>
<div class="show">
	<?php
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

			$arr=get_element($conn,$sql);
			include 'includes/show_table.php';
	?>
	</div>
</div>

<!-----------Show Vaccination Info on button click------------->
<button class="btn" onclick="document.getElementById('v_info').style.display='block';">Show Only Vaccination Info</button></a>
<div id="v_info">
<button class="hide" onclick="document.getElementById('v_info').style.display='none';">Hide>></button>
	<div class="show">
		<?php
			$sql="SELECT * FROM vaccination_info";
			$arr=get_element($conn,$sql);
			include 'includes/show_table.php';
			
		?>
	</div>

</div>


<!---show Side Effect Info on button click--->
<button class="btn" onclick="document.getElementById('s_e_info').style.display='block';">Show Only Side Effect Info</button></a>
<div id="s_e_info">
<button class="hide" onclick="document.getElementById('s_e_info').style.display='none';">Hide>></button>
<div class="show">
		<?php
			$sql="SELECT * FROM side_effect";
			$arr=get_element($conn,$sql);
			include 'includes/show_table.php';
		?>
	</div>

</div>

<!------------Search By Filtering(validation)--------->
<?php if(!empty($_POST)):?>
		<?php if(!isset($_POST['entity'])):?>
			<div id="err">
			<span onclick="document.getElementById('err').style.display='none'" class="close" title="Close Modal">&times;</span>
				<strong><li>You haven't selected entity or entity value. Select both to search. For exaple: Entity = ID , Entity Value = 11908**** .Try again!"</div></li></strong>
		<?php endif;?>
<?php endif;?>

<div class="effects">   <!-----------Search by filtering(Form)------------>
	<form action="" method="post">
				<select name="entity"  required>
					<option selected disabled hidden>Select Entity</option>
					<?php foreach($entity as $key=>$value):?>
						<option value="<?=$key;?>"><?=$value;?></option>
						<?php endforeach;?>
				</select>
			<input type="text" placeholder="Entity Value" name="entity_val" pattern="[A-Za-z0-9@. -]+"required>
			<select name="sort_by"  required>
					<option selected disabled hidden>Sort By</option>
					<?php foreach($entity as $key=>$value):?>
						<option value="<?=$key;?>"><?=$value;?></option>
						<?php endforeach;?>
			</select>
				<button type="submit">Filter Search</button>
	</form>
</div>

	
</div>

<!--------------End of search by filter----------->
</div>
<?php include 'includes/visitor.php';
?>

<?php include 'includes/footer.php';?>