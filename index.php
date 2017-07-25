<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cyber Agile</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="web/dependancies/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="web/dependancies/bootstrap/dist/css/bootstrap-theme.min.css">
</head>
<body>

<?php include 'partials/navbar.php' ?>

<div class="container" style="margin-top: 75px;">

    <?php include 'partials/errors_flash.php'; ?>

</div>

<script src="web/dependancies/jquery/dist/jquery.min.js"></script>
<script src="web/dependancies/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>
