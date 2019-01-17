<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>

<div id="login">
    <div class="login-container">
        <?php if (isset($_SESSION['user_id'])) { ?>
            <a href="logout.php">Logout</a>
        <?php } else { ?>
            <a href="login.php">Log In</a>
            <a href="sign-up.php">| &nbsp; Sign Up</a>
        <?php } ?>
    </div>
</div>

