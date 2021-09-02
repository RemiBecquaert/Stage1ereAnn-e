<?php

function accueilControleur($twig, $db){
    $form = array();
    $produit = new Produit($db);
    $liste = $produit->select();

    echo $twig->render('accueil.html.twig',array('form'=>$form, 'liste'=>$liste));
}

?>

