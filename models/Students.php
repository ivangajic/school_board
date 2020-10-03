<?php

class Students {
    
    

    public static function getAllStudents(object $db): array{
        $studentsSth = $db->prepare('SELECT students.ID, students.studentName, schools.schoolName FROM students LEFT JOIN schools ON (students.schoolID = schools.ID)');
        $studentsSth->execute();

        return $studentsSth->fetchAll();
    }


    public static function report(object $db, int $studentID) {
        $studentSth = $db->prepare('SELECT students.*, schools.schoolName FROM students LEFT JOIN schools ON (students.schoolID = schools.ID) WHERE students.ID = :studentID');
        $studentSth->bindParam(':studentID', $studentID);
        $studentSth->execute();

        $student = $studentSth->fetchObject();
        if((int)$student->schoolID == 1) {
            CSM::calculate($db, $student);
        } else {
            CSMB::calculate($db, $student);
        }
           
        die();
    }
}