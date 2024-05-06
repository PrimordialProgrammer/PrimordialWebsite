<?php
include_once 'config/config.php';
include_once 'classes/class.user.php';

$user = new User();
if($user->get_session()){
    // Check user role and redirect accordingly
    if($user->user_access == 'Student'){
        header("location: student.php");
        exit();
    } elseif ($user->user_access == 'Teacher') {
        header("location: teacher.php");
        exit();
    } else {
        header("location: index.php");
        exit();
    }
}

if(isset($_REQUEST['submit'])){
    extract($_REQUEST);
    
    if($password !== $confirm_password){
        ?>
        <div id='error_notif'>Password and Confirm Password do not match.</div>
        <?php
    } else {
        $login = $user->check_login($useremail, $password);
        if($login){
            $user_data = $user->getUserData($useremail);
            $user->set_session();

            $user->user_access = $user_data['user_access'];

            if($user->user_access == 'Student'){
                header("location: student.php");
                exit();
            } elseif ($user->user_access == 'Teacher') {
                header("location: teacher.php"); 
                exit();
            } else {
                header("location: index.php");
                exit();
            }
        } else {
            ?>
            <div id='error_notif'>Wrong email or password.</div>
            <?php
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>BloomTech</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css?<?php echo time();?>">
    <script src="script.js"></script>
</head>
<body background="background1.jpg">
<div id="header_login">
    <h2>BloomTech</h2>
</div>
<br>
<div id="login-block">
    <center>
        <h3>Please login</h3>
        <form method="POST" action="" name="login">
            <div>
                <input type="email" class="input" required name="useremail" placeholder="Valid E-mail"/>
            </div>	
            <div>
                <input type="password" class="input" required name="password" placeholder="Password"/>
            </div>
            <div>
                <input type="password" class="input" required name="confirm_password" placeholder="Confirm Password"/>
            </div>
            <div>
                <input type="submit" name="submit" value="Submit"/>
            </div>
            <div>
                <a href="register.php">Register</a>
            </div>
        </form>
    </center>
</div>
</body>
</html>
