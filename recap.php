<?php
    session_start();
    ob_start();
    $title = "Panier";
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p>Aucun produit en session...</p>";
        }
        else {
            echo "<table>", 
                    "<thead>",
                        "<tr>",
                            "<th>#</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                        "</tr>",
                    "</thead>",
                    "<tbody>";
            $totalGeneral = 0;
            foreach($_SESSION['products'] as $index => $product){
                echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td>",
                            "<form action='traitement.php?action=down-qtt' method='post'>",
                                "<input type='hidden' name='product_index' value='".$index."'>",
                                "<input type='submit' name='substract' value='-'>",
                            "</form>"
                            .$product['qtt'].
                            "<form action='traitement.php?action=up-qtt' method='post'>",
                                "<input type='hidden' name='product_index' value='".$index."'>",
                                "<input type='submit' name='add' value='+'>",
                            "</form>",
                        "</td>",
                        "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td>",
                            "<form action='traitement.php?action=delete' method='post'>",
                                "<input type='hidden' name='product_index' value='".$index."'>",
                                "<input type='submit' name='delete' value='Supprimer'>",
                            "</form>",
                        "</td>",
                    "</tr>";
                $totalGeneral += $product['total'];
            }
            echo "<tr>",
                    "<td colspan=4>Total général : </td>",
                    "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                "</tr>",
                "<tr>",
                    "<td colspan=6>",
                        "<form action='traitement.php?action=deleteAll' method='post'>",
                        "<input type='submit' name='deleteAll' value='Supprimer tout'>",
                    "</td>",
                "</tr>",
                "</tbody>",
                "</table>";
        }

    $content = ob_get_clean();
    require_once "template.php";
?>
