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
        if(isset($_POST['btModifier'])){
            $produit = new Produit($db);
            $idProduit = $_POST['idProduit'];
            $numero = $_POST['numero'];
            $nomProduit = $_POST['nomProduit'];
            $desProduit = $_POST['desProduit'];
            $prix = $_POST['prix'];
            $exec=$produit->update($idProduit, $numero, $nomProduit, $desProduit, $prix);
            if(!$exec){
            $form['valide'] = false;
            $form['message'] = 'Échec de la modification';
            }
            else{
                $form['valide'] = true;
                $form['message'] = 'Modification réussie !';
            }
        }
        else{
            $form['message'] = 'Produit non précisé';
        }
    }
    echo $twig->render('produit-modif.html.twig',array('form'=>$form));
}

?>
