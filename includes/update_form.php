

<!--Modal in which form appears,it is hidden,when button is clicked it appears--->
<div id="id02" class="modal">
    
 <form class="modal-content" action="" method="post">

 <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
   <!------container that contain form input fields----->
    <div class="container">
        <p>(If you don't want to update a field data or want to keep a field data as previous then left it empty)</p>
        <h3>Student's Info:</h3>
        <hr>

        <label for="name"><strong>Name</strong></label>
            <input type="text" placeholder="Updated Name" name="name" id="name" pattern="[A-Za-z ]+"  autofocus>

        <label for="email"><strong>Email*</strong><p>(You can't update e-mail in this section.)</p></label>
            <input type="email" placeholder="Enter your e-mail" name="email" id="email" required>

        <label for="id"><strong>ID*</strong><p>(You can't update ID.)</label>
            <input type="number" placeholder="Enter your ID" name="id" min=10000000 max=999999999 id="id" required>

        <label for="dept"><strong>Department</strong></label>
            <input type="text" placeholder="Updated Department" name="department" pattern="[A-Za-z ]+" id="dept">

        
        <label for="session"><strong>Session</strong></label>
            <input type="text" placeholder="Updated Session(format: 2018-2019)" name="session" id="session" pattern="[0-9]{4}-[0-9]{4}" title="For example: 2018-2019" >

        
        <label for="vaccinated"><strong>Vaccinated:</strong></label>
            <label>
                <input type="radio" name="vaccinated" value="Yes"  id="vaccinated" onclick="document.getElementById('vccntd').style.display='block'" >Yes</label>
            <label>
                <input type="radio" name="vaccinated" value="No" id="vaccinated" onclick="document.getElementById('vccntd').style.display='none'" >No</label>

    <!-- When clicked yes in Vaccinated button,this vccntd div appears -->
            <div id="vccntd">
                <br>
                <h3>Vaccination Info:</h3>
                <hr>
                
                <label for="vaccine_name"><strong>Vaccine Name</strong></label>
                    <input type="text" placeholder="Updated Vaccine Name" name="vaccine_name" id="vaccine_name"pattern="[A-Za-z ]+" >
                
                <label for="date"><strong>Enter Updated Vaccination Date:</strong></label>
                     <input type="date" id="date" name="vaccination_date">
                
                <label for="dose"><strong>Select Dose: </strong></label>
                    <label>
                        <input type="checkbox" name="first_dose" value="Yes" id="dose">1st Dose</label>
                    <label>
                        <input type="checkbox" name="second_dose" value="Yes" >2nd Dose</label>
                
            <br><br>
                <h3>Side-Effect due to Vaccination:</h3>
                <hr>

                <label for="fever"><strong>Fever:</strong></label>
                <label>
                    <input type="radio" name="fever" value="Yes" >Yes</label>
                <label>
                    <input type="radio" name="fever" value="No" id="fever" >No</label>
                    <br><br>

                <label for="headache"><strong>Headache:</strong></label>
                <label>
                    <input type="radio" name="headache" value="Yes" >Yes</label>
                <label>
                    <input type="radio" name="headache" value="No" id="headache" >No</label>
                    <br><br>

                <label for="vomitting"><strong>Vomitting:</strong></label>
                <label>
                    <input type="radio" name="vomitting" value="Yes" >Yes</label>
                <label>
                    <input type="radio" name="vomitting" value="No" id="vomitting" >No</label>
                    <br><br>

                <label for="other_effect"><strong>Other Effect</strong></label>
                    <textarea name="other_effect" id="other_effect" placeholder="Updated side effects..." pattern="[A-Za-z0-9 ]+"></textarea>
            </div>
            <!------- End of div vccntd ------>


            <!-- cancel and submit button for form -->
            <div class="clearfix">
                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>

                <button type="submit" class="submitbtn">Submit</button>
            </div>

    </div>
    <!-- End of container div -->
    </form>
</div>
<!-- End of modal div -->



<script>
    function openForm(id)
    {
        document.getElementById(id).style.display='block';
    }      
</script>