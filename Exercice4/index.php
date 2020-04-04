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

    $tabphrases = [];
    $errors = [];
    $ibou=0;

    if (isset($_POST['resultat']))
    {       
            $nbrChamps =$_POST['nbre'];
            for ($i=0;$i<$nbrChamps;$i++)
            {
                $text = $_POST['text_'.($i)];
                
                if(is_empty($text))
                {
                    $errors[$i][] = 'Champ vide';
                }
                if (long_chaine($text)>200)
                {
                    $errors[$i][] = 'Le mot ne doit pas dépasser 20 caractères';
                }
                if (!est_une_phrase($text))
                {
                    $errors[$i][] = 'Ecrire une phrase';
                }
                if (isset($errors[$i]) && empty($errors[$i]))
                {
                    unset($errors[$i]);
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
    <title>Exercice 4</title>
</head>
<body>
<h1>Exercice 4</h1>
<form action="" method="POST" class="divider">
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
            <label for="">phrase N°<?= $i+1 ?></label>
            <span><?= isset($errors[$i]) ? '( '. print_error($errors[$i]) .' )' : '' ?></span>
            <textarea name="text_<?= $i ?>" autocomplete="off" value="<?= isset($tabphrases[$i]) ? $tabphrases[$i] : '' ?>" id="text" cols="35" rows="5"></textarea> 
        </div>
        <?php } ?>
    </div>
    <?php if ($nbrChamps>0 && empty($message)){ ?>
    <div>
        <button type="submit" name="resultat" >Résultats</button>
    </div>
    <?php } ?>
    <?php if (empty($errors) && isset($_POST['resultat'])){ 
    $texts=preg_replace("/\s+/"," ",$text);
        ?>
            <textarea readonly cols="35" rows="5"><?= $texts ?></textarea>
<?php } ?>

</form>
</div>
</body>
</html>
