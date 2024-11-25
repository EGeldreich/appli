<?php
    session_start(); // Starts new session or continue existing one
    ob_start(); // Starts output buffer

    $title = "Ajouter un produit"; // set the title variable (used in template)
    require_once "functions.php";
    
?>
    
    <form action="traitement.php?action=add" method="post"> <!-- Post method -> pass variables into $_POST, with the corresponding input names -->
        <p>
            <label>
                Nom du produit :
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit :
                <input type="text" steap="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée :
                <input type="number" name="qtt" value="1" min="1">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter le produit">
        </p>
    </form>

    <?= notif(); ?>

<?php
    $content = ob_get_clean(); // Get new informations as $content, and clean the output buffer
    require_once "template.php"; // Loads template.php, (which will in turn use $content to display this page content)
?>