<?php
if(file_exists("members.php")){
	require("members.php");
}
if(isLogged()){
	echo 'window.location="../index.php"';
	exit();
}
if(is_null(isset($_POST['pseudo'])) && is_null(($_POST['password']))){
	echo'<script>window.location="../index.php"</script>';
	exit();
}

?>
<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>


<?php
if(file_exists("members.php")){ // Evite l'affichage d'une
//erreur si jamais membres.php ne peut pas être load
	if(empty($_POST['pseudo']) && empty($_POST['password'])){
		if(!isLogged()){
		echo '<section class="user_register"><form action="register.php" method="POST">
			Pseudo :<input type="text" maxLength="200" name="pseudo">
			Mot de passe : <input type="password" maxLength="200" name="password" />
			Confirmer votre mot de passe : <input type="text" maxLength="200" name="password_c" />
			Email : <input type="text" maxLength="200" name="mail" />
			<input type="submit" value="S inscrire"/>
			</form></section>';
		}
}
		
		if(isset($_POST['pseudo'])){
			if(isPasswordMatching($_POST['password'],$_POST['password_c'])){
				if(isFormatOk($_POST['pseudo'],$_POST['password'],$_POST['mail'])){
					
					if(createMember($_POST['pseudo'],$_POST['password'],$_POST['mail'])){
						
						echo '<h3><center>Vous êtes maintenant inscrit !</center></h3>';
						echo'<script> a = function(){window.locations("index.php")}; window.setTimeout(a,3000);</script>';

						
					}else{
						
						echo '<section><h3 color="red">Il semble que les inscriptions soit désactivées ! Veuillez contactez un administrateur</h3></section>';
					}
		}
		}
		}else{
			echo'<script>window.location="../index.php"</script>';
		}
}

?>

</br>



</body>






</html>