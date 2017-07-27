
<form method="post">
    <div class="form-group">

        <input type="checkbox" name="newsletter" value="newsletter" <?php if ($newsletter=='O') {echo"checked";}?>>
        <?php if($newsletter=='O'){
            echo "<br>Vous êtes abonné(e) à la newsletter";
            } else {
            echo"<br>Vous n'êtes pas inscrit(e) à la newsletter";
            } ?>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Valider</button>
</form>