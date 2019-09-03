<?php
if(file_exists("includes/members.php")){
	require_once("members.php");
}elseif(file_exists("members.php")){
	require_once("members.php");
}
if(isLogged()){
		echo '
		<nav>
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="profil.php">Mon Profil</a></li>
				<li><a href="contact.php">Me Contacter</a></li>


			</ul>
		</nav>';
		echo "<form method='POST' action='includes/disconnect.php'>";
		echo "<input type='submit' name='disconnect' value='deconnexion'>";
		echo "</form>";
}else {
	echo "
		<nav>
			<ul>
				<li><a href='index.php'>Accueil</a></li>
				<li><a href='contact.php'>Me Contacter</a></li>
				<li><a href='inscription.php'>M'inscrire</a></li>
			</ul>
		</nav>";
		
}
?>
