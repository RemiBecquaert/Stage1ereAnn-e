<?php

function disconnectControleur($twig, $db){
    session_unset();
    session_destroy();
    header("Location:index.php");
   }

?>