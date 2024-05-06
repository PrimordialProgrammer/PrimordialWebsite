<?php
include_once 'config/config.php';
include_once 'classes/class.user.php';

$user = new User();

if ($user->get_session()) {
    header("location: index.php");
}

if (isset($_POST['submit'])) {
    extract($_POST);

    $valid_access_levels = array("Student", "Teacher");

    if (!in_array($access, $valid_access_levels)) {
        echo "Invalid access level. Please choose either 'Student' or 'Teacher'.";
    } else {
        $registration_result = $user->new_user($email, $password, $lastname, $firstname, $access);

        if ($registration_result) {
            header("location: login.php");
            exit;
        } else {
            echo "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>BloomTech - Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css?<?php echo time(); ?>">
</head>
<body background="background1.jpg">
    <div id="header_login">
        <h2>BloomTech</h2>
    </div>
    <br>
    <div id="registration-block">
        <center>
            <h3>Registration</h3>
            <form method="POST" action="" name="registration">
                <div>
                    <input type="text" class="input" required name="firstname" placeholder="First Name"/>
                </div>
                <div>
                    <input type="text" class="input" required name="lastname" placeholder="Last Name"/>
                </div>
                <div>
                    <input type="email" class="input" required name="email" placeholder="Email"/>
                </div>
                <div>
                    <input type="password" class="input" required name="password" placeholder="Password"/>
                </div>
                <div>
                    <select class="input" required name="access">
                        <option value="" disabled selected>Select Access Level</option>
                        <option value="Student">Student</option>
                        <option value="Teacher">Teacher</option>
                    </select>
                </div>
                <div>
                    <input type="submit" name="submit" value="Register"/>
                </div>
            </form>
            <div>
                <a href="login.php"><button>Go Back to Login</button></a>
                </div>
        </center>
    </div>
</body>
</html>
