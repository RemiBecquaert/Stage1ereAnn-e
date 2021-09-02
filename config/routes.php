<?php

function getPage($db){

    $lesPages['accueil'] = "accueilControleur;0";
    $lesPages['mentions'] = "mentionsControleur;0";
    $lesPages['inscrire'] = "inscrireControleur;0";
    $lesPages['connexion'] = "connexionControleur;0";
    $lesPages['contact'] = "contactControleur;0";
    $lesPages['maintenance'] = "maintenanceControleur;0";
    $lesPages['deconnexion'] = "disconnectControleur;0";
    $lesPages['utilisateur'] = "utilisateurControleur;1";
    $lesPages['modifier'] = "utilisateurModifControleur;1";
    $lesPages['infoclient'] = "infoclientControleur;2";
    $lesPages['contact-modif'] = "contactModifControleur;1";
    $lesPages['commentfaire'] = "commentfaireControleur;1";
    $lesPages['ajoutlutin'] = "ajoutlutinControleur;1";
    $lesPages['listeproduit'] = "listeproduitControleur;1";
    $lesPages['produit-modif'] = "produitmodifControleur;1";
    $lesPages['produit'] = "produitControleur;0";

    if ($db!=null){
        if(isset($_GET['page'])){
            $page = $_GET['page']; }
        else{
            $page = 'accueil';
        }
        if (!isset($lesPages[$page])){
            $page = 'accueil';
        }

        $explose = explode(";",$lesPages[$page]);
        // Nous découpons la ligne du tableau sur le
        //caractère « ; » Le résultat est stocké dans le tableau $explose
       
        $role = $explose[1]; // Le rôle est dans la 2ème partie du tableau $explose
       
        if ($role != 0){ // Si mon rôle nécessite une vérification
            if(isset($_SESSION['login'])){ // Si je me suis authentifié
                if(isset($_SESSION['role'])){ // Si j’ai bien un rôle
                    if($role!=$_SESSION['role']){ // Si mon rôle ne correspond pas à celui qui est
                                                 //pour voir la page
                    $contenu = 'accueilControleur'; // Je le redirige vers l’accueil, car il n’a pas le bon rôle
                    }
                    else{
                        $contenu = $explose[0]; // Je récupère le nom du contrôleur, car il a le bon rôle
                    }
                }
            else{
                 $contenu = 'accueilControleur';;
            }
        }
        else{
            $contenu = 'accueilControleur';; // Page d’accueil, car il n’est pas authentifié
        }
        }else{
            $contenu = $explose[0]; // Je récupère le contrôleur, car il n’a pas besoin d’avoir un rôle
        }
    }
    else{
        $contenu = $lesPages['maintenance'];
    }
    return $contenu;
}

?>
