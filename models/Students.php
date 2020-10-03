<?php

class Students {
    
    

    public static function getAllStudents(object $db): array{
        $studentsSth = $db->prepare('SELECT students.ID, students.studentName, schools.schoolName FROM students LEFT JOIN schools ON (students.schoolID = schools.ID)');
        $studentsSth->execute();

        return $studentsSth->fetchAll();
    }


    public static function calculateGrade(object $db, int $studentID) {
        $studentSth = $db->prepare('SELECT * FROM students WHERE ID = :studentID');
        $studentSth->bindParam(':studentID', $studentID);
        $studentSth->execute();

        $student = $studentSth->fetchObject();

        
        var_dump($student);
        die();
    }
}