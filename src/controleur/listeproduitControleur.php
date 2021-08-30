<?php

function listeproduitControleur($twig, $db){
    $form = array();
    $produit = new Produit($db);
    $liste = $produit->select();

    echo $twig->render('listeproduit.html.twig',array('form'=>$form, 'liste'=>$liste));
}

?>
