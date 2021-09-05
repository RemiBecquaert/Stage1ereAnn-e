<?php

function listeproduitControleur($twig, $db){
    $form = array();
    $produit = new Produit($db);
    $liste = $produit->select();

    if(isset($_POST['btSupprimer'])){
        $cocher = $_POST['cocher'];
        $form['valide'] = true;
        $etat = true;
        foreach ( $cocher as $idProduit){
            $exec=$produit->delete($idProduit);
            if (!$exec){
                $etat = false;
            }
        }
        header('Location: index.php?page=listeproduit&etat='.$etat);
        exit;
    }
   
    
    if(isset($_GET['idProduit'])){
        $exec=$produit->delete($_GET['idProduit']);
       
        if (!$exec){
        $etat = false;
        }
        else{
        $etat = true;
        }
        header('Location: index.php?page=listeproduit&etat='.$etat);
        exit;
        }
        if(isset($_GET['etat'])){
        $form['etat'] = $_GET['etat'];
        }
       

    echo $twig->render('listeproduit.html.twig',array('form'=>$form, 'liste'=>$liste));
}

?>
