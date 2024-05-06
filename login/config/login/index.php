<?php
include_once 'classes/class.user.php';
include 'config/config.php';

$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';

$user = new User();
if(!$user->get_session()){
	header("location: login.php");
}
$user_id = $user->get_user_id($_SESSION['user_email']);
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
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body background="background1.jpg">
<nav>
</input>
    <label class="logo">BloomTech</label>
    <ul>
        <li><a href="main.php">Home</a>
        <li><a href="teacher.php">Teachers</a>
        <li><a href="student.php">Students</a>
        <li><a href="index.php?page=settings">Settings</a>
        <li><a href="logout.php">Log Out</a>

    </ul>
</nav>
<div id="wrapper">
  <div id="content">
    <?php
      switch($page){
                case 'settings':
                    require_once 'settings-module/index.php';
                break; 
                case 'module_two':
                    require_once 'module-folder';
                break; 
                case 'module_xxx':
                    require_once 'module-folder';
                break; 
                default:
                    require_once 'main.php';
                break; 
            }
    ?>
  </div>
</div>

</body>
</html>