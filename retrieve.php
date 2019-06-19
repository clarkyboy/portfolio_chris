<?php
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    if($_SESSION['logstat']!="Active" and $_SESSION['user_type'] != "Admin"){header("Location:index.php");}
    include_once 'functions/functions.php';
    $users = retrieve();
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
        <div class="jumbotron">
            <h1>All Registrants</h1>
            <p><?php echo "Welcome ".$_SESSION['email'];?><a href="logout.php">Logout</a></p>
        </div>
    </div>
    <div class="container">
        <table class="table table-striped table-responsive">
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Country</th>
                <th>Email</th>
                <th>Username</th>
                <th>Mobile No.</th>
                <th>Course Taken</th>
                <th>Registration Status</th>
                <th>User Type</th>
                <th colspan="2">Action</th>
            </thead>
            <tbody>
                <?php foreach($users as $key => $value){?>
                    <tr>
                        <td><?php echo $value['fname'];?></td>
                        <td><?php echo $value['lname'];?></td>
                        <td><?php echo $value['country'];?></td>
                        <td><?php echo $value['email'];?></td>
                        <td><?php echo $value['username'];?></td>
                        <td><?php echo $value['mobileno'];?></td>
                        <td><?php echo $value['course_name'];?></td>
                        <td>
                            <?php
                                if($value['reg_status'] == 'A'){echo "Active";}else{echo "Inactive";}
                            ?>
                        </td>
                        <td>
                            <?php
                                if($value['user_type'] == 'A'){echo "Admin";}else{echo "Student";}
                            ?>
                        </td>
                        <td><a href="update.php?id=<?php echo $value['id'];?>" role="button" class="btn btn-warning">Edit</a></td>
                        <td><a href="delete.php?id=<?php echo $value['id'];?>" role="button" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        <a href="insert.php" role="button" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>