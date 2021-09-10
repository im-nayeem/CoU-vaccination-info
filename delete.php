<?php 

$page="delete";
$title="Delete data";
include 'includes/header&sidebar.php';
 require 'includes/connect_db.php';?>

<div class="content">
 <button onclick="document.getElementById('admin').style.display='block';">Admin Log in Panel</button>

 <div class="modal" id="admin">
     
 <span onclick="document.getElementById('admin').style.display='none'" class="close" title="Close Modal">&times;</span>
     <form action="" method="post" class="modal-content">
         <h2>Admin Panel</h2>
         <div class="container">
             <label for="email">E-mail</label>
             <input type="email" name="email" id="email">
            <label for="pass" >Password</label>
             <input type="password" name="pass" id="pass">


             <div class="clearfix">
                <button type="button" onclick="document.getElementById('admin').style.display='none'" class="cancelbtn">Cancel</button>

                <button type="submit" class="submitbtn">Submit</button>
            </div>
         </div>
         
     </form>
 </div>
 <?php

 if($_SERVER['REQUEST_METHOD']=="POST" and !empty($_POST))
    echo "wrong email or password";
 ?>


</div>
<?php include 'includes/footer.php'?>