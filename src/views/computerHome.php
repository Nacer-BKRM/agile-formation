<h1> Page d'accueil du Cyber Café </h1>

<ul class="list-group">

    <div class="list-group">
        <?php foreach ($listPC as $item): ?>
            <?php if ($item['libre'] == 0){
                $color = "green";
                $state = "";
            } else {
                $color = "red";
                $state = "disabled";
            }

        ?>

            <a href="index.php?controller=gestionPC&id=<?=$item['id_pc']?>" class="list-group-item <?=$state?>">
                <h3 class="list-group-item-heading"><?= $item["nom"] ?></h3>
                <span class="glyphicon glyphicon-object-align-bottom" style="color: <?=$color?>"></span>

            </a>
        <?php endforeach; ?>
    </div>

</ul>
