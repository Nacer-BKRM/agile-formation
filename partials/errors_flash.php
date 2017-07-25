<?php if (!empty($_SESSION['flash'])) : ?>
    <div class="alert alert-success">
        <?= $_SESSION['flash'] ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

    <?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>