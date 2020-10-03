<?php

class CSMB {
    public static function calculate(object $db, object $student) {
        $gradesSth = $db->prepare('SELECT studentGrade FROM student_grades WHERE studentID = :studentID');
        $gradesSth->bindParam(':studentID', $student->ID);
        $gradesSth->execute();
        
        $grades = $gradesSth->fetchAll();
        $gArray = [];
        foreach($grades as $grade){
           // echo $grade['studentGrade'] ;
           array_push($gArray, $grade['studentGrade']);
        }
        sort($gArray);
        $avg = array_sum($gArray) / count($gArray);
        
        $pass = false;
       
        if(count($gArray) > 2){
            array_shift($gArray);
            
            if($gArray[count($gArray) - 1] > 8) {
                $pass = true;
            }
            //$avg = array_sum($tmpArr) / count($tmpArr);
        }else {
            if($gArray[count($gArray) - 1] > 8) {
                $pass = true;
            }
        }


        $xml_header = '<?xml version="1.0" encoding="UTF-8"?><Student></Student>';
        $xml = new SimpleXMLElement($xml_header);

        $xml->addChild('StudentID', $student->ID);
        $xml->addChild('studentID', $student->ID);
        $xml->addChild('studentName', $student->studentName);
        $xml->addChild('schoolName', $student->schoolName);
        $xml->addChild('average',  round($avg, 2));
        $xml->addChild('grades', implode(', ', $gArray));
        $xml->addChild('passed', $pass ? 'true' : 'false');

       
        header('Content-type: text/xml');
        echo $xml->asXML();
        die();
        
    }
}