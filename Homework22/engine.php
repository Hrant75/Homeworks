<?php

require_once "database.php";
define("ITEMS_PER_PAGE",4);  //haytararum enq konsant

function getStudents()
{
    global $dbConnection;
    global $pageType;

    $students = [];
    if($pageType == 'students') {
        $sql = "SELECT id, first_name, last_name, age, email, phone, git FROM students";
    } else if ($pageType == 'courses') {
        $sql = "SELECT id, course_name, lecturer_id FROM courses";
    } else if($pageType == 'lecturers') {
        $sql = "SELECT id, first_name, last_name, email, phone, git FROM lecturers";
    }
    $result = mysqli_query($dbConnection, $sql);


    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
        return $students;
    } else return false;
}

if(isset($_GET['add'])){
    
    $students = getStudents();
    if ( (count($students) % ITEMS_PER_PAGE) == 0) $currentPage++;

    if($_GET['add'] == 'courses' ){
        $pageType = 'courses';
        $courseName = $_GET['addCourse'];
        $lecturerID = $_GET['addLecturerID'];
        $sql = "INSERT INTO courses (course_name, lecturer_id) VALUES ('".$courseName."', '".$lecturerID."')";
    }

    if($_GET['add'] == 'students' || $_GET['add'] == 'lecturers'){

        $first_name =  $_GET['addName'];
        $last_name =  $_GET['addLast'];
        if($_GET['add'] == 'students' && isset($_GET['addAge'])){
            $age =  $_GET['addAge'];
        } else {
            $age = '20';
        }
        if(isset($_GET['addEmail'])){
            $email =  $_GET['addEmail'];
        } else {
            $email = '';
        }
        if(isset($_GET['addPhone'])){
            $phone =  $_GET['addPhone'];
        } else {
            $phone = '';
        }
        if(isset($_GET['addGit'])){
            $git =  $_GET['addGit'];
        } else {
            $git = '';
        }

        if ($_GET['add'] == 'students'){
            $pageType = 'students';
            $sql = "INSERT INTO students (first_name, last_name, age, email, phone, git) VALUES ('".$first_name."', '".$last_name."', '".$age."', '".$email."', '".$phone."', '".$git."')";
        } else {
            $pageType = 'lecturers';
            $sql = "INSERT INTO lecturers (first_name, last_name, email, phone, git) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$phone."', '".$git."')";
        }
    }
    $result = mysqli_query($dbConnection, $sql);
    if(!$result){
        echo 'false';
        return false;
    }
    return true;
}

if(isset($_GET['delButton'])) {
    $deleteRow = $_GET['delButton'];

    $sql = "DELETE FROM ".$_GET['pageType']." WHERE id =".$deleteRow;

    $result = mysqli_query($dbConnection, $sql);

    if (!$result) {
        echo 'false';
        return false;
    }
    return true;
}

function updateStudent(){
    if(isset($_GET['update_student'])){
        global $dbConnection;

        $updateRow = $_GET['update_student'];
        $first_name =  $_GET['first_name'];
        $last_name =  $_GET['last_name'];
        if(isset($_GET['age'])){
            $age =  $_GET['age'];
        } else {
            $age = '20';
        }

        $sql = "UPDATE students SET first_name='".$first_name."', last_name='".$last_name."', age='".$age."' WHERE id='".$updateRow."'";

        $result = mysqli_query($dbConnection, $sql);

        if(!$result){
            echo 'false';
            return false;
        }
        return true;
    }
}

?>