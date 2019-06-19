<?php
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; //THIS IS PHP SERVER VARIABLE THAT RETURNS THE URL OF THIS CURRENT PAGE
    if($_SESSION['logstat']!="Active" and $_SESSION['user_type'] != "Admin"){header("Location:index.php");}
    include_once 'functions/functions.php'; // importing the functions from functions.php
    $course = course();
    $class=null;
    $msg=null;
    if(isset($_POST['register'])){
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
        
        $checkUsername=checksUsername($uname);
        if(!empty($checkUsername)){
            $class = "alert alert-danger alert-dismissable fade show";
            $msg = "User already exists!";
        }else{
            $class = "alert alert-success alert-dismissable fade show";
            $msg = "User successfully added!";
            insert($fname, $lname, $country, $email, $uname, $pass, $mobileno, $course, $reg_status, $user_type);
        }
        
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
            <p><?php echo "Welcome ".$_SESSION['firstname'];?> <a href="logout.php">Logout</a></p>
        </div>
    </div>
    <div class="<?php echo $class; ?>" role="alert">
        <strong><?php echo $msg; ?></strong>
       
    </div>
    <div class="container">
        <form method="post">
            <input type="hidden" name="reg_status" value="A">
            <input type="hidden" name="user_type" value="U">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" name="fname" id="" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" name="lname" id="" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Country</label>
                        <select name="country" id="" class="form-control">
                           <?php include 'list.php'; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="uname" id="" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="pass" id="" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Mobile Number</label>
                        <input type="text" name="mobileno" id="" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="course">Course</label>
                        <select name="course" id="" class="form-control">
                            <option value="">------</option>
                            <?php
                                foreach($course as $key => $value){
                                    echo "<option value = '".$value['course_id']."'>".$value['course_name']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" value="Register" name="register" class="btn btn-success">
            <a href="retrieve.php" role="button" class="btn btn-warning">View Registrants</a>
        </form>
    </div>
</body>
</html>