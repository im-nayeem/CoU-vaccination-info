<!-- Button for opening form -->
<button onclick="openForm('id01');" >Click to insert data</button>

<!--Modal in which form appears,it is hidden,when button is clicked it appears--->
<div id="id01" class="modal">
    
 <form class="modal-content" action="" method="post">
 <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

<!----------container that contain form input fields--------->
    <div class="container">
        
        <h3>Student's Info:</h3>
        <hr>

        <label for="name"><strong>Name</strong></label>
            <input type="text" placeholder="Name" name="name" id="name" pattern="[A-Za-z ]+" required>

        <label for="email"><strong>Email</strong></label>
            <input type="email" placeholder="Email" name="email" id="email" required>

<!-- 
        <label for="dept"><strong>Department</strong></label>
            <input type="text" placeholder="Department" name="department" id="dept" pattern="[A-Za-z]+" required> -->

            <label for="dept"><strong>Department</strong></label>
            <select name="department" id = "dept"  required>
					<option selected disabled hidden>Select Department</option>
					<?php foreach($dept as $value):?>
						<option value="<?=$value;?>"><?=$value;?></option>
						<?php endforeach;?>
				</select>

        <label for="id"><strong>ID</strong></label>
            <input type="number" placeholder="ID" name="id" min=11401000 max=120199999 id="id" required>

        
        <label for="session"><strong>Session</strong></label>
            <input type="text" placeholder="Session(format: 2018-2019)" name="session" id="session" pattern="[0-9]{4}-[0-9]{4}" title="For example: 2018-2019" required>

        
        <label for="vaccinated"><strong>Vaccinated:</strong></label>
            <label>
                <input type="radio" name="vaccinated" value="Yes"  id="vaccinated" onclick="document.getElementById('vccntd').style.display='block'" required>Yes</label>
            <label>
                <input type="radio" name="vaccinated" value="No" id="vaccinated" onclick="document.getElementById('vccntd').style.display='none'" required>No</label>

    <!---- When clicked yes in Vaccinated button,this vccntd div appears -->
            <div id="vccntd">
                <br>
                <h3>Vaccination Info:</h3>
                <hr>

                <label for="vaccination_id"><strong>Vaccination ID</strong></label>
                    <input type="text" placeholder="Vaccination ID"  name="vaccination_id" id="vaccination_id" pattern="[A-Za-z0-9]+">
                    
                <label for="vaccine_name"><strong>Vaccine Name</strong></label>
                    <input type="text" placeholder="Vaccine Name" name="vaccine_name" pattern="[A-Za-z]+" id="vaccine_name">
                
                <label for="date"><strong>Vaccination Date:</strong></label>
                     <input type="date" id="date" name="vaccination_date">
                
                <label for="dose"><strong>Select Dose: </strong></label>
                    <label>
                        <input type="checkbox" name="first_dose" value="Yes" id="dose">1st Dose</label>
                    <label>
                        <input type="checkbox" name="second_dose" value="Yes" >2nd Dose</label>
                
            <br><br>

            <!--------Side effect info-------->
                <h3>Side-Effect due to Vaccination:</h3>
                <hr>

                <label for="fever"><strong>Fever:</strong></label>
                <label>
                    <input type="radio" name="fever" value="Yes" >Yes</label>
                <label>
                    <input type="radio" name="fever" value="No" id="fever">No</label>
                    <br><br>

                <label for="headache"><strong>Headache:</strong></label>
                <label>
                    <input type="radio" name="headache" value="Yes">Yes</label>
                <label>
                    <input type="radio" name="headache" value="No" id="headache">No</label>
                    <br><br>

                <label for="vomitting"><strong>Vomitting:</strong></label>
                <label>
                    <input type="radio" name="vomitting" value="Yes">Yes</label>
                <label>
                    <input type="radio" name="vomitting" value="No" id="vomitting">No</label>
                    <br><br>

                <label for="other_effect"><strong>Other Effect</strong></label>
                    <input type="text" name="other_effect" id="other_effect" pattern="[A-Za-z0-9 ]+" placeholder="Other side effects...">
            </div>
        <!--------------------- End of div vccntd ------------------------------>


        <!---------- cancel and submit button for form --------------->
            <div class="clearfix">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>

                <button type="submit" class="submitbtn">Submit</button>
            </div>

    </div>
    <!-- End of container div -->
    </form>
</div>
<!-- End of Modal div -->


<script>
    function openForm(id)
    {
        document.getElementById(id).style.display='block';
    }      
</script>