<?php

require_once('lib/Database.php');
require_once('models/Students.php');
require_once('models/CSM.php');
require_once('models/CSMB.php');

$db = new Database();

if(isset($_GET['student'])) {

    Students::report($db, $_GET['student']);
}


$allStudents = Students::getAllStudents($db);
$schools = Students::getSchools($db); // should use separate class for this

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
                <button class="btn btn-success addStudentBtn">Add student</button>
            </div>
        </div>
        <hr>

        <div class="row">
            <?php 
            if(isset($_GET['success'])) {

                ?>
            <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                <strong>Success!</strong> Student added successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
            }
            ?>
            <div class="col-12"><h3>Students</h3></div> <div class="clearfix"></div>
            
            
            
        </div>
        
        <div class="row">
                <div class="row col-12">
                    <div class="col-3">Student ID</div>
                    <div class="col-3">Student name</div>
                    <div class="col-3">Student school</div>
                    <div class="col-3">Action</div>
                </div>
                <hr>
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

    <div class="modal" id="addStudentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="addStudent.php" method='post'>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <label for="studentName">Student name *</label>
                <input type="text" class="form-control" id="studentName" name='studentName' placeholder="Enter student name" required>
            </div>
            <div class="form-group">
                <label for="studentSchool">Student school *</label>
                <select class="form-control" id="studentSchool" name='studentSchool' required>
                    <?php
                    foreach($schools as $school){
                        echo '<option value="'.$school['ID'].'">' . $school['schoolName'] . '</option>';
                    }
                    ?>
                <select>
            </div>

            <div class="form-group">
                <label for="grades">Grades</label>
                <input type="text" class="form-control mt-1" name='grades[]' required placeholder="Required grade">
                <input type="text" class="form-control mt-1" name='grades[]' >
                <input type="text" class="form-control mt-1" name='grades[]' >
                <input type="text" class="form-control mt-1" name='grades[]' >
            </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add student</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </form>
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
<script src="js/SchoolBoard.js"></script>
</body>
</html>