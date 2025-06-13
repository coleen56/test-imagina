<?php
require "controller.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Imagina</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <table>
    <?php
    foreach($champs as $ligne) {
        ?>
        <tr>
        <?php
        foreach($ligne as $case) {
    ?>
            <td class="<?=$case == '1' ? "menhir" : "vide"?>"><?=$case?></td>
    <?php
        }
    ?>
        </tr>
    <?php    
    }
    ?>
    </table>
</body>
</html>

