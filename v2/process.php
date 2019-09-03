<?php
echo 'lol';
require('includes/admin_function.php');
echo 'lol';
if(isset($_POST['deleteuser'])){
    if(true){
        $pseudo = $_POST['deleteuser'];
        DeleteUser($pseudo);
        echo 'Utilisateur supprimé ! ';
        return 0;

    }
}



?>