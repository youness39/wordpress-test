<?php require_once("import_categories_script.php"); ?>

<div class="card">
    <h2>Importer les catégories d'un fichier CSV</h2>
    <p>Veuillez insérer un fichier .csv</p>
    <form method="post" action="" enctype="multipart/form-data" >
        <input type="file" name="file" />
        <input type="submit" name="file_submit" value="Envoyer" class="button button-primary" />
    </form>
</div>
