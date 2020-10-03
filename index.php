<?php

require_once('lib/Database.php');
require_once('models/Students.php');
require_once('models/CSM.php');
require_once('models/CSMB.php');

$db = new Database();
$allStudents = Students::getAllStudents($db);

if(isset($_GET['student'])) {

    Students::report($db, $_GET['student']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Board</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row mt-2">
            <div class="col-9">
                <h1>School board</h1>
            </div>
            <div class="col-3">
                <button class="btn btn-success">Add student</button>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-12"><h3>Students</h3></div> <div class="clearfix"></div>
            
            
            
        </div>
        
        <div class="row">
                <div class="row col-12">
                    <div class="col-3">Student ID</div>
                    <div class="col-3">Student name</div>
                    <div class="col-3">Student school</div>
                    <div class="col-3">Action</div>
                </div>
                <div class="clearfix"></div>
                <?php 
                
                foreach($allStudents as $student) {
                    ?>
                <div class="row col-12 mt-1">
                    <div class="col-3"><?php echo $student['ID']; ?></div>
                    <div class="col-3"><?php echo $student['studentName']; ?></div>
                    <div class="col-3"><?php echo $student['schoolName']; ?></div>
                    <div class="col-3"><a target='_blank' href='index.php?student=<?php echo $student['ID']; ?>' class='btn btn-primary'>Show report</a></div>
                </div>

                    <?php
                }
                
                ?> 
        </div>
    </div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
<script src="js/SchoolBoard.js"></script>
</body>
</html>