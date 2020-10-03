<?php

class CSM {
    public static function calculate(object $db, object $student){
        $gradesSth = $db->prepare('SELECT studentGrade FROM student_grades WHERE studentID = :studentID');
        $gradesSth->bindParam(':studentID', $student->ID);
        $gradesSth->execute();
        
        $grades = $gradesSth->fetchAll();
        $gArray = [];
        foreach($grades as $grade){
           // echo $grade['studentGrade'] ;
           array_push($gArray, $grade['studentGrade']);
        }
        
        $avg = array_sum($gArray) / count($gArray);
        $pass = false;
        if(ceil($avg) >= 7) {
            $pass = true;
        }

        $returnObj = new \stdClass;

        $returnObj->studentID = $student->ID; 
        $returnObj->studentName = $student->studentName; 
        $returnObj->schoolName = $student->schoolName; 
        $returnObj->average = round($avg, 2); 
        $returnObj->grades = $gArray;
        $returnObj->passed = $pass;
        echo "<pre>";
        echo json_encode($returnObj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
        echo "</pre>";
    }
}