<?php
    session_start(); //starting the session
    include_once 'functions/functions.php';
    $url = null;
    if(isset($_SESSION['url'])){
        $url = $_SESSION['url'];
    }
    header('Location:'.$url);

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $credentials = login($username, md5($password));
        //checkers
        if($credentials['username'] == $username AND $credentials['password'] == md5($password) AND $credentials['reg_status'] == 'A'){
           
            $_SESSION['firstname'] = $credentials['fname'];
            $_SESSION['email'] = $credentials['email'];
            $_SESSION['logstat'] = "Active";

            if($credentials['user_type'] == 'A'){
                $_SESSION['user_type'] = "Admin";
                header("Location: insert.php");
            }else{
                $_SESSION['user_type'] = "Student";
                $_SESSION['stud_id'] = $credentials['id'];
                header("Location: user/studyload.php");
            }
        }else{
            if($credentials['reg_status'] == 'I' OR $credentials['reg_status'] == ''){
                echo "User is inactive!";
            }
           // echo "Username and Password Not Found!";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h4 class="display-4">Login</h4>
        </div>
    </div>
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="username"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;Username:</label>
                <input type="text" name="username" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="password"><i class="fa fa-key"></i>&nbsp; Password:</label>
                <input type="password" name="password" id="" class="form-control">
            </div>
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </form>
    </div>
</body>
</html>