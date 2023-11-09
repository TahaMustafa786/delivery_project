<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Project</title>
    <link rel="stylesheet" href="<?php echo SITE_URL ?>public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="topnav">
        <a class="active" href="#home">Home</a>
        <div class="login-container">
            <form action="<?php echo SITE_URL ?>Home/login" method="POST">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="<?php echo SITE_URL ?>Home/logout">Logout</a>
                <?php } else { ?>
                    <input type="text" placeholder="Username" name="username">
                    <input type="password" placeholder="Password" name="password">
                    <button href="<?php echo SITE_URL ?>Home/login" type="submit">Login</button>
                <?php } ?>
            </form>
        </div>
    </div>
    <?php if (isset($_SESSION['invalid_credentials'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['invalid_credentials']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <div class="container">

        <div class="mt-5"></div>