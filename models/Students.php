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

    public static function getSchools(object $db): array {
        $schoolsSth = $db->prepare('SELECT * FROM schools');
        $schoolsSth->execute();

        return $schoolsSth->fetchAll();
    }

    public static function addStudent(object $db, string $studentName, int $studentSchool, array $grades){
        $insertStudent = $db->prepare('INSERT INTO students SET studentName = :studentName, schoolID = :schoolID');
        $insertStudent->bindParam(':studentName', $studentName);
        $insertStudent->bindParam(':schoolID', $studentSchool);
        $insertStudent->execute();
        $studentID = $db->lastInsertId();

        foreach($grades as $grade) {
            if($grade == 0) {continue;}
            $stm = $db->prepare('INSERT INTO student_grades SET studentID = :studentID, studentGrade = :grade');
            $stm->bindParam(':studentID', $studentID);
            $stm->bindParam(':grade', $grade);
            $stm->execute();
        }

        header('Location: index.php?success=1');
    }
}