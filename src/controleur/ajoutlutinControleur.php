<?php

function ajoutlutinControleur($twig, $db){
$form = array();
    if (isset($_POST['btAjouter'])){
        $numero = $_POST['numero'];
        $nomProduit = $_POST['nomProduit'];
        $desProduit = $_POST['desProduit'];
        $prix = $_POST['prix'];
        $idType = $_POST['idType'];
        $photo = $_FILES['photo'];
        
        $form['valide'] = true;

        $produit = new Produit($db);

        $upload = new Upload(array('png', 'gif', 'jpg', 'jpeg'), 'images', 500000);
        $photo = $upload->enregistrer('photo');

        $exec = $produit->insert($numero, $idType, $nomProduit, $desProduit, $prix, $photo['nom']);

        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème d\'ajout du produit';
        }
        $form['numero'] = $numero;
        $form['idType'] = $idType;
        $form['nomProduit'] = $nomProduit;
        $form['desProduit'] = $desProduit;
        $form['prix'] = $prix;
        $form['photo'] = $photo;
    }

    echo $twig->render('ajoutlutin.html.twig',array('form'=>$form));
}
?>