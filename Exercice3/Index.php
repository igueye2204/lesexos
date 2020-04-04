<?php
require_once "Functions.php";

    $message ='';
    $nbrChamps = 0;
    if (isset($_POST['valider']))
    {
        $nbrChamps = $_POST['nbre'];
        if (!is_chaine_numeric($nbrChamps))
        {
            $message = 'Veuillez saisir un entier !';
            $nbrChamps = 0;
        }
        elseif (is_empty($nbrChamps)) 
        {
            $message = 'Champ obligatoire';
        }
    }

    $tabMots = [];
    $errors = [];
    $motsAvecM = [];

    if (isset($_POST['resultat']))
    {
            $nbrChamps =$_POST['nbre'];
            for ($i=0;$i<$nbrChamps;$i++)
            {
                $mot = $_POST['mot_'.($i)];
                $tabMots[] = $mot;
                if(is_empty($mot))
                {
                    $errors[$i][] = 'Champ vide';
                }
                if (long_chaine($mot)>20)
                {
                    $errors[$i][] = 'Le mot ne doit pas dépasser 20 caractères';
                }
                if (!is_chaine_alpha($mot))
                {
                    $errors[$i][] = 'Des lettres uniquement et un seul mot';
                }
                if (isset($errors[$i]) && empty($errors[$i]))
                {
                    unset($errors[$i]);
                }
            }
            if (!empty($errors))
            {
                foreach ($tabMots as $m)
                {
                    if (is_car_present_in_chaine('M',$m))
                    {
                        $motsAvecM[] = $m;
                    }
                }
            }

    }
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="EXO34.css">
    <title>Exercice 3</title>
</head>
<body>
<h1>Exercice 3</h1>
<div id="divider">
<form action="" method="POST">
    <div>
        <div>
            <label for="nbre">Nombre de champs</label>
            <input type="text" value="<?= $nbrChamps ?>" name="nbre" autocomplete="off" >
            <p ><?= $message ?></p>
        </div>
        <div>
            <button type="submit" name="valider">Valider</button>
            <button type="submit" name="annuler">Annuler</button>
        </div>
    </div>
    <div>
        <?php for ($i=0;$i<$nbrChamps;$i++){ ?>
        <div>
            <label for="">Mot N°<?= $i+1 ?></label>
            <span><?= isset($errors[$i]) ? '( '. print_error($errors[$i]) .' )' : '' ?></span>
            <input type="text" autocomplete="off" value="<?= isset($tabMots[$i]) ? $tabMots[$i] : '' ?>" name="mot_<?= $i ?>" >
        </div>
        <?php } ?>
    </div>
    <?php if ($nbrChamps>0 && empty($message)){ ?>
    <div>
        <button type="submit" name="resultat" >Résultats</button>
    </div>
    <?php } ?>
</form>

<?php if (empty($errors) && isset($_POST['resultat'])){ ?>
    <div >
        <div >
            <p>Les mots saisis sont:  </p><br><?php print_r($tabMots); ?>
            <p>Vous avez saisi <?= $nbrChamps ?> Mot(s) dont <span><?= count($motsAvecM) ?> avec la lettre M</span></p>
        </div>
    </div>
<?php } ?>
</div>

</body>
</html>
