<?php

  function connection(){
    $servername = "localhost"; //127.0.0.1 equivalent IP server address
    $username = "root";
    $password = "";
    $dbname = "school"; 

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //Check connection
    if($conn->connect_error){
        die("Connection failed: ". $conn->connect_error);
    }else{
        //echo "Successfully connected!";
        return $conn;
    }
}
//Insert
function insert($fname, $lname, $country, $email, $uname, $pass, $mobileno, $course, $reg_status, $user_type){
    $conn = connection();
    $newpass = md5($pass); //easy to implement md5
    $sql = "INSERT INTO `registration` (`fname`, `lname`, `country`, `email`, `username`, `password`, `mobileno`, `course_id`, `reg_status`, `user_type`) VALUES ('$fname', '$lname', '$country', '$email', '$uname', '$newpass', '$mobileno', '$course', '$reg_status', '$user_type')";
    //checker
    if($conn->query($sql) === TRUE){
        //echo "Inserted Successfully!";
    }else{
        echo "ERROR";
    }
}
//Retrieve
function retrieve(){
    $conn = connection();
    $sql = "SELECT `registration`.*, `course`.`course_name` FROM `registration` LEFT JOIN `course` ON `registration`.`course_id` = `course`.`course_id` WHERE `reg_status` = 'A'";
    $result = $conn->query($sql); // is in matrix form; can't be displayed easily.

    $rows = array(); // will contain the single associative array pulled by the loop below
    while($row = $result->fetch_assoc()){// the fetch_assoc pulls the associative in the matrix one by one
        $rows[] = $row; // every pulled associative array is saved in the indexed array rows
    }
    return $rows;
}
function retrieveOne($id){
    $conn = connection();
    $sql = "SELECT `registration`.*, `course`.`course_name` FROM `registration` LEFT JOIN `course` ON `registration`.`course_id` = `course`.`course_id` WHERE id = '$id'";
    $result = $conn->query($sql); // result will return one single record in matrix form
    $row = $result->fetch_assoc(); // to pull the single record and assigned to the row
    return $row;
}
//Update
function update($fname, $lname, $country, $email, $uname, $pass, $mobileno, $course, $reg_status, $user_type, $id){
    $conn = connection();
    $newpass = md5($pass);
    $sql = "UPDATE `registration` SET `fname` = '$fname', `lname` = '$lname',
            `country` = '$country', `email` = '$email', `username` = '$uname',
             `password` = '$newpass', `mobileno` = '$mobileno', `course_id` = '$course', `reg_status` = '$reg_status'
             `user_type` = '$user_type' WHERE `id` = '$id'";
    $result = $conn->query($sql);
    if($result){
        header("Location: retrieve.php"); // header is a php  function that redirects to a specific file 
    }else{
       print_r($result);
    }
}
//Delete
function delete($id, $reg_status){ //this performs logical delete
    $conn = connection();
    //$sql = "DELETE FROM `registration` WHERE id = '$id'";
    $sql = "UPDATE `registration` SET `reg_status` = '$reg_status' WHERE `id` = '$id'";
    $result = $conn->query($sql);

    if($result){
        header("Location: retrieve.php");
    }else{
        echo "Connection Error!";
    }

}

function login($username, $password){
    $conn = connection();
    $sql = "SELECT * FROM `registration` WHERE `username` = '$username' AND `password` = '$password' AND `reg_status` = 'A'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
}

function checksUsername($username){
    $conn = connection();
    $sql = "SELECT `username` FROM `registration` WHERE `username` = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
}

function course(){
    $conn = connection();
    $sql = "SELECT * FROM `course`";
    $result = $conn->query($sql);
    $rows = array();

    while($row = $result->fetch_assoc()){
        $rows[] = $row;
    }
    return $rows;
}

?>