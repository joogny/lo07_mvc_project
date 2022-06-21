<!-- ----- début viewFamille -->
<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
        include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

        $linkStart = "https://dev-isi.utt.fr/~millourj/lo07_tp/projet/app/router/router.php?action=individuSelected&id=";
        // $individu : l'individu sélectionné

        if(isset($_GET["id"])) {
        ?>
        
        <h3 style="color:red"><strong><?php echo ($individu[0]->getNom() . " " . $individu[0]->getPrenom()); ?></strong></h3>
        
        <!-- ----- début info Naissance/deces -->
        
        <ul>
            <?php
            if (empty($naissance)) {
                printf("<li>Né le ?</li>");
            } else {
                printf(
                    "<li>Né le %s à %s </li>",
                    $naissance[0]->getEvent_date(),
                    $naissance[0]->getEvent_lieu()
                );
            }
            if (empty($deces)) {
                printf("<li>Décès le ?</li>");
            } else {
                printf(
                    "<li>Décès le %s à %s </li>",
                    $deces[0]->getEvent_date(),
                    $deces[0]->getEvent_lieu()
                );
            }
            ?>

        </ul>

        <!-- ----- fin info Naissance/deces -->

        <!-- ----- début info parents -->

        <?php

            if(empty($pere)) {
                $pereLien = "?";
            }
            else {
                $pereLien = "<a href='" . $linkStart . $pere[0]->getId() . "'>" . $pere[0]->getNom() . " " . $pere[0]->getPrenom() . "</a>";
            }

            if(empty($mere)) {
                $mereLien = "?";
            }
            else {
                $mereLien = "<a href='" . $linkStart . $mere[0]->getId() . "'>" . $mere[0]->getNom() . " " . $mere[0]->getPrenom() . "</a>";
            }
        ?>

        <h3><strong>Parents</strong></h3>
        <ul>
            <li>Père <?php echo($pereLien) ?></li>
            <li>Mère <?php echo($mereLien) ?></li>
        </ul>
        <!-- ----- fin info parents -->


        <!-- ----- début info unions -->



        <ul>
        <h3><strong>Unions et enfants</strong></h3>
        <?php
        //print_r($unions_individus);
        foreach ($unions_individus as $individu) {
            $lien ="<a href='" . $linkStart .  $individu["lien"]->getId() . "'>" .  $individu["lien"]->getNom() . " " .  $individu["lien"]->getPrenom() . "</a>";
            echo("<li> Union avec " . $lien . "</li>");
            echo("<ul>");
            foreach($individu["enfants"] as $enfant) {
                $enfantString =  "<a href='" . $linkStart .  $enfant->getId() . "'>" . $enfant->getNom() . " " .  $enfant->getPrenom() . "</a>";
                echo("<ol> Enfant " . $enfantString . "</ol>");
            }
            echo("</ul>");
            //printf("<li>Union avec %s </li>",$lien);
        }
        ?>
        </pre>
        </ul>
        <!-- ----- fin info unions -->

    </div>

    <?php 
    }
    else {
        echo("<h3 style='color:red'><strong>PAS D'INDIVIDU SELECTIONNE</strong></h3>");
    }
    include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

    <!-- ----- fin viewId -->
