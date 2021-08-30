<?php

function contactControleur($twig, $db){
    $form = array();
    if (isset($_POST['btSubmit'])){      
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];       
        $text = $_POST['text'];
        $form['valide'] = true;    
          
        $contact = new Contact ($db);
        $exec = $contact->insert($nom, $prenom, $email, $text);
            if (!$exec){          
                $form['valide'] = false;            
                $form['message'] = 'L\'envoi du message a échoué';          
            }
        
        $form['nom'] = $nom;
        $form['prenom'] = $prenom;
        $form['email'] = $email;     
        $form['text'] = $text;
        }
    
        echo $twig->render('contact.html.twig',array('form'=>$form));

    }

function contactModifControleur($twig, $db){
    $form = array();
    $contact = new Contact ($db);

    if(isset($_POST['btSupprimer'])){
        $cocher = $_POST['cocher'];
        $form['valide'] = true;
        $etat = true;
        foreach ( $cocher as $id){
            $exec=$contact->delete($id);
            if (!$exec){
                $etat = false;
            }
        }
        header('Location: index.php?page=contact-modif&etat='.$etat);
        exit;
    }
       

    if(isset($_GET['id'])){
        $exec=$contact->delete($_GET['id']);
       
        if (!$exec){
        $etat = false;
        }
        else{
        $etat = true;
        }
        header('Location: index.php?page=contact-modif&etat='.$etat);
        exit;
        }
        if(isset($_GET['etat'])){
        $form['etat'] = $_GET['etat'];
        }

    $liste = $contact->select();
    echo $twig->render('contact-modif.html.twig',array('form'=>$form, 'liste'=>$liste));
}
    
?>