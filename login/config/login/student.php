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
<html lang="en">
<head>
    <title>BloomTech</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css?<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/1408214d94.js" crossorigin="anonymous"></script>
</head>
<body background="background1.jpg">
<?php include 'navbar.php'; ?>
<div id="wrapper">
    <div id="content">
        <?php
        $page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';

        switch ($page) {
            case 'modules':
                include 'modules.php';
                break;
            case 'videos':
                include 'videos.php';
                break;
            case 'settings':
                include 'settings.php';
                break;
            default:
                include 'home.php';
                break;
        }
        ?>
    </div>
</div>

</body>
</html>
