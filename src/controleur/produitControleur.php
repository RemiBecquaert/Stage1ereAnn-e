<?php

function produitControleur($twig, $db){
    $form = array();
    $produit = new Produit($db);
    $liste = $produit->selectById();

    echo $twig->render('produit.html.twig',array('form'=>$form, 'liste'=>$liste));
}

?>
