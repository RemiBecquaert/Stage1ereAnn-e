<?php

function produitmodifControleur($twig, $db){
    $form = array();
    if(isset($_GET['idProduit'])){
        $produit = new Produit($db);
        $unProduit = $produit->selectById($_GET['idProduit']);
        if ($unProduit!=null){
            $form['produit'] = $unProduit;
        }
        else{
            $form['message'] = 'Produit incorrect';
        }
    }
    else{
        $form['message'] = 'Produit non précisé';
    }
    echo $twig->render('produit-modif.html.twig',array('form'=>$form));
}

?>
