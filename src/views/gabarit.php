<!DOCTYPE>
<html>
<head>
    <title><?= $pageTitle ?></title>
    <!--Chargement du CSS de Bootstrap-->
    <link rel="stylesheet" href="dependencies/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dependencies/bootstrap/dist/css/bootstrap-theme.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <meta charset="utf-8">
</head>
<style>
    .row{
        padding-top: 75px;
    }
</style>
<body class="container-fluid">

<!-- navigation principale-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php?controller=computerHome">Cyber Café</a>
        </div>

        <!-- collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php?controller=computerHome">Accueil<span class="sr-only">(current)</span></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>


        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<!--contenu de l'application-->
<section class="row">
    <div class="col-md-8 col-md-offset-2">
        <?= $content ?>
    </div>
</section>

<script src="dependencies/jquery/dist/jquery.min.js"></script>
<script src="dependencies/bootstrap/dist/js/bootstrap.min.js"></script>


</body>
</html>