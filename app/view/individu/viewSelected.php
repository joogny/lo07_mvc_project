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
        ?>
        <h3 style="color:red"><strong><?php echo ($individu->getNom() . " " . $individu->getPrenom()); ?></strong></h3>
        
        <!-- ----- début info Naissance/deces -->
        
        <ul>
            <?php
            if (is_null($naissance)) {
                printf("<li>Né le ?</li>");
            } else {
                printf(
                    "<li>Né le %s à %s </li>",
                    $naissance->getEvent_date(),
                    $naissance->getEvent_lieu()
                );
            }
            if (is_null($deces)) {
                printf("<li>Décès le ?</li>");
            } else {
                printf(
                    "<li>Décès le %s à %s </li>",
                    $deces->getEvent_date(),
                    $deces->getEvent_lieu()
                );
            }
            ?>

        </ul>

        <!-- ----- fin info Naissance/deces -->

        <!-- ----- début info parents -->

        <?php

            if(is_null($pere)) {
                $pereLien = "?";
            }
            else {
                $pereLien = "<a href='" . $linkStart . $pere->getId() . "'>" . $pere->getNom() . " " . $pere->getPrenom() . "</a>";
            }

            if(is_null($mere)) {
                $mereLien = "?";
            }
            else {
                $mereLien = "<a href='" . $linkStart . $mere->getId() . "'>" . $mere->getNom() . " " . $mere->getPrenom() . "</a>";
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

    <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

    <!-- ----- fin viewId -->
