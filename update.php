<?php
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    if($_SESSION['logstat']!="Active" and $_SESSION['user_type'] != "Admin"){header("Location:index.php");}
    include_once 'functions/functions.php';
    $id = $_GET['id'];
    $user = retrieveOne($id);
    $course = course();
    if(isset($_POST['update'])){

        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $country = trim($_POST['country']);
        $email = trim($_POST['email']);
        $uname = trim($_POST['uname']);
        $pass = trim($_POST['pass']);
        $mobileno = trim($_POST['mobileno']);
        $course = trim($_POST['course']);
        $reg_status = trim($_POST['reg_status']);
        $user_type = trim($_POST['user_type']);
        
        update($fname, $lname, $country, $email, $uname, $pass, $mobileno, $course, $reg_status, $user_type, $id);
    }
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
        <div class="jumbotron bg-dark text-white">
            <h1>Registration Form</h1>
            <p><?php echo "Welcome ".$_SESSION['firstname'];?><a href="logout.php">Logout</a></p>
        </div>
    </div>
    <div class="container">
        <form method="post">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" name="fname" id="" value="<?php echo $user['fname'];?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" name="lname" id="" value="<?php echo $user['lname'];?>" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Country</label>
                        <select name="country" id="" class="form-control">
                            <option value="<?php echo $user['country'] ?>"><?php echo $user['country'];?></option>
                            <?php include 'list.php'; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" value="<?php echo $user['email'];?>" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="uname" id="" value="<?php echo $user['username'];?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="pass" id="" placeholder="************" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="">Mobile Number</label>
                        <input type="text" name="mobileno" id="" value="<?php echo $user['mobileno'];?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="course">Course</label>
                        <select name="course" id="" class="form-control">
                            <option value="">------</option>
                            <?php
                                foreach($course as $key => $value){
                                    if($user['course_name'] == $value['course_name']){
                                        echo "<option value = '".$user['course_id']."' selected>".$user['course_name']."</option>";
                                    }else{
                                        echo "<option value = '".$value['course_id']."'>".$value['course_name']."</option>";
                                    }
                                      
                                }
                            ?>
                        </select>
                    </div>
                    </div>
                    <div class="col-3">
                       <div class="form-group">
                            <label for="">Registration Status</label>
                            <select name="reg_status" id="" class="form-control">
                                <?php 
                                    if($user['reg_status'] == 'A'){
                                        echo "<option value='A' selected>Active</option>";
                                        echo "<option value='I'>Inactive</option>";
                                    }
                                    elseif($user['reg_status'] == 'I'){
                                        echo "<option value='A'>Active</option>";
                                        echo "<option value='I' selected>Inactive</option>";
                                    }else{
                                        echo "<option value='A'>Active</option>";
                                        echo "<option value='I'>Inactive</option>";
                                    }
                                 ?>
                            </select>
                       </div>
                </div>
                <div class="col-3">
                       <div class="form-group">
                            <label for="">User</label>
                            <select name="user_type" id="" class="form-control">
                                <?php 
                                    if($user['user_type'] == 'A'){
                                        echo "<option value='A' selected>Admin</option>";
                                        echo "<option value='U'>Student</option>";
                                    }
                                    elseif($user['user_type'] == 'U'){
                                        echo "<option value='A'>Admin</option>";
                                        echo "<option value='U' selected>Student</option>";
                                    }else{
                                        echo "<option value='A'>Admin</option>";
                                        echo "<option value='U'>Student</option>";
                                    }
                                 ?>
                            </select>
                       </div>
                </div>
            </div>
            <input type="submit" value="Update" name="update" class="btn btn-warning">
            <a href="retrieve.php" role="button" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>