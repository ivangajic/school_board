<?php

if(isset($_POST['studentName'])){
    require_once('lib/Database.php');
    require_once('models/Students.php');
    
    $db = new Database();
    Students::addStudent($db, $_POST['studentName'], $_POST['studentSchool'], $_POST['grades']);
}