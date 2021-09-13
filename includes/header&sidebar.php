<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$title;?></title>
    <link rel="stylesheet" href="assets\style.css">
    <link rel="stylesheet" href="assets\stat.css">
</head>
<body>
<div class="header">
        <h2>Student's Vaccination Information, Comilla University</h2>
        <hr>
    </div>
<div class="sidebar">
    <ul>
    <li class="<?php if($page=="home"):?><?="active";?> <?php endif?>">
    <a href=".\">Home</a></li>

    <li class="<?php if($page=="add"):?><?="active";?> <?php endif?>">
    <a href="add.php">Add New Data</a></li>

    <li class="<?php if($page=="update"):?><?="active";?> <?php endif?>">
    <a href="update.php">Update Data</a>

    <li class="<?php if($page=="show_info"):?><?="active";?> <?php endif?>">
    <a href="show_info.php">Show All Information</a>
    
</ul>
</div>
