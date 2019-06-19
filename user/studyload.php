<?php
    session_start();
    if($_SESSION['logstat']!="Active" and $_SESSION['user_type'] != "Student"){header("Location:index.php");}
    include_once '../functions/functions.php';
    $stud_id = $_SESSION['stud_id'];
    $user = retrieveOne($stud_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Welcome Student <?php $user['fname'];?></h1>
        <div class="row">
            <div class="col-6">
                <h3>Full Name</h3>
                <p align="justify"><?php echo $user['fname']." ".$user['lname'];?></p>
            </div>
            <div class="col-6">
                <h3>Mobile Number</h3>
                <p align="justify"><?php echo $user['mobileno'];?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Course Enrolled</h3>
                <p><?php echo $user['course_name']; ?></p>
            </div>
        </div>
    </div>
</body>
</html>